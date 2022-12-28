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
        if ($_SESSION['id'] != '') {
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
        if ($_SESSION['id'] != '') {
            $this->view('products/create', 'header');
        } else {
            header('Location: /?login=erro');
        }
    }

    public function store()
    {
        $product = $_GET['p'];

        if ($product == 'newsmartphone') {
            // Instanciando Model Smartphone
            $smartphone = Container::getModel('Smartphone');

            // Salvando demais atributos
            $smartphone->__set('marca', $_POST['marca']);
            $smartphone->__set('modelo', $_POST['modelo']);
            $smartphone->__set('sistema', $_POST['sistema']);
            $smartphone->__set('camera', $_POST['camera']);
            $smartphone->__set('memoria', $_POST['memoria']);
            $smartphone->__set('ram', $_POST['ram']);
            $id = $smartphone->create();
            $this->view->newsmartphone = $smartphone->show($id);
            // Renderização de view e layout
            $this->view('products/create', 'header');
            exit;
        }
    }

    public function storeImg()
    {
        $action = $_GET['action'];
        // Tratar e Salvar Imagem
        if ($action == 'newimgsmartphone') {
            // Instanciando Model de Imagens
            $newImg = Container::getModel('ImagensProducts');
            // Contabiliza quantas imagens foram submetidas
            $imagens = count($_FILES['photo']['name']);
            // Id do produto a ser atribuido a imagem
            $idSmartphone = $_POST['id'];
            // Diretória raiz de upload
            $upload['pasta_produtos'] = 'storage/products/smartphones/';
            // diretório para armazenar imagens
            $path = 'storage/products/smartphones/'.$idSmartphone.'/';
            // Caso diretório não exista, crie
            if(!is_dir($path)) {
                mkdir($upload['pasta_produtos'] . $idSmartphone . '/', 0775, true);
            }

            for ($i = 0; $i < $imagens; $i++) 
            {
                // Extensões permitidas
                $extensoes['extensoes'] = ['jpg', 'png'];
                // Extensão de cada imagem do array
                $nomeEextensao = explode('.', $_FILES['photo']['name'][$i]);
                // Extensão de cada imagem
                $extensao = strtolower(end($nomeEextensao));
                // Nome da imagem para ser armazenada no bd
                $nomeImg = $i . md5($nomeEextensao[0]) . date('YmdHmi') . '.' . $extensao;

                // Mover imagens para diretório
                if (move_uploaded_file($_FILES['photo']['tmp_name'][$i], $path . $nomeImg)) {
                    $newImg->__set('nome', $nomeImg);
                    $newImg->__set('path', $path);
                    $newImg->__set('smartphone_id', $idSmartphone);
                    $newImg->create();
                }
            }

            // Resgatar Imagens referente ao id
            $this->view->imgSmartphones = $newImg->showImgSmartphone($idSmartphone);
            
            // Instanciando Model Smartphone
            $smartphone = Container::getModel('Smartphone');
            $this->view->newsmartphone = $smartphone->show($idSmartphone);
            // Renderização de view e layout
            $this->view('products/create', 'header');
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
