<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelCart extends Model
{
    protected $table = 'cart';
    protected $allowedFields = ['invoice_id	', 'company_id', 'product_id', 'order_amount', 'order_price', 'is_custom_product', 'custom_product_name', 'custom_product_price'];
}
