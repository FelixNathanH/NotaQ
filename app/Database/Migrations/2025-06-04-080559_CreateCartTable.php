<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCartTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'invoice_id'            => ['type' => 'VARCHAR', 'constraint' => 255],
            'company_id'            => ['type' => 'VARCHAR', 'constraint' => 255],
            'product_id'            => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'order_amount'          => ['type' => 'INT'],
            'order_price'           => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'order_note'            => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'is_custom_product'     => ['type' => 'BOOLEAN'],
            'custom_product_name'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'custom_product_price'  => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        ]);

        $this->forge->addForeignKey('invoice_id', 'invoice', 'invoice_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('company_id', 'company', 'company_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('product_id', 'product', 'product_id', 'SET NULL', 'CASCADE');


        $this->forge->createTable('cart');
    }

    public function down()
    {
        $this->forge->dropTable('cart');
    }
}
