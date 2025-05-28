<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PasswordReset extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => "INT",
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'email' => [
                'type' => "VARCHAR",
                'constraint' => 255,
            ],
            'token' => [
                'type' => "VARCHAR",
                'constraint' => 255
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('password_resets');
    }

    public function down()
    {
        $this->forge->dropTable('password_resets');
    }
}
