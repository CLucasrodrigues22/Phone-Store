<?php

namespace App\Models;

class Produto {

    protected $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function getProdutos()
    {
        $q = "select id, descricao, preco from tb_produtos";
        return $this->db->query($q)->fetchAll();
    }
 }