<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDebtsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'debt_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'invoice_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'company_id' => [
                'type'       => 'VARCHAR',
                'constraint'   => 255,
            ],
            'customer_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'customer_contact' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'customer_email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'total_amount' => [
                'type' => 'BIGINT',
            ],
            'due_date' => [
                'type' => 'DATE',
            ],
            'reminder_frequency' => [
                'type'    => 'INT',
                'comment' => 'In days, e.g. every 3 days',
            ],
            'reminder_method' => [
                'type'    => 'ENUM("email", "whatsapp", "none")',
                'default' => 'none',
            ],
            'status' => [
                'type'    => 'ENUM("unpaid", "paid", "overdue")',
                'default' => 'unpaid',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('debt_id', true); // primary key
        $this->forge->addForeignKey('invoice_id', 'invoice', 'invoice_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('company_id', 'company', 'company_id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('debt');
    }


    public function down()
    {
        $this->forge->dropTable('debt');
    }
}
