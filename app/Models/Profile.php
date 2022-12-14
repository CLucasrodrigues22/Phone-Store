<?php

namespace App\Models;

use MVC\Model\Model;

class Profile extends Model
{

    private $id;
    private $profileName;

    public function __get($attr)
    {
        return $this->$attr;
    }

    public function __set($attr, $value)
    {
        $this->$attr = $value;
    }

    // Salvar dados
    public function create()
    {
        $q = "insert into profiles(id, profileName) values (:id, :profileName)";
        $stmt = $this->db->prepare($q);
        $stmt->bindValue(':id', $this->__get('id'));
        $stmt->bindValue(':profileName', $this->__get('profileName'));
        $stmt->execute();

        return $this;
    }

    // Recuperar todos os perfis
    public function showAll() 
    {
        $q = "select * from profiles";
        return $this->db->query($q)->fetchAll();
    }

    // Recupera dados pelo ID
    public function show($id)
    {
        $q = "select * from profiles where id = $id";
        return $this->db->query($q)->fetch();
    }
}
