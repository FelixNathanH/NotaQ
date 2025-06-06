<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldtoDebt extends Migration
{
    public function up()
    {
        // Add timestamps to product table
        $this->forge->addColumn('debt', [
            'original_amount' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'paid_amount' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
        ]);
    }

    public function down()
    {
        // Remove timestamps from product table
        $this->forge->dropColumn('debt', ['original_amount']);
        $this->forge->dropColumn('debt', ['paid_amount']);
    }
}
