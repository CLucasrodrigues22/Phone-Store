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

    // Recuperar todos os usuários
    public function showAll() 
    {
        $q = "select id, profileName from profiles";
        return $this->db->query($q)->fetchAll();
    }
}
