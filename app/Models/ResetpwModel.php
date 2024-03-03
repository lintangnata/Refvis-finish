<?php

namespace App\Models;

use CodeIgniter\Model;

class ResetpwModel extends Model
{
    protected $table      = 'resetpw';
    protected $useAutoIncrement = true;
    protected $primaryKey = 'id_reset';
    protected $useTimestamps =  true;
    protected $allowedFields = ['id_reset', 'email', 'token'];

    public function getToken($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id_reset' => $id])->first();
    }
}
