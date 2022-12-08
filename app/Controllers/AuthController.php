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
        $senha = $_POST['senha'];
        $user->__set('email', $_POST['email']);
        $userdata = $user->validateUser();

        if(is_array($userdata))
        {
            if(password_verify($senha, $userdata['senha'])) {
                session_start();
                $userData = $userdata;
                $feedback = 'Sessão iniciada';
                header("Location: /home?feedback=$feedback");
                exit;
            }else {
                $feedback = 'Usuário ou senha inválida, tente novamente!';
                header("Location: /?feedback=$feedback");
                exit;
            }
        } else {
            $feedback = 'Erro no login, favor contatar o Administrador';
            header("Location: /?feedback=$feedback");
            exit;
        }
    }
}
