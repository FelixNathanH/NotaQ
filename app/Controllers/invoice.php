<?php

namespace App\Controllers;

use App\Models\ModelInvoice;
use App\Models\ModelProduct;

class invoice extends Home
{
    protected $db, $builder, $ModelInvoice, $ModelProduct;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('invoice');
        $this->ModelInvoice = new ModelInvoice();
        $this->ModelProduct = new ModelProduct();
        $this->request = \Config\Services::request();
    }

    public function index()
    {
        $data['title'] = 'Invoice';
        $data['name'] = session()->get('name') ?? '';
        $data['company'] = session()->get('company') ?? '';
        $data['products'] = $this->ModelProduct->where('company_id', session()->get('company_id'))->findAll();
        return view('invoice/index', $data);
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
            $createdBy = session()->get('user_id');

            $customer_name    = $this->request->getPost('customer_name');
            $customer_contact = $this->request->getPost('customer_contact');
            $customer_email   = $this->request->getPost('customer_email');
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
}
