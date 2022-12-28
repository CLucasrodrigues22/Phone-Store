<?php

namespace App\Models;

use MVC\Model\Model;

class Smartphone extends Model 
{
    private $id;
    private $tipo;
    private $marca;
    private $modelo;
    private $sistema;
    private $camera;
    private $memoria;
    private $ram;

    public function __get($attr)
    {
        return $this->$attr;
    }

    public function __set($attr, $value)
    {
        $this->$attr = $value;
    }

    public function showAll()
    {
        $q = "select * from smartphones";
        return $this->db->query($q)->fetchAll();
    }

    public function show($id)
    {
        $q = "select * from smartphones where id = $id";
        return $this->db->query($q)->fetch();
    }

    public function create()
    {
        $q = "insert into smartphones(marca, modelo, sistema, camera, memoria, ram) values (:marca, :modelo, :sistema, :camera, :memoria, :ram)";
        $stmt = $this->db->prepare($q);
        $stmt->bindValue(':marca', $this->__get('marca'));
        $stmt->bindValue(':modelo', $this->__get('modelo'));
        $stmt->bindValue(':sistema', $this->__get('sistema'));
        $stmt->bindValue(':camera', $this->__get('camera'));
        $stmt->bindValue(':memoria', $this->__get('memoria'));
        $stmt->bindValue(':ram', $this->__get('ram'));
        $stmt->execute();

        return $this->db->lastInsertId();
    }

}