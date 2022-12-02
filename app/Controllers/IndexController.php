<?php

namespace App\Controllers;

use MVC\Controller\Action;
use App\Connection;
use App\Models\Produto;

class IndexController extends Action{

    public function index() {
        
        // Instância de conexão com o DB
        $conn = Connection::getDb();

        // Instanciar o Model
        $produto = new Produto($conn);

        // Array de produtos
        $produtos = $produto->getProdutos();

        // Atribuindo a relação de produtos
        $this->view->dados = $produtos;

        $this->view('home/index', 'header');
    }
}