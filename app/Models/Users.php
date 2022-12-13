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
    public function create() 
    {
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
    public function showAll() 
    {
        // $q = "select id, profile_id, fullname, email, photo from users";
        $q = "select
                U.id,
                U.fullname,
                U.email,
                U.photo,
                P.profileName as profiles
                from
                users U
                inner join 
                profiles P
                on U.profile_id = P.id";
        return $this->db->query($q)->fetchAll();
    }

    // Monstra dados do usuário por ID
    public function show($id) 
    {
        $q = "select id, profile_id, fullname, email, senha, photo from users where id = $id";
        return $this->db->query($q)->fetch();
    }

    public function update($id)
    {
        $q = "update users set profile_id = :profile_id, fullname = :fullname, email = :email, senha = :senha, photo = :photo where id = $id";
        $stmt = $this->db->prepare($q);
        $stmt->bindValue(':profile_id', $this->__get('profile_id'));
        $stmt->bindValue(':fullname', $this->__get('fullname'));
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->bindValue(':senha', $this->__get('senha'));
        $stmt->bindValue(':photo', $this->__get('photo'));
        $stmt->execute();
        
        return $this;
    }

    public function delete($id) 
    {
        $q = "delete from users where id = $id";
        $stmt = $this->db->prepare($q);
        $stmt->execute();
    }

    public function alterPassword($id)
    {
        $q = "update users set senha = :senha where id = $id";
        $stmt = $this->db->prepare($q);
        $stmt->bindValue(':senha', $this->__get('senha'));
        $stmt->execute();

        return $this;
    }
}