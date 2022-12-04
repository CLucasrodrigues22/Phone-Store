<?php

namespace App\Models;

use MVC\Model\Model;

class Users extends Model {

    private $id;
    private $name;
    private $email;
    private $senha;

    public function __get($attr) {
        return $this->$attr;
    }

    public function __set($attr, $value) {
        $this->$attr = $value;
    }

    // Salvar dados
    public function create() {
        $q = "insert into users(profile_id, fullname, email, senha, photo) values (:profile_id, :fullname, :email, :senha, :photo)";
        $stmt = $this->db->prepare($q);
        $stmt->bindValue(':profile_id', $this->__get('profile_id'));
        $stmt->bindValue(':fullname', $this->__get('fullname'));
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->bindValue(':senha', $this->__get('senha'));
        $stmt->bindValue(':photo', $this->__get('photo'));
        $stmt->execute();

        return $this;
    }
    // Validar se um cadastro pode ser feito

    // Recuperar um usuário por e-mail
}