<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelStaff extends Model
{
    protected $table = 'staff';
    protected $allowedFields = ['staff_id', 'company_id', 'name', 'email', 'phone_number', 'government_id', 'password', 'company_role', 'created_at', 'updated_at'];
    protected $primaryKey = 'staff_id';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function add_staff($data)
    {
        return $this->insert($data);
    }
}
