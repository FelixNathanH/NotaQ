<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveCustomerAddressFromInvoice extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('invoice', 'customer_address');
    }

    public function down()
    {
        // Optional: add the column back in case of rollback
        $this->forge->addColumn('invoice', [
            'customer_address' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'after'      => 'customer_email' // position after this column
            ]
        ]);
    }
}
