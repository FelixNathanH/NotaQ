<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AppSettings extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'key' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'value' => [
                'type'       => 'TEXT',
            ],
        ]);

        $this->forge->addKey('key', true); // Set key as the primary key
        $this->forge->createTable('app_settings');
    }

    public function down()
    {
        $this->forge->dropTable('app_settings');
    }
}
