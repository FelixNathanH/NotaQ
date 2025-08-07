<?php
// app/Services/ReminderService.php
namespace App\Services;

use App\Models\ModelDebt;
use CodeIgniter\Email\Email;

class ReminderService
{
    // public function sendAutoReminders(): array
    // {
    //     $debtModel = new ModelDebt();
    //     $debts = $debtModel->where('status', 'unpaid')->findAll();
    //     $now = new \DateTime();
    //     $sent = [];

    //     foreach ($debts as $debt) {
    //         $dueDate = new \DateTime($debt['due_date']);
    //         $diffDays = (int)$now->diff($dueDate)->format('%r%a');
    //         $validDiffs = [-7, -3, -1, 0, 3];


    //         if (in_array($diffDays, $validDiffs)) {
    //             $email = \Config\Services::email();

    //             $email->setTo($debt['customer_email']);
    //             $email->setSubject("Pengingat Hutang - NotaQ");
    //             $email->setMessage("
    //                 Halo {$debt['customer_name']},<br><br>
    //                 Ini adalah pengingat otomatis bahwa Anda memiliki sisa hutang sebesar <b>Rp " . number_format($debt['total_amount'], 0, ',', '.') . "</b>.<br>
    //                 Jatuh tempo pada: <b>{$debt['due_date']}</b><br><br>
    //                 Mohon segera melakukan pembayaran.<br><br>
    //                 Terima kasih,<br>
    //                 <b>NotaQ</b>
    //             ");

    //             if ($email->send()) {
    //                 $sent[] = $debt['customer_email'];
    //             }
    //         }
    //     }

    //     return $sent;
    // }

    public function sendAutoReminders(): array
    {
        $debtModel = new ModelDebt();
        $debts = $debtModel->where('status', 'unpaid')->findAll();
        $now = new \DateTime();
        $sent = [];

        foreach ($debts as $debt) {
            $dueDate = new \DateTime($debt['due_date']);
            $diffDays = (int)$now->diff($dueDate)->format('%r%a'); // positive if due in future, negative if overdue

            // Parse reminder_frequency as integer days (assumed to be days)
            $frequency = (int)$debt['reminder_frequency'];
            if ($frequency <= 0) {
                $frequency = 3; // default frequency fallback if invalid value
            }

            $sendReminder = false;

            if ($diffDays >= 0) {
                // Before or on due date:
                // Send if today is due date OR days left is divisible by frequency
                if ($diffDays === 0) {
                    $sendReminder = true;
                } elseif ($diffDays % $frequency === 0) {
                    $sendReminder = true;
                }
            } else {
                // Overdue reminders:
                // Send reminder every 3 days overdue (you can make this customizable if you want)
                $overdueFrequency = 3;
                $daysOverdue = abs($diffDays);

                if ($daysOverdue % $overdueFrequency === 0) {
                    $sendReminder = true;
                }
            }

            if ($sendReminder) {
                $email = \Config\Services::email();

                $email->setTo($debt['customer_email']);
                $email->setSubject("Pengingat Hutang - NotaQ");
                $email->setMessage("
                Halo {$debt['customer_name']},<br><br>
                Ini adalah pengingat otomatis bahwa Anda memiliki sisa hutang sebesar <b>Rp " . number_format($debt['total_amount'], 0, ',', '.') . "</b>.<br>
                Jatuh tempo pada: <b>{$debt['due_date']}</b><br><br>
                Mohon segera melakukan pembayaran.<br><br>
                Terima kasih,<br>
                <b>NotaQ</b>
            ");

                if ($email->send()) {
                    $sent[] = $debt['customer_email'];
                }
            }
        }

        return $sent;
    }
}
