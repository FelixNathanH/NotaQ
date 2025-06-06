<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDebt extends Model
{
    protected $table = 'debt';
    protected $allowedFields = [
        'debt_id',
        'invoice_id',
        'company_id',
        'customer_name',
        'customer_contact',
        'customer_email',
        'total_amount',
        'due_date',
        'reminder_frequency',
        'reminder_method',
        'status',
        'created_at',
        'updated_at',
        'original_amount',
        'paid_amount',
    ];
    protected $primaryKey = 'debt_id';
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
