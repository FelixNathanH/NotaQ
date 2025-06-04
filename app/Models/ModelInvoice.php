<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelInvoice extends Model
{
    protected $table = 'invoice';
    protected $primaryKey = 'invoice_id';
    protected $allowedFields = [
        'invoice_id',
        'company_id',
        'created_by',
        'customer_name',
        'customer_contact',
        'customer_email',
        'transaction_time',
        'total_price',
        'total_payment',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $returnType = 'array';
}
