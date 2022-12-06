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
        // getModel() de MVC\Model\Container
        $userData = Container::getModel('Users');
        echo '<pre>';
        print_r($userData->showAll());

        $this->view('users/index', 'header');
        
    }

    // User registration form
    public function create()
    {
        $this->view('users/create', 'header');
    }

    // Save user's data in database
    public function store() {
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
                    echo 'erro';
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

            header("Location: /?feedback=$feedback");
            exit;
        } catch (\PDOException $e) {
            //echo 'Erro, Banco de dados instavel'.' - '.$e;
            $feedback = 'createerror';

            header("Location: /createusers?feedback=$feedback");
            exit;
        }
    }

    // Show user for ID
    public function show($id) {

    }

    // Update user
    public function update($id) {

    }

    // Delete user
    public function delete($id) {
        
    }
}
