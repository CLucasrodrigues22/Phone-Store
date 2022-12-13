<?php

namespace App\Controllers;

// recursos estáticos

use App\Models\Profile;
use MVC\Controller\Action;
use MVC\Init\Bootstrap;
use MVC\Model\Container;    

class ProfileController extends Action 
{
    public function index()
    {
        session_start();
        if ($_SESSION['id'] != '') 
        {
            $this->view('profile/index', 'header');
        } else {
            header('Location: /?login=erro');
        }
    }
    
    public function create() 
    {
        session_start();
        if ($_SESSION['id'] != '') 
        {
            $this->view('profile/create', 'header');
        } else {
            header('Location: /?login=erro');
        }
    }

    public function store()
    {

    }

    public function show()
    {
        session_start();
        if ($_SESSION['id'] != '') 
        {
            
        } else {
            header('Location: /?login=erro');
        }
    }
}