<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    protected $table = 'user';
    protected $allowedFields = ['user_id', 'name', 'email', 'company', 'phone_number', 'password', 'token', 'is_verified', 'created_at', 'updated_at'];
    protected $primaryKey = 'user_id'; // Assuming 'id' is your primary key.
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getUserByEmail($email)
    {
        return $this->db->table('user')
            ->select('user.*, company.company_id')
            ->join('company', 'company.user_id = user.user_id', 'left')
            ->where('user.email', $email)
            ->get()
            ->getRowArray();
    }

    public function add_dataUser($data)
    {
        return $this->insert($data);
    }

    public function tokenRequest($token)
    {
        $builder = $this->db->table('user');
        $builder->select('token, created_at');
        $builder->where('token', $token);
        $user = $builder->get()->getRowArray();
        return $user;
    }

    public function getToken($token)
    {
        $builder = $this->db->table('user');
        $builder->select('*');
        $builder->where('token', $token);
        $user = $builder->get()->getFirstRow();
        return $user;
    }

    public function emailValid($email)
    {
        $builder = $this->db->table('user');
        $builder->select('email');
        $builder->where('email', $email);
        $user = $builder->get()->getFirstRow();
        return $user;
    }

    public function updateByEmail($email, $data)
    {
        $builder = $this->db->table('user');
        $builder->where('email', $email);
        return $builder->update($data);
    }
}
