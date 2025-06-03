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

    public function submit()
    {
        // Make sure it's an AJAX request
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['error' => 'Invalid request']);
        }

        $json = $this->request->getJSON(true); // associative array

        // 1. Validate incoming data
        $validation = \Config\Services::validation();
        $validation->setRules([
            'transaction_time' => 'required|valid_date[Y-m-d]',
            'customer_name' => 'required',
            'customer_contact' => 'required',
            'customer_email' => 'required|valid_email',
            'payment_method' => 'required',
            'payment_amount' => 'required|decimal',
            'total_price' => 'required|decimal',
            'products' => 'required|is_array'
        ]);

        if (!$validation->run($json)) {
            return $this->response->setStatusCode(422)->setJSON([
                'error' => 'Validation failed',
                'messages' => $validation->getErrors()
            ]);
        }

        // 2. Start transaction
        $db = \Config\Database::connect();
        $db->transStart();

        // 3. Insert into invoice table
        $invoiceData = [
            'transaction_time' => $json['transaction_time'],
            'customer_name' => $json['customer_name'],
            'customer_contact' => $json['customer_contact'],
            'customer_email' => $json['customer_email'],
            'payment_method' => $json['payment_method'],
            'payment_amount' => $json['payment_amount'],
            'total_price' => $json['total_price'],
            'debt_status' => ((float)$json['payment_amount'] < (float)$json['total_price']) ? 'unpaid' : 'paid',
            'staff_id' => session()->get('staff_id'), // assuming you're using sessions
        ];

        $invoiceModel = new \App\Models\InvoiceModel();
        $invoiceId = $invoiceModel->insert($invoiceData, true); // get inserted ID

        // 4. Insert products into invoice_details table
        $detailModel = new \App\Models\InvoiceDetailModel();
        $productModel = new \App\Models\ProductModel();

        foreach ($json['products'] as $p) {
            $isCustom = str_starts_with($p['product_id'], 'custom-');

            $detailModel->insert([
                'invoice_id' => $invoiceId,
                'product_id' => $p['product_id'],
                'product_name' => $p['name'],
                'product_price' => $p['price'],
                'quantity' => $p['quantity'],
                'subtotal' => $p['subtotal']
            ]);

            // Reduce stock if not custom
            if (!$isCustom) {
                $product = $productModel->find($p['product_id']);
                if ($product) {
                    $newStock = max(0, $product['product_stock'] - $p['quantity']);
                    $productModel->update($p['product_id'], ['product_stock' => $newStock]);
                }
            }
        }

        // 5. Complete transaction
        $db->transComplete();

        if ($db->transStatus() === false) {
            return $this->response->setStatusCode(500)->setJSON([
                'error' => 'Database transaction failed.'
            ]);
        }

        // 6. Send notification (optional)

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Invoice created successfully.'
        ]);
    }
}
