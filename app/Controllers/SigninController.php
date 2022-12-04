<?php

namespace App\Controllers;

// recursos estáticos

use App\Models\Users;
use MVC\Controller\Action;
use MVC\Init\Bootstrap;
use MVC\Model\Container;

class SigninController extends Action {

    public function index() {

        $this->view('home/signin', 'header');
    }

    public function createUser() {

        $upload['diretorio'] = '../../public/storage/users/';
        $upload['extensoes'] = ['jpg', 'png', 'gif'];

        $upload['erros'][0] = 'Não houve erro';
        $upload['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
        $upload['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
        $upload['erros'][3] = 'O upload do arquivo foi feito parcialmente';
        $upload['erros'][4] = 'Não foi feito o upload do arquivo';

        // Tratando imagem
        if($_FILES['photo']['error'] === 0) {
            echo '<pre>';
            // Dividindo o nome do nome da imagem (imagem . extensão)
            $photo = explode('.', $_FILES['photo']['name']);
            // Pegando a extensão da imagem
            $extension = strtolower(end($photo));
            // Validando Extensão
            if(array_search($extension, $upload['extensoes']) === false) { // percorre array de $upload
                // se tiver erro >
                $feedback = 'Só é aceito arquivos com extensões jpg, png ou gif';
                header("Location: /signin?feedback=$feedback");
                exit;
            }
            
            // nome para ser salvo no banco de dados
            $namePhoto = md5($photo[0]).'-'.date('Ymd').'.'.$extension;
        }
        
        // getModel() de MVC\Model\Container
        // $userData = Container::getModel('Users');

        // $userData->__set('nome', $_POST['fullname']);
        // $userData->__set('nome', $_POST['profile_id']);
        // $userData->__set('nome', $_POST['email']);
        // $userData->__set('nome', $_POST['senha']);
        // $userData->__set('nome', $_FILES['fullname']);
    }
}