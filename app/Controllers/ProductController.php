<?php

namespace App\Controllers;

// recursos estáticos

use App\Models\Product;
use MVC\Controller\Action;
use MVC\Init\Bootstrap;
use MVC\Model\Container;    

class ProductController extends Action 
{
    public function index()
    {
        session_start();
        if($_SESSION['id'] != '')
        {
            // Resgate de smartphones
            $smartphones = Container::getModel('Smartphone');
            $this->view->smartphones = $smartphones->showAll();
            // Fim resgate de smartphones


            // Renderização de view e layout
            $this->view('products/index', 'header');
        } else {
            header('Location: /?login=erro');
        }
    }

    public function create()
    {
        session_start();
        if($_SESSION['id'] != '')
        {
            $this->view('products/create', 'header');
        } else {
            header('Location: /?login=erro');
        }
    }

    public function store()
    {
        $product = $_GET['p'];

        if($product == 'newsmartphone')
        {
            echo '<pre>';
            // Tratando e salvando imagens

            // Conferindo se quantas imagens foram selecionadas e se ultrapassa o limite de 5
            $imagens = count($_FILES['photo']['name']);
            if($imagens <= 5)// Enquanto o total de imagens for menor ou igual a 5, faça isso
            {
                for($i = 0; $i < $imagens; $i++)
                {
                    // diretório para armazenar imagens
                    $diretorio = 'storage/products/smartphones/';
                    // Extensões permitidas
                    $extensoes['extensoes'] = ['jpg', 'png'];
                    // Extensão de cada imagem do array
                    $nomeEextensao = explode('.', $_FILES['photo']['name'][$i]);
                    // Extensão de cada imagem
                    $extensao = strtolower(end($nomeEextensao));
                    // Nome da imagem para ser armazenada no bd
                    $nomeImg = md5($nomeEextensao[0]).date('YmdHmi').'.'.$extensao;
                    if(array_search($extensao, $extensoes['extensoes']) === false)
                    {
                        $feedback = 'errorextension';
                        header("Location: /createproduct?feedback=$feedback");
                        exit;
                    }

                    // Mover imagens para diretório
                    if(move_uploaded_file($_FILES['photo']['tmp_name'][$i], $diretorio . $nomeImg))
                    {
                        echo 'img salva';
                    } else 
                    {
                        echo 'erro';
                    }

                }
            } else
            {
                
            } 
            
            print_r($nomeImg);  

            die;
            // Salvando demais atributos
            $smartphone = Container::getModel('Smartphone');
            $smartphone->__set('marca', $_POST['marca']);
            $smartphone->__set('modelo', $_POST['modelo']);
            $smartphone->__set('sistema', $_POST['sistema']);
            $smartphone->__set('camera', $_POST['camera']);
            $smartphone->__set('memoria', $_POST['memoria']);
            $smartphone->__set('ram', $_POST['ram']);
            $smartphone->create();

            $feedback = 'newsmartphonecreated';
            header("Location: /listproducts?feedback=$feedback");
            exit;
        }
    }

    public function show()
    {

    }

    public function update()
    {

    }

    public function delete()
    {
        
    }
}