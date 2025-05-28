<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClearPass extends Seeder
{
    public function run()
    {
        $this->db->table('password_resets')->emptyTable();
        $this->db->query('ALTER TABLE password_resets AUTO_INCREMENT = 1');
    }
}
