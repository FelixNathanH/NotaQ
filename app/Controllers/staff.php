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
                'nama'        => $row['name'],
                'email'       => $row['email'],
                'telp'        => $row['phone_number'],
                'alamat'      => $row['government_id'],
                'group_name'  => $row['company_role'],
                'action'      => '<button class="btn btn-sm btn-warning">Edit</button>'
            ];
        }
        return $this->response->setJSON(['data' => $data]);
    }
}
