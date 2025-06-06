<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldtoInvoice extends Migration
{
    public function up()
    {
        // Add timestamps to product table
        $this->forge->addColumn('invoice', [
            'payment_method' => ['type' => 'VARCHAR', 'constraint' => 255],
        ]);
    }

    public function down()
    {
        // Remove timestamps from product table
        $this->forge->dropColumn('invoice', ['payment_method']);
    }
}
