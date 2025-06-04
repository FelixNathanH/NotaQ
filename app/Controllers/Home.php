<?php

namespace App\Controllers;

use App\Models\ModelUser;

class Home extends BaseController
{
    protected $db, $builder, $ModelUser;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('menu');
        $this->builder = $this->db->table('user');
        $this->ModelUser = new ModelUser();
        $this->request = \Config\Services::request();
    }
    public function index()
    {
        // Debug: Dump session contents
        echo '<pre>';
        print_r(session()->get());
        echo '</pre>';
        exit;
        // Stop execution so you can inspect the output
        $data['title'] = 'Home';
        $data['name'] = session()->get('name') ?? '';
        $data['company'] = session()->get('company') ?? '';
        return view('home/index', $data);
    }

    public function test()
    {
        return view('test/index');
    }

    // myProfile
    public function profile()
    {
        $data['title'] = 'profile';
        $data['name'] = session()->get('name') ?? '';
        $data['company'] = session()->get('company') ?? '';
        $user = $this->ModelUser->find(session()->get('user_id'));
        $data['user'] = $user;
        return view('profile/index', $data);
    }

    public function updateProfile()
    {
        // Step 1: Get user ID from session
        $userId = session()->get('user_id');

        // Step 2: Validate incoming POST data
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required',
            'email' => 'required|valid_email',
            'company' => 'required',
            'phone_number' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // If validation fails, return JSON error messages
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $validation->getErrors()
            ]);
        }

        // Step 3: Prepare clean data
        $data = [
            'name'         => $this->request->getPost('name'),
            'email'        => $this->request->getPost('email'),
            'company'      => $this->request->getPost('company'),
            'phone_number' => $this->request->getPost('phone_number'),
        ];

        // Step 4: Update user data
        $userModel = new \App\Models\ModelUser();
        $existingUser = $userModel
            ->where('email', $data['email'])
            ->where('user_id !=', $userId)
            ->first();

        if ($existingUser) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Email sudah digunakan oleh akun lain.'
            ]);
        }
        $userModel->update($userId, $data);

        // Step 5: Update session data
        session()->set('name', $data['name']);
        session()->set('email', $data['email']);
        session()->set('company', $data['company']);
        session()->set('phone_number', $data['phone_number']);

        // Step 6: Return success response
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Profil berhasil diperbarui.'
        ]);
    }

    public function deleteAccount()
    {
        $userId = session()->get('user_id');
        $userModel = new \App\Models\ModelUser();
        // First, update is_verified = 0
        $userModel->update($userId, ['is_verified' => 0]);
        if ($userModel->delete($userId)) {
            // Destroy session
            session()->destroy();

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Akun Anda berhasil dihapus.'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menghapus akun.'
            ]);
        }
    }
    // End of myProfile

    public function testing()
    {
        $model = new \App\Models\ModelCart();
        $result = $model->insert([
            'invoice_id' => 'test_invoice',
            'company_id' => 'test_company',
            'product_id' => 'prd683f28bc78501',
            'order_amount' => 1,
            'order_price' => 12000,
            'order_note' => null,
            'is_custom_product' => false,
            'custom_product_name' => null,
            'custom_product_price' => null,
        ]);

        if (!$result) {
            dd($model->errors());
        }
    }
}
