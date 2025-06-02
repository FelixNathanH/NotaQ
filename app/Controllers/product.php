<?php

namespace App\Controllers;

use App\Models\ModelProduct;
use App\Models\ModelInventory;

class product extends Home
{
    protected $db, $builder, $ModelProduct, $ModelInventory;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('product');
        $this->ModelProduct = new ModelProduct();
        $this->ModelInventory = new ModelInventory();
        $this->request = \Config\Services::request();
    }

    public function index()
    {
        $data['title'] = 'product';
        $data['name'] = session()->get('name') ?? '';
        $data['company'] = session()->get('company') ?? '';
        return view('product/index', $data);
    }

    public function get()
    {
        $productId = $this->request->getPost('product_id');

        $product = $this->ModelProduct
            ->where('product_id', $productId)
            ->first();

        if ($product) {
            return $this->response->setJSON([
                'success' => true,
                'data' => $product
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Produk tidak ditemukan.'
            ]);
        }
    }


    public function productDtb()
    {
        $companyId = session()->get('company_id');
        $products = $this->ModelProduct->where('company_id', $companyId)->findAll();

        $data = [];
        foreach ($products as $row) {
            $data[] = [
                'product_name' => $row['product_name'],
                'product_description' => $row['product_description'],
                'product_price' => $row['product_price'],
                'product_stock' => $row['product_stock'],
                'action' => '
                <button class="btn btn-sm btn-warning edit-btn" data-id="' . $row['product_id'] . '">Edit</button>
                <button class="btn btn-sm btn-danger delete-btn" data-id="' . $row['product_id'] . '">Delete</button>
            '
            ];
        }

        return $this->response->setJSON(['data' => $data]);
    }



    public function addProduct()
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $productId = 'prd' . uniqid();
            $companyId = session()->get('company_id');

            $product_name = $this->request->getPost('product_name');
            $product_description = $this->request->getPost('product_description');
            $product_price = $this->request->getPost('product_price');
            $product_stock = $this->request->getPost('product_stock');

            $productData = [
                'product_id' => $productId,
                'company_id' => $companyId,
                'product_name' => $product_name,
                'product_description' => $product_description,
                'product_price' => $product_price,
                'product_stock' => $product_stock
            ];

            // Use transaction-safe methods
            $this->ModelProduct->add_product($productData);
            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('DB Transaction Failed');
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan'
            ]);
        } catch (\Exception $e) {
            $db->transRollback();
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menambahkan produk',
                'details' => $e->getMessage()
            ]);
        }
    }

    public function editProduct()
    {
        $productId = $this->request->getPost('product_id');

        $productData = [
            'product_name' => $this->request->getPost('product_name'),
            'product_description' => $this->request->getPost('product_description'),
            'product_price' => $this->request->getPost('product_price'),
            'product_stock' => $this->request->getPost('product_stock'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        try {
            $this->ModelProduct->update($productId, $productData);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Produk berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'error' => true,
                'message' => 'Gagal memperbarui produk',
                'details' => $e->getMessage()
            ]);
        }
    }



    public function deleteProduct()
    {
        $productId = $this->request->getPost('product_id');

        if (!$productId) {
            return $this->response->setJSON(['success' => false, 'message' => 'Missing product ID']);
        }

        $deleted = $this->ModelProduct->delete($productId); // Soft delete, if enabled

        return $this->response->setJSON([
            'success' => $deleted,
            'message' => $deleted ? 'Produk berhasil dihapus.' : 'Failed to delete product.'
        ]);
    }
}
