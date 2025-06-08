<?php

namespace App\Controllers;

use App\Models\ModelStaff;
use App\Models\ModelCompany;

class staff extends Home
{
    protected $db, $builder, $ModelStaff, $ModelCompany;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('staff');
        $this->ModelStaff = new ModelStaff();
        $this->ModelCompany = new ModelCompany();
        $this->request = \Config\Services::request();
    }

    public function index()
    {
        if (session()->has('staff_id') && !session()->has('user_id')) {
            return view('error-page/forbidden');
        }
        $data['title'] = 'staff';
        if (session()->has('user_id')) {
            $data['name'] = session()->get('name');
        } elseif (session()->has('staff_id')) {
            $data['name'] = session()->get('staff_name');
        } else {
            $data['name'] = '';
        }
        $data['company'] = session()->get('company') ?? '';
        return view('staff/index', $data);
    }

    public function login()
    {
        $data['title'] = 'staff login';
        return view('staff/login', $data);
    }


    public function auth()
    {
        $email = $this->request->getPost('email');
        $password = (string) $this->request->getPost('password');
        if (empty($email) || empty($password)) {
            return $this->response->setJSON(['error' => 'Email and password are required']);
        }
        $staff = $this->ModelStaff->where('email', $email)->first();

        if (!$staff) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Staff with that email does not exist.'
            ]);
        }
        if ($staff['deleted_at'] != null) {
            return $this->response->setJSON(['error' => true, 'message' => 'Akun ini telah dihapus. Silahkan hubungi owner']);
        }

        if (!password_verify($password, $staff['password'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Incorrect password.'
            ]);
        }

        // Store staff data in session
        session()->set([
            'staff_id'     => $staff['staff_id'],
            'company_id'   => $staff['company_id'],
            'staff_name'   => $staff['name'],
            'staff_email'  => $staff['email'],
            'staff_role'   => $staff['company_role'],
            'is_staff_logged_in' => true,
        ]);


        return $this->response->setJSON([
            'success' => true,
            'message' => 'Login successful!'
        ]);
    }


    public function staffdtb()
    {
        $companyId = session()->get('company_id');
        $staff = $this->ModelStaff->where('company_id', $companyId)->findAll();

        $data = [];
        foreach ($staff as $row) {
            $data[] = [
                'nama'           => $row['name'],
                'email'          => $row['email'],
                'phone_number'   => $row['phone_number'],
                'government_id'  => $row['government_id'],
                'company_role'   => $row['company_role'],
                'action' => '
                <button 
                    class="btn btn-sm btn-warning edit-btn" 
                    data-id="' . $row['staff_id'] . '"
                >Edit</button>
                <button 
                    class="btn btn-sm btn-danger delete-btn" 
                    data-id="' . $row['staff_id'] . '"
                >Delete</button>'
            ];
        }

        return $this->response->setJSON(['data' => $data]);
    }

    public function get()
    {
        $staffId = $this->request->getPost('staff_id');

        $staff = $this->ModelStaff->find($staffId);

        if ($staff) {
            return $this->response->setJSON([
                'success' => true,
                'data' => $staff
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Staff not found.'
            ]);
        }
    }



    public function addStaff()
    {
        // Get form data
        $staffId = 'stf' . uniqid();
        $companyId = session()->get('company_id');

        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone_number');
        $govId = $this->request->getPost('government_id');
        $role = $this->request->getPost('company_role');
        $password = (string) $this->request->getPost('password');
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // Build data array
        $data = [
            'staff_id'      => $staffId,
            'company_id'    => $companyId,
            'name'          => $name,
            'email'         => $email,
            'phone_number'  => $phone,
            'government_id' => $govId,
            'company_role'  => $role,
            'password'      => $hashedPassword,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s')
        ];

        // Insert into DB
        try {
            $this->ModelStaff->add_staff($data);
            return $this->response->setJSON(['success' => true, 'message' => 'Staff successfully added']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['error' => true, 'message' => 'Failed to add staff', 'details' => $e->getMessage()]);
        }
    }

    public function editStaff()
    {
        $staffId = $this->request->getPost('staff_id');
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone_number');
        $govId = $this->request->getPost('government_id');
        $role = $this->request->getPost('company_role');
        if (!empty($this->request->getPost('password'))) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $data = [
            'name' => $name,
            'email' => $email,
            'phone_number' => $phone,
            'government_id' => $govId,
            'company_role' => $role,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Update password only if a new one is provided
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        try {
            $this->ModelStaff->update($staffId, $data);
            return $this->response->setJSON(['success' => true, 'message' => 'Staff updated successfully']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['error' => true, 'message' => 'Failed to update staff', 'details' => $e->getMessage()]);
        }
    }

    public function deleteStaff()
    {
        $staffId = $this->request->getPost('staff_id');

        if (!$staffId) {
            return $this->response->setJSON(['success' => false, 'message' => 'Missing staff ID']);
        }

        $deleted = $this->ModelStaff->delete($staffId); // Soft delete, if enabled

        return $this->response->setJSON([
            'success' => $deleted,
            'message' => $deleted ? 'Staff deleted successfully.' : 'Failed to delete staff.'
        ]);
    }
}
