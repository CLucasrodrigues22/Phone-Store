<?php

namespace App\Controllers;

// recursos estáticos
use MVC\Controller\Action;
use MVC\Model\Container;

// Model


class IndexController extends Action{

    
    public function index() 
    {
        session_start();
        if($_SESSION['id'] != '')
        {
            $this->view('home/index', 'header');
        } else {
            header('Location: /?login=erro');
        }
    }
}