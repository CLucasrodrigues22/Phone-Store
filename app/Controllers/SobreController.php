<?php

namespace App\Controllers;

class SobreController {
    
    public function sobre() {
        $this->view('home/sobre');
    }

    public function view($view)  { // $this->view('dir/view');
        require_once "../resources/views/".$view.".phtml";
    }
}