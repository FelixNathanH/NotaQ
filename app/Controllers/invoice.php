<?php

namespace App\Controllers;

use App\Models\ModelInvoice;
use App\Models\ModelProduct;
use App\Models\ModelCompany;
use App\Models\ModelDebt;


class invoice extends Home
{
    protected $db, $builder, $ModelInvoice, $ModelProduct, $ModelCompany, $ModelDebt;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('invoice');
        $this->ModelInvoice = new ModelInvoice();
        $this->ModelProduct = new ModelProduct();
        $this->ModelCompany = new ModelCompany();
        $this->ModelDebt = new ModelDebt();
        $this->request = \Config\Services::request();
    }

    public function index()
    {
        $data['title'] = 'Invoice';
        if (session()->has('user_id')) {
            $data['name'] = session()->get('name');
        } elseif (session()->has('staff_id')) {
            $data['name'] = session()->get('staff_name');
        } else {
            $data['name'] = '';
        }
        $data['company'] = session()->get('company') ?? '';
        $data['products'] = $this->ModelProduct->where('company_id', session()->get('company_id'))->findAll();
        $company = $this->ModelCompany->find(session()->get('company_id'));
        $data['company'] = $company['company_name'];
        return view('invoice/index', $data);
    }

    public function invoiceList()
    {
        $data['title'] = 'Invoice List';
        if (session()->has('user_id')) {
            $data['name'] = session()->get('name');
        } elseif (session()->has('staff_id')) {
            $data['name'] = session()->get('staff_name');
        } else {
            $data['name'] = '';
        }
        $data['company'] = session()->get('company') ?? '';
        $company = $this->ModelCompany->find(session()->get('company_id'));
        $data['company'] = $company['company_name'];
        return view('invoice/list', $data);
    }

    public function invoiceDtb()
    {
        $companyId = session()->get('company_id');
        $invoices = $this->ModelInvoice
            ->select('invoice.*, debt.status')
            ->join('debt', 'debt.invoice_id = invoice.invoice_id', 'left')
            ->where('invoice.company_id', $companyId)
            ->findAll();
        $data = [];
        foreach ($invoices as $row) {
            $data[] = [
                'invoice_id' => $row['invoice_id'],
                'customer_name' => $row['customer_name'],
                'created_at' => $row['created_at'],
                'total_price' => $row['total_price'],
                'status' => $row['status'] ?? 'Lunas',
                'action' => '
             <button class="btn btn-sm btn-warning see-details-btn" data-id="' . $row['invoice_id'] . '">See Details</button>
            '
            ];
        }
        return $this->response->setJSON(['data' => $data]);
    }

    public function checkStock()
    {
        $productId = $this->request->getPost('product_id');
        $companyId = session()->get('company_id');

        $product = $this->ModelProduct
            ->where('product_id', $productId)
            ->where('company_id', $companyId)
            ->first();

        if ($product) {
            return $this->response->setJSON(['stock' => (int)$product['product_stock']]);
        } else {
            return $this->response->setJSON(['error' => true, 'message' => 'Produk tidak ditemukan']);
        }
    }

    public function submitInvoice()
    {
        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            $invoiceId = 'inv' . uniqid();
            $companyId = session()->get('company_id');
            $createdBy = session()->get('user_id') ?? session()->get('staff_id');

            $customer_name    = $this->request->getPost('customer_name');
            $customer_contact = $this->request->getPost('customer_contact');
            $customer_email   = $this->request->getPost('customer_email');
            $payment_method   = $this->request->getPost('payment_method');
            $transaction_time = $this->request->getPost('transaction_time');
            $total_price      = $this->request->getPost('total_price');
            $total_payment    = $this->request->getPost('payment_amount');
            $items            = json_decode($this->request->getPost('items'), true);

            $invoiceData = [
                'invoice_id'       => $invoiceId,
                'company_id'       => $companyId,
                'created_by'       => $createdBy,
                'customer_name'    => $customer_name,
                'customer_contact' => $customer_contact,
                'customer_email'   => $customer_email,
                'customer_email'   => $customer_email,
                'payment_method'   => $payment_method,
                'transaction_time' => $transaction_time,
                'total_price'      => $total_price,
                'total_payment'    => $total_payment,
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ];

            $invoiceModel = new \App\Models\ModelInvoice();
            $inserted = $invoiceModel->insert($invoiceData);

            if ($inserted === false) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal menyimpan invoice',
                    'validation' => $invoiceModel->errors(),
                    'invoice_data' => $invoiceData,
                    'db_error' => $db->error()
                ]);
            }

            $cartModel = new \App\Models\ModelCart();
            $productModel = new \App\Models\ModelProduct(); // ← we’ll use this to update stock

            foreach ($items as $item) {
                $cartData = [
                    'invoice_id'           => $invoiceId,
                    'company_id'           => $companyId,
                    'product_id'           => $item['product_id'] ?? null,
                    'order_amount'         => $item['quantity'],
                    'order_price'          => $item['price'],
                    'order_note'           => $item['note'] ?? null,
                    'is_custom_product'    => $item['is_custom'] ?? false,
                    'custom_product_name'  => $item['custom_name'] ?? null,
                    'custom_product_price' => $item['custom_price'] ?? null,
                ];

                $inserted = $cartModel->insert($cartData);

                if ($inserted === false) {
                    $db->transRollback();
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Gagal menyimpan item cart',
                        'cart_data' => $cartData,
                        'validation' => $cartModel->errors(),
                        'db_error' => $db->error()
                    ]);
                }

                // 🛡️ Check and reduce product stock
                if (!($item['is_custom'] ?? false) && !empty($item['product_id'])) {
                    $product = $productModel->find($item['product_id']);

                    if (!$product) {
                        $db->transRollback();
                        return $this->response->setJSON([
                            'success' => false,
                            'message' => 'Produk tidak ditemukan',
                            'product_id' => $item['product_id']
                        ]);
                    }

                    if ($product['product_stock'] < $item['quantity']) {
                        $db->transRollback();
                        return $this->response->setJSON([
                            'success' => false,
                            'message' => 'Stok produk tidak mencukupi untuk: ' . $product['product_name'],
                            'product_id' => $item['product_id'],
                            'available_stock' => $product['product_stock'],
                            'requested' => $item['quantity']
                        ]);
                    }

                    // Safe to reduce stock
                    $productModel->where('product_id', $item['product_id'])
                        ->decrement('product_stock', $item['quantity']);
                }
            }


            if ($db->transStatus() === false) {
                $db->transRollback();
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Transaksi gagal di tahap akhir',
                    'invoice_data' => $invoiceData,
                    'db_error' => $db->error()
                ]);
            }

            $db->transCommit();

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Invoice berhasil disimpan',
                'invoice_id' => $invoiceId
            ]);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menyimpan invoice karena exception',
                'error'   => $e->getMessage(),
                'db_error' => $db->error()
            ]);
        }
    }

    public function getInvoiceDetails($invoiceId)
    {
        $invoiceModel = new \App\Models\ModelInvoice();
        $cartModel    = new \App\Models\ModelCart();
        $productModel = new \App\Models\ModelProduct();

        // Get invoice info
        $invoice = $invoiceModel->where('invoice_id', $invoiceId)->first();

        if (!$invoice) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invoice tidak ditemukan']);
        }

        // Get items
        $items = $cartModel
            ->where('invoice_id', $invoiceId)
            ->findAll();

        foreach ($items as &$item) {
            // Attach product info if not custom
            if (!$item['is_custom_product'] && $item['product_id']) {
                $product = $productModel->find($item['product_id']);
                $item['product_name'] = $product['product_name'] ?? 'Unknown';
            } else {
                $item['product_name'] = $item['custom_product_name'] ?? 'Custom';
            }
        }

        return $this->response->setJSON([
            'success' => true,
            'invoice' => $invoice,
            'items' => $items
        ]);
    }
}
