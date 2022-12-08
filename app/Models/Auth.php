<?php

namespace App\Models;

use MVC\Model\Model;

class Auth extends Model 
{
    private $email;
    private $senha;

    public function __get($attr) {
        return $this->$attr;
    }

    public function __set($attr, $value) {
        $this->$attr = $value;
    }

    // User Validate
    public function validateUser($email, $senhaBcrypt)
    {
        $q = "select * from users where email = :email and senha = :senha";
        $stmt = $this->db->prepare($q);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senhaBcrypt);
        $stmt->execute();
        
        return $this;
    }
}