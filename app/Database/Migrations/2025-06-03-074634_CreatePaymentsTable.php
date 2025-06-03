<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'payment_id'     => ['type' => 'VARCHAR', 'constraint' => 255],
            'invoice_id'     => ['type' => 'VARCHAR', 'constraint' => 255],
            'payment_time'   => ['type' => 'DATETIME'],
            'payment_amount' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'payment_method' => ['type' => 'VARCHAR', 'constraint' => 255],
        ]);
        $this->forge->addKey('payment_id', true);
        $this->forge->addForeignKey('invoice_id', 'invoice', 'invoice_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('payment');
    }

    public function down()
    {
        $this->forge->dropTable('payment');
    }
}
