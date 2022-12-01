<?php

namespace App\Controllers;

use stdClass;

class IndexController {
    
    private $view;
    public function __construct()
    {
        $this->view = new stdClass();
    }

    public function index() {
        $this->view->dados = array('Casa', 'Carro', 'Moto');
        $this->view('home/index');
    }

    public function view($view)  { // $this->view('dir/view');
        require_once "../resources/views/".$view.".phtml";
    }
}