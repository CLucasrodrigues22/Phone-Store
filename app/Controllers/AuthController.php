<?php

namespace App\Controllers;

// recursos estáticos

use App\Models\Auth;
use MVC\Controller\Action;
use MVC\Init\Bootstrap;
use MVC\Model\Container;

class AuthController extends Action 
{
    public function index() {
        $this->view('login/login', 'headerOut');
    }

    public function auth() {

        $user = Container::getModel('Auth');
        // Resgatando dados de login do formulário
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $senhaBcrypt = password_hash($_POST['senha'], PASSWORD_BCRYPT);

        $user->validateUser($email, $senhaBcrypt);

        if(password_verify($senha, $senhaBcrypt))
        {
            echo 'senha valida';
        } else {
            echo 'senha invalida';
        }
        
        
    }
}
