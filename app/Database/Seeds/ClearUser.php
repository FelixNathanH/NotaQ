<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClearUser extends Seeder
{
    public function run()
    {
        $this->db->table('user')->emptyTable();
        $this->db->query('ALTER TABLE user AUTO_INCREMENT = 1');
    }
}
