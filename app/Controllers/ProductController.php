<?php

namespace App\Controllers;

// recursos estáticos

use App\Models\Product;
use MVC\Controller\Action;
use MVC\Init\Bootstrap;
use MVC\Model\Container;
use PDOException;

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
        session_start();
        if ($_SESSION['id'] != '') {
            try {
                $product = $_GET['p'];

                if ($product == 'newsmartphone') {
                    // Instanciando Model Smartphone
                    $smartphone = Container::getModel('Smartphone');

                    echo '<pre>';
                    // Tratando e salvando imagens

                    // Conferindo se quantas imagens foram selecionadas e se ultrapassa o limite de 5
                    $imagens = count($_FILES['photo']['name']);
                    if ($imagens <= 5) // Enquanto o total de imagens for menor ou igual a 5, faça isso
                    {
                        for ($i = 0; $i < $imagens; $i++) {
                            // diretório para armazenar imagens
                            $diretorio = 'storage/products/smartphones/';
                            // Extensões permitidas
                            $extensoes['extensoes'] = ['jpg', 'png'];
                            // Extensão de cada imagem do array
                            $nomeEextensao = explode('.', $_FILES['photo']['name'][$i]);
                            // Extensão de cada imagem
                            $extensao = strtolower(end($nomeEextensao));
                            // Nome da imagem para ser armazenada no bd
                            $nomeImg = $i . md5($nomeEextensao[0]) . date('YmdHmi') . '.' . $extensao;
                            if (array_search($extensao, $extensoes['extensoes']) === false) {
                                $feedback = 'errorextension';
                                header("Location: /createproduct?feedback=$feedback");
                                exit;
                            }

                            // Mover imagens para diretório
                            if (move_uploaded_file($_FILES['photo']['tmp_name'][$i], $diretorio . $nomeImg)) {
                                $smartphone->__set('photo' . $i, $nomeImg);
                            }
                        }
                    }

                    // Salvando demais atributos
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
            } catch (PDOException $e) {
                if ($e->errorInfo[1]) {
                    $erro = $e->errorInfo[1];
                    $feedback = 'createerror';
                    header("Location: /createproduct?feedback=$feedback&error=$erro");
                }
            }
        } else {
            header('Location: /?login=erro');
        }
    }

    public function show()
    {
        session_start();
        if ($_SESSION['id'] != '') {
            $product = $_GET['p'];

            if ($product == 'smartphone') {
                $id = $_GET['id'];
                $smartphone = Container::getModel('Smartphone');
                $this->view->smartphone = $smartphone->show($id);
                $this->view('products/show', 'header');
            }
        } else {
            header('Location: /?login=erro');
        }
    }

    public function update()
    {
        session_start();
        if ($_SESSION['id'] != '') {
            try {

                $product = $_GET['p'];
                $id = $_GET['id'];
                if ($product == 'smartphone') {
                    // diretório para armazenar imagens
                    $diretorio = 'storage/products/smartphones/';

                    $smartphone = Container::getModel('Smartphone');

                    if (!empty($_FILES['photo']['size'][0])) {
                        // Recuperando imagens antigas
                        $photoOld = $smartphone->show($id);
                        for ($i=0; $i <= 5; $i++) {
                            // Removendo nome das imagens da linha referente ao produto 
                            $path = $diretorio . $photoOld['photo'.$i];
                            unlink($path);
                        }
                        // Conferindo se quantas imagens foram selecionadas e se ultrapassa o limite de 5
                        $imagens = count($_FILES['photo']['name']);
                        if ($imagens <= 5) // Enquanto o total de imagens for menor ou igual a 5, faça isso
                        {
                            for ($i = 0; $i < $imagens; $i++) {
                                // Extensões permitidas
                                $extensoes['extensoes'] = ['jpg', 'png'];
                                // Extensão de cada imagem do array
                                $nomeEextensao = explode('.', $_FILES['photo']['name'][$i]);
                                // Extensão de cada imagem
                                $extensao = strtolower(end($nomeEextensao));
                                // Nome da imagem para ser armazenada no bd
                                $nomeImg = $i . md5($nomeEextensao[0]) . date('YmdHmi') . '.' . $extensao;
                                if (array_search($extensao, $extensoes['extensoes']) === false) {
                                    $feedback = 'errorextension';
                                    header("Location: /createproduct?feedback=$feedback");
                                    exit;
                                }
                                
                                // Mover imagens para diretório
                                if (move_uploaded_file($_FILES['photo']['tmp_name'][$i], $diretorio . $nomeImg)) {
                                    $smartphone->__set('photo' . $i, $nomeImg);
                                }
                            }
                        }
                    } else {
                        $photoOld = $smartphone->show($id);
                        for ($i=0; $i <= 5; $i++) {
                                //reculpera o nome da foto atual caso não foi feito nenhum upload
                                $smartphone->__set('photo'.$i, $photoOld['photo'.$i]);
                            }
                    }
                    // Salvando demais atributos
                    $smartphone->__set('marca', $_POST['marca']);
                    $smartphone->__set('modelo', $_POST['modelo']);
                    $smartphone->__set('sistema', $_POST['sistema']);
                    $smartphone->__set('camera', $_POST['camera']);
                    $smartphone->__set('memoria', $_POST['memoria']);
                    $smartphone->__set('ram', $_POST['ram']);
                    // Passando valores dos parametros para ser salvos no bd
                    $smartphone->update($id);

                    $feedback = 'smartphoneupdate';
                    header("Location: /listproducts?feedback=$feedback");
                    exit;
                }
            } catch (\PDOException $e) {
                if ($e->errorInfo[1]) {
                    $erro = $e->errorInfo[1];
                    $feedback = 'updateerror';
                    header("Location: /editproduct?id=$id&feedback=$feedback&error=$erro");
                    exit;
                }
            }
        } else {
            header('Location: /?login=erro');
        }
    }

    public function delete()
    {
        
    }
}
