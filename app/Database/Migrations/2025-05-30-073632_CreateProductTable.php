<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'product_id'         => ['type' => 'VARCHAR', 'constraint' => 255],
            'company_id'         => ['type' => 'VARCHAR', 'constraint' => 255],
            'product_name'       => ['type' => 'VARCHAR', 'constraint' => 255],
            'product_price'      => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'product_description' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        ]);
        $this->forge->addKey('product_id', true);
        $this->forge->addForeignKey('company_id', 'company', 'company_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('product');
    }

    public function down()
    {
        $this->forge->dropTable('product');
    }
}
