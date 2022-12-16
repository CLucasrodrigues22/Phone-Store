<?php

namespace App\Controllers;

// recursos estáticos

use App\Models\Users;
use MVC\Controller\Action;
use MVC\Init\Bootstrap;
use MVC\Model\Container;

class UsersController extends Action
{
    // List all users
    public function index()
    {
        session_start();
        if ($_SESSION['id'] != '') {
            // getModel() de MVC\Model\Container
            $users = Container::getModel('Users');

            $this->view->dados = $users->showAll();

            $this->view('users/index', 'header');
        } else {
            header('Location: /?login=erro');
        }
    }

    // User registration form
    public function create()
    {
        session_start();
        if ($_SESSION['id'] != '') {
            $profiles = Container::getModel('profile');
            $this->view->dados = $profiles->showAll();
            $this->view('users/create', 'header');
        } else {
            header('Location: /?login=erro');
        }
    }

    // Save user's data in database
    public function store()
    {
        session_start();
        if ($_SESSION['id'] != '') {
            try {
                // getModel() de MVC\Model\Container
                $userData = Container::getModel('Users');

                $upload['diretorio'] = 'storage/users/';
                $upload['extensoes'] = ['jpg', 'png', 'gif'];

                $upload['erros'][0] = 'Não houve erro';
                $upload['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
                $upload['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
                $upload['erros'][3] = 'O upload do arquivo foi feito parcialmente';
                $upload['erros'][4] = 'Não foi feito o upload do arquivo';

                // Tratando imagem
                if ($_FILES['photo']['error'] === 0) {

                    // Dividindo o nome do nome da imagem (imagem . extensão)
                    $photo = explode('.', $_FILES['photo']['name']);
                    // Pegando a extensão da imagem
                    $extension = strtolower(end($photo));
                    // Validando Extensão
                    if (array_search($extension, $upload['extensoes']) === false) { // percorre array de $upload
                        // se tiver erro >
                        $feedback = 'Só é aceito arquivos com extensões jpg, png ou gif';
                        header("Location: /create?feedback=$feedback");
                        exit;
                    }

                    // nome para ser salvo no banco de dados
                    $namePhoto = md5($photo[0]) . '-' . date('YmdHmi') . '.' . $extension;

                    // Verifica se é possível mover o arquivo para a pasta escolhida
                    if (move_uploaded_file($_FILES['photo']['tmp_name'], $upload['diretorio'] . $namePhoto)) {
                        $userData->__set('photo', $namePhoto);
                    } else {
                        echo 'Ocorreu o seguinte erro' . $upload['erros'][$_FILES['photo']['error']];
                    }
                }

                // Setando os atributos com os valores recebidos no input
                $userData->__set('fullname', $_POST['fullname']);
                $userData->__set('profile_id', $_POST['profile_id']);
                $userData->__set('email', $_POST['email']);
                $userData->__set('senha', password_hash($_POST['senha'], PASSWORD_BCRYPT));

                // Validar condições estabelecidas no model e depois enviando dados atributos setados para o model inserir no banco
                $userData->create();

                $feedback = 'createsuccess';

                header("Location: /listusers?feedback=$feedback");
                exit;
            } catch (\PDOException $e) {
                //echo 'Erro, Banco de dados instavel'.' - '.$e;
                $feedback = 'createerror';

                header("Location: /createusers?feedback=$feedback");
                exit;
            }
        } else {
            header('Location: /?login=erro');
        }
    }

    // Show user for ID
    public function show()
    {
        session_start();
        if ($_SESSION['id'] != '') 
        {
            $id = $_GET['id'];

            $user = Container::getModel('Users');

            $this->view->dados = $user->show($id);

            $this->view('users/show', 'header');
        } else {
            header('Location: /?login=erro');
        }
    }

    // Update user
    public function update()
    {
        session_start();
        if ($_SESSION['id'] != '') 
        {
            try {
                $id = $_GET['id'];

                $user = Container::getModel('Users');

                $upload['diretorio'] = 'storage/users/';
                $upload['extensoes'] = ['jpg', 'png', 'gif'];

                $upload['erros'][0] = 'Não houve erro';
                $upload['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
                $upload['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
                $upload['erros'][3] = 'O upload do arquivo foi feito parcialmente';

                // Tratando imagem
                if ($_FILES['photo']['error'] === 0 && isset($_FILES['photo'])) {

                    // Remover foto atual do diretório
                    $photoOld = $user->show($id);
                    $path = $upload['diretorio'] . $photoOld['photo'];
                    unlink($path);

                    // Dividindo o nome do nome da nova imagem (imagem . extensão)
                    $photo = explode('.', $_FILES['photo']['name']);
                    // Pegando a extensão da imagem
                    $extension = strtolower(end($photo));
                    // Validando Extensão
                    if (array_search($extension, $upload['extensoes']) === false) { // percorre array de $upload
                        // se tiver erro >
                        $feedback = 'Só é aceito arquivos com extensões jpg, png ou gif';
                        header("Location: /create?feedback=$feedback");
                        exit;
                    }

                    // nome para ser salvo no banco de dados
                    $namePhoto = md5($photo[0]) . '-' . date('YmdHmi') . '.' . $extension;

                    // Verifica se é possível mover o arquivo para a pasta escolhida
                    if (move_uploaded_file($_FILES['photo']['tmp_name'], $upload['diretorio'] . $namePhoto)) {
                        $user->__set('photo', $namePhoto);
                    }
                } else {
                    //reculpera o nome da foto atual caso não foi feito nenhum upload
                    $photoOld = $user->show($id);
                    $user->__set('photo', $photoOld['photo']);
                }

                // Recuperando senha atual
                $senhaOld = $user->show($id);

                $user->__set('fullname', $_POST['fullname']);
                $user->__set('profile_id', $_POST['profile_id']);
                $user->__set('email', $_POST['email']);
                $user->__set('senha', $senhaOld['senha']);

                // Validar condições estabelecidas no model e depois enviando dados atributos setados para o model inserir no banco
                $user->update($id);

                $feedback = 'updatesuccess';

                header("Location: /listusers?feedback=$feedback");
                exit;
            } catch (\PDOException $e) {
                $feedback = 'updateerror';

                header("Location: /listusers?feedback=$feedback");
                exit;
            }
        } else {
            header('Location: /?login=erro');
        }
    }

    // Delete user
    public function delete()
    {
        session_start();
        if ($_SESSION['id'] != '') 
        {
            try {
                $id = $_GET['id'];

                $user = Container::getModel('Users');

                $dir = 'storage/users/';

                // Remover foto atual do diretório
                $photoOld = $user->show($id);
                $path = $dir . $photoOld['photo'];
                unlink($path);

                // Removendo dados do banco

                $user->__set('id', $id);

                $user->delete($id);

                $feedback = 'deletesuccess';

                header("Location: /listusers?feedback=$feedback");
                exit;
            } catch (\PDOException $e) {
                $feedback = 'deleteerror' . $e;

                header("Location: /listusers?feedback=$feedback");
                exit;
            }
        } else {
            header('Location: /?login=erro');
        }
    }

    // Alter Password user SESSION
    public function updatePassword()
    {
        session_start();
        if ($_SESSION['id'] != '') 
        {
            // Intanciando Model de usuários
            $user = Container::getModel('users');
            // Resgatando ID do usuário da sessão
            $id = $_POST['id'];
            // Nova senha
            $confirmaSenha = $_POST['senha'];

            $user->__set('senha', password_hash($confirmaSenha, PASSWORD_BCRYPT));
            $user->alterPassword($id);
            
            $feedback = 'pwdsuccess';

            header("Location: /home?feedback=$feedback");
            exit;
        } else
        {
            header('Location: /listusers');
        }



    }
}
