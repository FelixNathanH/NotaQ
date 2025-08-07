<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClearCart extends Seeder
{
    public function run()
    {
        $this->db->table('cart')->emptyTable();
    }
}
