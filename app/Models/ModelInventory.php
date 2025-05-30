<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelInventory extends Model
{
    protected $table = 'inventory';
    protected $allowedFields = ['company_id', 'product_id', 'product_stock'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at'; // If you want soft deletes
    protected $useSoftDeletes = true;
    public function add_inventory($data)
    {
        return $this->insert($data); // no need to pass $db
    }
}
