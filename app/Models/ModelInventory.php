<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelInventory extends Model
{
    protected $table = 'inventory';
    protected $allowedFields = ['company_id', 'product_id', 'product_stock'];

    public function add_inventory($data, $db)
    {
        return $db->table('inventory')->insert($data);
    }
}
