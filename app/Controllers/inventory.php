<?php

namespace App\Controllers;

use app\Models\ModelProduct;
use app\Models\ModelInventory;

class invoice extends Home
{
    protected $db, $builder, $ModelProduct, $ModelInventory;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('invoice');
        $this->ModelProduct = new ModelProduct();
        $this->ModelInventory = new ModelInventory();
        $this->request = \Config\Services::request();
    }

    public function index()
    {
        $data['title'] = 'Inventory';
        $data['name'] = session()->get('name') ?? '';
        $data['company'] = session()->get('company') ?? '';
        return view('inventory/index', $data);
    }
}
