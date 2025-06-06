<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClearInvoice extends Seeder
{
    public function run()
    {
        $this->db->table('invoice')->emptyTable();
    }
}
