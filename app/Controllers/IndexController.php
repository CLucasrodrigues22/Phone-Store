<?php

namespace App\Controllers;

use MVC\Controller\Action;

class IndexController extends Action{

    public function index() {
        $this->view->dados = array('Casa', 'Carro', 'Moto');
        $this->view('home/index', 'header');
    }
}