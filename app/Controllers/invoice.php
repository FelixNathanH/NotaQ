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
}
