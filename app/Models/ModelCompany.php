<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelCompany extends Model
{
    protected $table = 'company';
    protected $allowedFields = ['company_id', 'user_id', 'company_name', 'company_contact', 'company_description', 'created_at', 'updated_at'];
    protected $primaryKey = 'company_id';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
