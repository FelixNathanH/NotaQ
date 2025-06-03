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

    // public function submitInvoice()
    // {
    //     $db = \Config\Database::connect();
    //     $db->transStart();

    //     try {
    //         $invoiceId = 'inv' . uniqid();
    //         $companyId = session()->get('company_id');
    //         $createdBy = session()->get('user_id'); // or username, if stored that way

    //         // Get posted form data
    //         $customer_name    = $this->request->getPost('customer_name');
    //         $customer_contact = $this->request->getPost('customer_contact');
    //         $customer_email   = $this->request->getPost('customer_email');
    //         // $customer_address = $this->request->getPost('customer_address');
    //         $transaction_time = $this->request->getPost('transaction_time');
    //         $total_price      = $this->request->getPost('total_price');
    //         $total_payment    = $this->request->getPost('payment_amount');

    //         // Get invoice items (from JS as JSON)
    //         $items = $this->request->getPost('items'); // Should be JSON string
    //         $items = json_decode($items, true);

    //         // Build invoice data
    //         $invoiceData = [
    //             'invoice_id'       => $invoiceId,
    //             'company_id'       => $companyId,
    //             'created_by'       => $createdBy,
    //             'customer_name'    => $customer_name,
    //             'customer_contact' => $customer_contact,
    //             'customer_email'   => $customer_email,
    //             // 'customer_address' => $customer_address,
    //             'transaction_time' => $transaction_time,
    //             'total_price'      => $total_price,
    //             'total_payment'    => $total_payment,
    //             'created_at'       => date('Y-m-d H:i:s'),
    //             'updated_at'       => date('Y-m-d H:i:s'),
    //         ];

    //         // Insert invoice
    //         $invoiceModel = new \App\Models\ModelInvoice();
    //         $invoiceModel->insert($invoiceData);

    //         // Insert items into cart table
    //         $cartModel = new \App\Models\ModelCart();

    //         foreach ($items as $item) {
    //             $cartData = [
    //                 'invoice_id'           => $invoiceId,
    //                 'company_id'           => $companyId,
    //                 'product_id'           => $item['product_id'] ?? null,
    //                 'order_amount'         => $item['quantity'],
    //                 'order_price'          => $item['price'],
    //                 'order_note'           => $item['note'] ?? null,
    //                 'is_custom_product'    => $item['is_custom'] ?? false,
    //                 'custom_product_name'  => $item['custom_name'] ?? null,
    //                 'custom_product_price' => $item['custom_price'] ?? null,
    //             ];

    //             if (!$cartModel->insert($cartData)) {
    //                 $db->transRollback(); // Cancel entire transaction
    //                 return $this->response->setJSON([
    //                     'success' => false,
    //                     'message' => 'Gagal menyimpan item cart',
    //                     'cart_data' => $cartData,
    //                     'cart_error' => $cartModel->errors(), // ⭐️ This gives detailed error(s)
    //                     'validation' => $cartModel->validation, // Optional: deeper inspection
    //                 ]);
    //             }
    //         }

    //         $db->transComplete();

    //         // terakhir smape ini
    //         if ($db->transStatus() === false) {
    //             return $this->response->setJSON([
    //                 'success' => false,
    //                 'message' => 'Invoice failed at transStatus check',
    //                 'invoice_data' => $invoiceData,
    //                 'items' => $items,
    //                 'db_error' => $db->error(),
    //             ]);
    //         }

    //         return $this->response->setJSON([
    //             'success' => true,
    //             'message' => 'Invoice berhasil disimpan',
    //             'invoice_id' => $invoiceId
    //         ]);
    //     } catch (\Exception $e) {
    //         $db->transRollback();
    //         return $this->response->setJSON([
    //             'success' => false,
    //             'message' => 'Gagal menyimpan invoice',
    //             'error'   => $e->getMessage(),
    //             'db_error' => $db->error(), // ✅ this reveals the underlying DB error
    //         ]);
    //     }
    // }

    public function submitInvoice()
    {
        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            $invoiceId = 'inv' . uniqid();
            $companyId = session()->get('company_id');
            $createdBy = session()->get('user_id');

            // Get posted form data
            $customer_name    = $this->request->getPost('customer_name');
            $customer_contact = $this->request->getPost('customer_contact');
            $customer_email   = $this->request->getPost('customer_email');
            $transaction_time = $this->request->getPost('transaction_time');
            $total_price      = $this->request->getPost('total_price');
            $total_payment    = $this->request->getPost('payment_amount');
            $items            = json_decode($this->request->getPost('items'), true);

            // Invoice data
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

            // Insert invoice
            $invoiceModel = new \App\Models\ModelInvoice();
            if (!$invoiceModel->insert($invoiceData)) {
                $db->transRollback();
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal menyimpan invoice',
                    'validation' => $invoiceModel->errors(),
                    'invoice_data' => $invoiceData
                ]);
            }

            // Insert cart items
            $cartModel = new \App\Models\ModelCart();

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

                if (!$cartModel->insert($cartData)) {
                    $db->transRollback();
                    return $this->response->setJSON([
                        'success'    => false,
                        'message'    => 'Gagal menyimpan item cart',
                        'cart_data'  => $cartData,
                        'validation' => $cartModel->errors(),
                        'db_error'   => $db->error()
                    ]);
                }
            }

            // Finalize transaction
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
