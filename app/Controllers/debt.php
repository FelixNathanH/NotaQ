<?php

namespace App\Controllers;

use App\Models\ModelInvoice;
use App\Models\ModelCart;
use App\Models\ModelProduct;
use App\Models\ModelDebt;
use App\Services\ReminderService;


class debt extends Home
{
    protected $db, $builder, $ModelProduct, $ModelDebt, $ModelInvoice, $ModelCart;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('debt');
        $this->ModelProduct = new ModelProduct();
        $this->ModelDebt = new ModelDebt();
        $this->ModelInvoice = new ModelInvoice();
        $this->ModelCart = new ModelCart();
        $this->request = \Config\Services::request();
    }

    public function index()
    {
        $data['title'] = 'debt';
        $data['name'] = session()->get('name') ?? '';
        $data['company'] = session()->get('company') ?? '';
        $data['products'] = $this->ModelProduct->where('company_id', session()->get('company_id'))->findAll();
        return view('debt/index', $data);
    }

    public function getReminderFrequency()
    {
        $debtId = $this->request->getPost('debt_id');
        $debt = $this->ModelDebt->find($debtId);

        if ($debt && $debt['company_id'] == session()->get('company_id')) {
            return $this->response->setJSON(['reminder_frequency' => $debt['reminder_frequency']]);
        }

        return $this->response->setStatusCode(404)->setJSON(['error' => 'Debt not found']);
    }

    public function updateReminderFrequency()
    {
        $debtId = $this->request->getPost('debt_id');
        $frequency = (int)$this->request->getPost('reminder_frequency');

        if ($frequency < 1) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Frekuensi harus minimal 1 hari']);
        }

        $debt = $this->ModelDebt->find($debtId);
        if (!$debt || $debt['company_id'] != session()->get('company_id')) {
            return $this->response->setStatusCode(403)->setJSON(['error' => 'Unauthorized']);
        }

        $this->ModelDebt->update($debtId, ['reminder_frequency' => $frequency]);

        return $this->response->setJSON(['message' => 'Frekuensi pengingat berhasil diperbarui']);
    }



    public function debtDtb()
    {
        $companyId = session()->get('company_id');
        $debts = $this->ModelDebt->where('company_id', $companyId)->findAll();

        $data = [];
        foreach ($debts as $row) {
            // Calculate due date status
            $today = new \DateTime();
            $dueDate = new \DateTime($row['due_date']);
            $interval = $today->diff($dueDate);
            $daysDiff = (int)$interval->format('%r%a');

            // Format status badge
            $status = '';
            if ($row['status'] === 'paid') {
                $status = '<span class="badge badge-success">Lunas</span>';
            } elseif ($daysDiff < 0) {
                $status = '<span class="badge badge-danger">Terlambat</span>';
            } else {
                $status = '<span class="badge badge-warning text-dark">Aktif</span>';
            }

            // Add reminder & action buttons
            $action = '
            <button class="btn btn-sm btn-info btn-reminder" data-id="' . $row['debt_id'] . '">Kirim Reminder</button>
            <button class="btn btn-sm btn-success partial-pay-btn" data-id="' . $row['debt_id'] . '">Bayar Sebagian</button>
            <button class="btn btn-sm btn-warning edit-btn" data-id="' . $row['debt_id'] . '">Frekuensi Pengingat</button>
            <button class="btn btn-sm btn-danger delete-btn" data-id="' . $row['debt_id'] . '">Delete</button>
        ';

            // Add "days remaining" info
            $daysRemaining = $daysDiff >= 0
                ? "Sisa {$daysDiff} hari"
                : "<span class='text-danger'>Lewat " . abs($daysDiff) . " hari</span>";

            $data[] = [
                'invoice_id'       => $row['invoice_id'],
                'customer_name'    => $row['customer_name'],
                'customer_contact' => $row['customer_contact'],
                'customer_email'   => $row['customer_email'],
                'total_amount' => format_rupiah($row['total_amount']),
                'paid_amount' => format_rupiah($row['paid_amount']),
                'due_date'         => $row['due_date'] . "<br><small class='text-muted'>{$daysRemaining}</small>",
                'reminder_frequency' => $row['reminder_frequency'],
                'status'           => $status,
                'action'           => $action,
            ];
        }

        return $this->response->setJSON(['data' => $data]);
    }


    public function submit()
    {
        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            $invoiceModel = new ModelInvoice();
            $cartModel    = new ModelCart();
            $productModel = new ModelProduct();
            $debtModel    = new ModelDebt();

            $invoice_id = 'inv' . uniqid();
            $debt_id    = 'debt' . uniqid();

            $company_id = session()->get('company_id');
            $created_by = session()->get('user_id');

            // Collect request
            $transaction_time = $this->request->getPost('transaction_time');
            $customer_name    = $this->request->getPost('customer_name');
            $customer_contact = $this->request->getPost('customer_contact');
            $customer_email   = $this->request->getPost('customer_email');
            $payment_method   = $this->request->getPost('payment_method');
            $total_price      = $this->request->getPost('total_price');
            $payment_amount   = $this->request->getPost('payment_amount');
            $due_date         = $this->request->getPost('due_date');
            $amount_due       = $total_price - $payment_amount;
            $items            = json_decode($this->request->getPost('items'), true);

            // Insert invoice
            $invoiceModel->insert([
                'invoice_id'       => $invoice_id,
                'company_id'       => $company_id,
                'created_by'       => $created_by,
                'customer_name'    => $customer_name,
                'customer_contact' => $customer_contact,
                'customer_email'   => $customer_email,
                'payment_method'   => $payment_method,
                'transaction_time' => $transaction_time,
                'total_price'      => $total_price,
                'total_payment'    => $payment_amount,
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ]);

            // Insert items into cart
            foreach ($items as $item) {
                $cartModel->insert([
                    'invoice_id'           => $invoice_id,
                    'company_id'           => $company_id,
                    'product_id'           => $item['product_id'] ?? null,
                    'order_amount'         => $item['quantity'],
                    'order_price'          => $item['price'],
                    'order_note'           => $item['note'] ?? null,
                    'is_custom_product'    => $item['is_custom'] ?? false,
                    'custom_product_name'  => $item['custom_name'] ?? null,
                    'custom_product_price' => $item['custom_price'] ?? null,
                ]);

                // Reduce stock (if not custom)
                if (!($item['is_custom'] ?? false) && !empty($item['product_id'])) {
                    $productModel->where('product_id', $item['product_id'])
                        ->decrement('product_stock', $item['quantity']);
                }
            }

            // Save debt
            $debtModel->insert([
                'debt_id'           => $debt_id,
                'invoice_id'        => $invoice_id,
                'company_id'        => $company_id,
                'customer_name'     => $customer_name,
                'customer_contact'  => $customer_contact,
                'customer_email'    => $customer_email,
                'total_amount'      => $amount_due,
                'original_amount'    => $amount_due,
                'due_date'          => $due_date,
                'reminder_frequency' => 3, // or null if not used yet
                'reminder_method'   => 'none',
                'status'            => 'unpaid',
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);

            $db->transCommit();

            return $this->response->setJSON([
                'success'     => true,
                'message'     => 'Piutang berhasil disimpan.',
                'invoice_id'  => $invoice_id,
                'debt_id'     => $debt_id,
            ]);
        } catch (\Throwable $e) {
            $db->transRollback();
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menyimpan piutang: ' . $e->getMessage()
            ]);
        }
    }

    public function getDebtAmount()
    {
        $debtId = $this->request->getPost('debt_id');
        $debt = $this->ModelDebt->find($debtId);

        if (!$debt || $debt['company_id'] != session()->get('company_id')) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Debt tidak ditemukan']);
        }

        return $this->response->setJSON([
            'total_amount' => (int)$debt['total_amount'],
            'paid_amount'  => (int)$debt['paid_amount']
        ]);
    }

    public function submitPartialPayment()
    {
        $debtId = $this->request->getPost('debt_id');
        $amount = (int)$this->request->getPost('payment_amount');

        if ($amount <= 0) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Jumlah tidak valid']);
        }

        $debt = $this->ModelDebt->find($debtId);
        if (!$debt || $debt['company_id'] != session()->get('company_id')) {
            return $this->response->setStatusCode(403)->setJSON(['error' => 'Akses ditolak']);
        }

        // Calculate new values
        $newPaid = $debt['paid_amount'] + $amount;
        $newTotal = max(0, $debt['original_amount'] - $newPaid);
        $status = $newTotal <= 0 ? 'paid' : 'unpaid';

        $this->ModelDebt->update($debtId, [
            'paid_amount'  => $newPaid,
            'total_amount' => $newTotal,
            'status'       => $status,
        ]);

        return $this->response->setJSON(['message' => 'Pembayaran berhasil diproses.']);
    }




    // Send reminder (manual)
    public function sendReminder()
    {
        $debtId = $this->request->getPost('debt_id');
        $debt = $this->ModelDebt->find($debtId);

        if (!$debt) {
            return $this->response->setJSON(['status' => false, 'message' => 'Data tidak ditemukan']);
        }

        $email = \Config\Services::email();

        $email->setTo($debt['customer_email']);
        $email->setSubject('Pengingat Piutang dari NotaQ');
        $email->setMessage(view('emails/debt_reminder', ['debt' => $debt]));

        if ($email->send()) {
            return $this->response->setJSON(['status' => true, 'message' => 'Email pengingat berhasil dikirim.']);
        } else {
            return $this->response->setJSON(['status' => false, 'message' => 'Gagal mengirim email.']);
        }
    }

    // Trigger auto reminder
    public function triggerAutoReminder()
    {
        $reminderService = new ReminderService();
        $sentEmails = $reminderService->sendAutoReminders();

        return $this->response->setJSON([
            'success' => true,
            'count' => count($sentEmails),
            'sent' => $sentEmails,
        ]);
    }
}
