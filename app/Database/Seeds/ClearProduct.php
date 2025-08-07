<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClearProduct extends Seeder
{
    public function run()
    {
        $this->db->table('product')->emptyTable();
    }
}
