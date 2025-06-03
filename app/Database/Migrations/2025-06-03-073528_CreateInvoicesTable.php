<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInvoicesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'invoice_id'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'company_id'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_by'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'customer_name'     => ['type' => 'VARCHAR', 'constraint' => 255],
            'customer_contact'  => ['type' => 'VARCHAR', 'constraint' => 255],
            'customer_email'    => ['type' => 'VARCHAR', 'constraint' => 255],
            'customer_address'  => ['type' => 'VARCHAR', 'constraint' => 255],
            'transaction_time'  => ['type' => 'DATETIME'],
            'total_price'       => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'total_payment'     => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'created_at'        => ['type' => 'DATETIME', 'null' => true],
            'updated_at'        => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('invoice_id', true);
        $this->forge->addForeignKey('company_id', 'company', 'company_id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('invoice');
    }

    public function down()
    {
        $this->forge->dropTable('invoice');
    }
}
