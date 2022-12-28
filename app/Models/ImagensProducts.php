<?php

namespace App\Models;

use MVC\Model\Model;

class ImagensProducts extends Model 
{
    private $id;
    private $nome;
    private $path;
    private $smartphone_id;

    public function __get($attr)
    {
        return $this->$attr;
    }

    public function __set($attr, $value)
    {
        $this->$attr = $value;
    }

    public function showImgSmartphone($idSmartphone)
    {
        $q = "select id, nome, path from imagensProducts where smartphone_id = $idSmartphone";
        return $this->db->query($q)->fetch();
    }

    public function create()
    {
        $q = "insert into imagensProducts(nome, path, smartphone_id) values(:nome, :path, :smartphone_id)";
        $stmt = $this->db->prepare($q);
        $stmt->bindValue(':nome', $this->__get('nome'));
        $stmt->bindValue(':path', $this->__get('path'));
        $stmt->bindValue(':smartphone_id', $this->__get('smartphone_id'));
        $stmt->execute();

        return $this->db->lastInsertId();
    }
}
