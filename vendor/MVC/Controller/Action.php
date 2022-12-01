<?php

namespace MVC\Controller;
use stdClass;

abstract class Action {
    protected $view;

    public function __construct()
    {
        $this->view = new stdClass();
    }

    // renderiza o layout da aplicação passada por parametro no controller
    protected  function view($view, $layout)
    {
        $this->view->page = $view;

        //validando se o layout existe
        if(file_exists("../resources/views/layouts/".$layout.".phtml")) {
            require_once "../resources/views/layouts/".$layout.".phtml";
        } else {
            echo 'Layout não encontrado';
        }
    }
    
    // localiza e renderinza a view passada por parametro no controller
    protected function content() 
    {   // $this->view('dir/view');
        require_once "../resources/views/".$this->view->page.".phtml";
    }
}
