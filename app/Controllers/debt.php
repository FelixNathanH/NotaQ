<?php

namespace App\Controllers;

use App\Models\ModelInvoice;
use App\Models\ModelCart;
use App\Models\ModelProduct;
use App\Models\ModelDebt;

class debt extends Home
{
    protected $db, $builder, $ModelProduct, $ModelDebt, $ModelInvoice, $ModelCart;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('debt');
        $this->ModelProduct = new ModelProduct();
        $this->ModelDebt = new ModelDebt();
        $this->ModelInvoice = new ModelInvoice();
        $this->ModelCart = new ModelCart();
        $this->request = \Config\Services::request();
    }

    public function submit()
    {
        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            $invoiceModel = new ModelInvoice();
            $cartModel    = new ModelCart();
            $productModel = new ModelProduct();
            $debtModel    = new ModelDebt();

            $invoice_id = 'inv' . uniqid();
            $debt_id    = 'debt' . uniqid();

            $company_id = session()->get('company_id');
            $created_by = session()->get('user_id');

            // Collect request
            $transaction_time = $this->request->getPost('transaction_time');
            $customer_name    = $this->request->getPost('customer_name');
            $customer_contact = $this->request->getPost('customer_contact');
            $customer_email   = $this->request->getPost('customer_email');
            $payment_method   = $this->request->getPost('payment_method');
            $total_price      = $this->request->getPost('total_price');
            $payment_amount   = $this->request->getPost('payment_amount');
            $due_date         = $this->request->getPost('due_date');
            $amount_due       = $total_price - $payment_amount;
            $items            = json_decode($this->request->getPost('items'), true);

            // Insert invoice
            $invoiceModel->insert([
                'invoice_id'       => $invoice_id,
                'company_id'       => $company_id,
                'created_by'       => $created_by,
                'customer_name'    => $customer_name,
                'customer_contact' => $customer_contact,
                'customer_email'   => $customer_email,
                'payment_method'   => $payment_method,
                'transaction_time' => $transaction_time,
                'total_price'      => $total_price,
                'total_payment'    => $payment_amount,
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ]);

            // Insert items into cart
            foreach ($items as $item) {
                $cartModel->insert([
                    'invoice_id'           => $invoice_id,
                    'company_id'           => $company_id,
                    'product_id'           => $item['product_id'] ?? null,
                    'order_amount'         => $item['quantity'],
                    'order_price'          => $item['price'],
                    'order_note'           => $item['note'] ?? null,
                    'is_custom_product'    => $item['is_custom'] ?? false,
                    'custom_product_name'  => $item['custom_name'] ?? null,
                    'custom_product_price' => $item['custom_price'] ?? null,
                ]);

                // Reduce stock (if not custom)
                if (!($item['is_custom'] ?? false) && !empty($item['product_id'])) {
                    $productModel->where('product_id', $item['product_id'])
                        ->decrement('product_stock', $item['quantity']);
                }
            }

            // Save debt
            $debtModel->insert([
                'debt_id'           => $debt_id,
                'invoice_id'        => $invoice_id,
                'company_id'        => $company_id,
                'customer_name'     => $customer_name,
                'customer_contact'  => $customer_contact,
                'customer_email'    => $customer_email,
                'total_amount'      => $amount_due,
                'due_date'          => $due_date,
                'reminder_frequency' => 3, // or null if not used yet
                'reminder_method'   => 'none',
                'status'            => 'unpaid',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);

            $db->transCommit();

            return $this->response->setJSON([
                'success'     => true,
                'message'     => 'Piutang berhasil disimpan.',
                'invoice_id'  => $invoice_id,
                'debt_id'     => $debt_id,
            ]);
        } catch (\Throwable $e) {
            $db->transRollback();
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menyimpan piutang: ' . $e->getMessage()
            ]);
        }
    }
}
