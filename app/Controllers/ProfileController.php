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
        if ($_SESSION['id'] != '') {
            // getModel() de MVC\Model\Container
            $profiles = Container::getModel('profile');

            $this->view->dados = $profiles->showAll();

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
        session_start();
        if ($_SESSION['id'] != '') 
        {
            try {
                $profile = Container::getModel('profile');
            
                $profile->__set('profileName', $_POST['profileName']);
                $profile->__set('status', $_POST['status']);
                $profile->__set('vizualizar', $_POST['vizualizar']);
                $profile->__set('atualizar', $_POST['atualizar']);
                $profile->__set('cadastrar', $_POST['cadastrar']);
                $profile->__set('deletar', $_POST['deletar']);
                
                $profile->store();

                $feedback = 'createsuccess';
                header("Location: /listprofiles?feedback=$feedback");
                exit;
            } catch (\PDOException $e) {
                if($e->errorInfo[1]) {
                    $erro = $e->errorInfo[1];
                    $feedback = 'createerror';
                    header("Location: /listprofiles?feedback=$feedback&error=$erro");
                }
            }
        } else
        {
            header('Location: /?login=erro');
        }
    }

    public function show()
    {
        session_start();
        if ($_SESSION['id'] != '') 
        {
            $id = $_GET['id'];

            $profile = Container::getModel('profile');

            $this->view->dados = $profile->show($id);

            $this->view('profile/show', 'header');
        } else {
            header('Location: /?login=erro');
        }
    }

    public function update()
    {
        session_start();
        if ($_SESSION['id'] != '') 
        {
            try {
                // instanciando Model
                $profile = Container::getModel('profile');
                // Atribuindo valores do POST nos atributos do Model
                $profile->__set('id', $_POST['id']);
                $profile->__set('profileName', $_POST['profileName']);
                $profile->__set('status', $_POST['status']);
                $profile->__set('vizualizar', $_POST['vizualizar']);
                $profile->__set('cadastrar', $_POST['cadastrar']);
                $profile->__set('atualizar', $_POST['atualizar']);
                $profile->__set('deletar', $_POST['deletar']);
                // Executando método para atualizar
                $profile->update();

                $feedback = 'updatesuccess';
                header("Location: /listprofiles?feedback=$feedback");
                exit;
            } catch (\PDOException $e) {
                if($e->errorInfo[1]) {
                    $erro = $e->errorInfo[1];
                    $id = $_POST['id'];
                    $feedback = 'updateerror';
                    header("Location: /showuser?id=$id&feedback=$feedback&error=$erro");
                }
            }
        } else
        {
            header('Location: /?login=erro');
        }
    }

    public function delete()
    {
        session_start();
        if ($_SESSION['id'] != '') 
        {
            try {
                $profile = Container::getModel('profile');
                $id = $_GET['id'];
                $profile->destroy($id);
        
                $feedback = 'deletesuccess';
                header("Location: /listprofiles?feedback=$feedback");
                exit;
            } catch (\PDOException $e) {
                if($e->errorInfo[1]) {
                    $erro = $e->errorInfo[1];
                    $feedback = 'deleteerror';
                    header("Location: /listprofiles?id=$id&feedback=$feedback&error=$erro");
                }
            }
        } else
        {

        }
    }

}