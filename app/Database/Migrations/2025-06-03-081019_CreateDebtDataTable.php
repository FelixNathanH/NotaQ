<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDebtDataTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'invoice_id'         => ['type' => 'VARCHAR', 'constraint' => 255],
            'company_id'         => ['type' => 'VARCHAR', 'constraint' => 255],
            'completed_payment'  => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'payment_deadline'   => ['type' => 'DATETIME'],
            'reminder_frequency' => ['type' => 'INT'],
            'debt_paid'          => ['type' => 'BOOLEAN'],
        ]);

        $this->forge->addForeignKey('invoice_id', 'invoice', 'invoice_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('company_id', 'company', 'company_id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('debt_data');
    }

    public function down()
    {
        $this->forge->dropTable('debt_data');
    }
}
