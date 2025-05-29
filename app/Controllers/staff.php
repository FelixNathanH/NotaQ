<?php

namespace App\Controllers;

use App\Models\ModelStaff;

class staff extends Home
{
    protected $db, $builder, $ModelStaff;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('staff');
        $this->ModelStaff = new ModelStaff();
        $this->request = \Config\Services::request();
    }

    public function index()
    {
        $data['title'] = 'staff';
        $data['name'] = session()->get('name') ?? '';
        $data['company'] = session()->get('company') ?? '';
        return view('staff/index', $data);
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
        $password = $this->request->getPost('password');

        // Hash password
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
        $password = $this->request->getPost('password');

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
