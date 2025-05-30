<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelInvoice extends Model
{
    protected $table = 'invoice';

    public function add_staff($data)
    {
        return $this->insert($data);
    }
}
