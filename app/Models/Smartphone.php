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
    private $photo0;
    private $photo1;
    private $photo2;
    private $photo3;
    private $photo4;

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
        $q = "insert into smartphones(marca, modelo, sistema, camera, memoria, ram, photo0, photo1, photo2, photo3, photo4) values (:marca, :modelo, :sistema, :camera, :memoria, :ram, :photo0, :photo1, :photo2, :photo3, :photo4)";
        $stmt = $this->db->prepare($q);
        $stmt->bindValue(':marca', $this->__get('marca'));
        $stmt->bindValue(':modelo', $this->__get('modelo'));
        $stmt->bindValue(':sistema', $this->__get('sistema'));
        $stmt->bindValue(':camera', $this->__get('camera'));
        $stmt->bindValue(':memoria', $this->__get('memoria'));
        $stmt->bindValue(':ram', $this->__get('ram'));
        $stmt->bindValue(':photo0', $this->__get('photo0'));
        $stmt->bindValue(':photo1', $this->__get('photo1'));
        $stmt->bindValue(':photo2', $this->__get('photo2'));
        $stmt->bindValue(':photo3', $this->__get('photo3'));
        $stmt->bindValue(':photo4', $this->__get('photo4'));
        $stmt->execute();

        return $this;
    }

}