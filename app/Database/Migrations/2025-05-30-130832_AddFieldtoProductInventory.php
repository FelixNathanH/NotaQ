<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldtoProductInventory extends Migration
{
    public function up()
    {
        // Add timestamps to product table
        $this->forge->addColumn('product', [
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        // Add timestamps to inventory table
        $this->forge->addColumn('inventory', [
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
    }

    public function down()
    {
        // Remove timestamps from product table
        $this->forge->dropColumn('product', ['created_at', 'updated_at', 'deleted_at']);

        // Remove timestamps from inventory table
        $this->forge->dropColumn('inventory', ['created_at', 'updated_at', 'deleted_at']);
    }
}
