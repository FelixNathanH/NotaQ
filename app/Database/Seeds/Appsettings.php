<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Appsettings extends Seeder
{
    public function run()
    {
        $data = [
            [
                'key' => 'fromName',
                'value' => 'NotaQ'
            ],
            [
                'key' => 'fromEmail',
                'value' => 'testing.magang@gmail.com'
            ],
        ];
        //insert data
        $this->db->table('app_settings')->insertBatch($data);
    }
}
