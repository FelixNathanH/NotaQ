<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Models\ModelDebt;
use CodeIgniter\Email\Email;

class AutoReminder extends BaseCommand
{
    protected $group       = 'Custom';
    protected $name        = 'reminder:auto';
    protected $description = 'Automatically send debt reminder emails';

    public function run(array $params)
    {
        $debtModel = new ModelDebt();
        $debts = $debtModel->where('status', 'unpaid')->findAll();

        $now = new \DateTime();
        $reminderCount = 0;

        foreach ($debts as $debt) {
            $dueDate = new \DateTime($debt['due_date']);
            $secondsOverdue = $now->getTimestamp() - $dueDate->getTimestamp();

            // 🔧 Simulated trigger: if the debt is overdue by at least 10 seconds
            if ($secondsOverdue >= 10) {
                $email = \Config\Services::email();

                $email->setTo($debt['customer_email']);
                $email->setSubject("🔔 Pengingat Hutang (Simulasi) - NotaQ");
                $email->setMessage("
                    <p>Halo <strong>{$debt['customer_name']}</strong>,</p>
                    <p>Ini adalah <em>pengingat otomatis (simulasi)</em> bahwa Anda memiliki sisa hutang sebesar 
                    <strong>Rp " . number_format($debt['total_amount'], 0, ',', '.') . "</strong>.</p>
                    <p>Jatuh tempo pada: <strong>{$debt['due_date']}</strong></p>
                    <p>Mohon segera melakukan pembayaran.</p>
                    <br>
                    <p>Terima kasih,</p>
                    <p><strong>NotaQ</strong></p>
                ");

                if ($email->send()) {
                    CLI::write("Reminder sent to {$debt['customer_email']} (Invoice: {$debt['invoice_id']})", 'green');
                    $reminderCount++;
                } else {
                    CLI::error("❌ Failed to send to {$debt['customer_email']}");
                }
            }
        }

        CLI::write("✅ Total simulated reminders sent: $reminderCount", 'yellow');
    }
}
