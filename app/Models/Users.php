<?php

namespace App\Models;

use MVC\Model\Model;

class Users extends Model {

    private $id;
    private $profile_id;
    private $fullname;
    private $email;
    private $senha;
    private $photo;

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

    // Recuperar todos os usuários
    public function showAll() {
        $q = "select * from users";
        $stmt = $this->db->prepare($q);
        $stmt->setFetchMode(\PDO::FETCH_CLASS);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}