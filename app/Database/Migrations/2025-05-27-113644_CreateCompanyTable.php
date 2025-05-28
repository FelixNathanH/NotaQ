<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCompanyTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'company_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'user_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'company_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'company_contact' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'company_description' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('company_id', true); // primary key
        $this->forge->addForeignKey('user_id', 'User', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('Company');
    }

    public function down()
    {
        $this->forge->dropTable('Company');
    }
}
