<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldtoProduct extends Migration
{
    public function up()
    {
        // Add timestamps to product table
        $this->forge->addColumn('product', [
            'product_stock' => ['type' => 'INT'],
        ]);
    }

    public function down()
    {
        // Remove timestamps from product table
        $this->forge->dropColumn('product', ['product_stock']);
    }
}
