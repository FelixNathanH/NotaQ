<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelProduct extends Model
{
    protected $table = 'product';
    protected $allowedFields = ['company_id', 'product_name', 'product_price', 'product_description'];
    protected $primaryKey = 'product_id';

    public function add_product($data, $db)
    {
        return $db->table('product')->insert($data);
    }
}
