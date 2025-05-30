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

    public function productDtb()
    {
        $companyId = session()->get('company_id');
        $products = $this->ModelProduct->where('company_id', $companyId)->findAll();

        $data = [];
        foreach ($products as $row) {
            $stock = $this->ModelInventory->where('product_id', $row['product_id'])->first()['product_stock'] ?? 0;

            $data[] = [
                'product_name' => $row['product_name'],
                'product_description' => $row['product_description'],
                'product_price' => $row['product_price'],
                'product_stock' => $stock,
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
            ];

            $inventoryData = [
                'company_id' => $companyId,
                'product_id' => $productId,
                'product_stock' => $product_stock,
            ];

            // Use transaction-safe methods
            $this->ModelProduct->add_product($productData, $db);
            $this->ModelInventory->add_inventory($inventoryData, $db);

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




    // public function editStaff()
    // {
    //     $staffId = $this->request->getPost('staff_id');
    //     $name = $this->request->getPost('name');
    //     $email = $this->request->getPost('email');
    //     $phone = $this->request->getPost('phone_number');
    //     $govId = $this->request->getPost('government_id');
    //     $role = $this->request->getPost('company_role');
    //     $password = $this->request->getPost('password');

    //     $data = [
    //         'name' => $name,
    //         'email' => $email,
    //         'phone_number' => $phone,
    //         'government_id' => $govId,
    //         'company_role' => $role,
    //         'updated_at' => date('Y-m-d H:i:s'),
    //     ];

    //     // Update password only if a new one is provided
    //     if (!empty($password)) {
    //         $data['password'] = password_hash($password, PASSWORD_DEFAULT);
    //     }

    //     try {
    //         $this->ModelStaff->update($staffId, $data);
    //         return $this->response->setJSON(['success' => true, 'message' => 'Staff updated successfully']);
    //     } catch (\Exception $e) {
    //         return $this->response->setJSON(['error' => true, 'message' => 'Failed to update staff', 'details' => $e->getMessage()]);
    //     }
    // }

    // public function deleteStaff()
    // {
    //     $staffId = $this->request->getPost('staff_id');

    //     if (!$staffId) {
    //         return $this->response->setJSON(['success' => false, 'message' => 'Missing staff ID']);
    //     }

    //     $deleted = $this->ModelStaff->delete($staffId); // Soft delete, if enabled

    //     return $this->response->setJSON([
    //         'success' => $deleted,
    //         'message' => $deleted ? 'Staff deleted successfully.' : 'Failed to delete staff.'
    //     ]);
    // }
}
