<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInventoryTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'company_id'   => ['type' => 'VARCHAR', 'constraint' => 255],
            'product_id'   => ['type' => 'VARCHAR', 'constraint' => 255],
            'product_stock' => ['type' => 'INT'],
        ]);
        $this->forge->addForeignKey('company_id', 'company', 'company_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('product_id', 'product', 'product_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('inventory');
    }

    public function down()
    {
        $this->forge->dropTable('inventory');
    }
}
