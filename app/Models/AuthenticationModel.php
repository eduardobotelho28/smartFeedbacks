<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthenticationModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'firstname'  ,
        'lastname'   ,  
        'email'      ,
        'password'   ,
        'created_at' ,
    ];

    public function register(array $data) {
        $data['password']   = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['created_at'] = date('Y-m-d H:i:s');

        return $this->insert($data);
    }

    public function getUserByEmail($email) {
        return $this->asArray()
                    ->where('email', $email)
                    ->first();
    }

}
