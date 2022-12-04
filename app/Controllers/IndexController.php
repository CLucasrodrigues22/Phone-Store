<?php

namespace App\Controllers;

// recursos estáticos
use MVC\Controller\Action;
use MVC\Model\Container;

// Model


class IndexController extends Action{

    public function index() {

        $this->view('home/index', 'header');
    }
}