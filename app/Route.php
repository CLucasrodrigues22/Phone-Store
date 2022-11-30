<?php

namespace App;
class Route {

    private $routes;

    // metodo construtor
    public function __construct()
    {   
        $this->initRoutes();
        $this->run($this->getUrl());
    }
    
    // gets e sets de rotas
    public function getRoutes() {
        return $this->routes;
    }

    public function setRoutes(array $routes) {
        $this->routes = $routes;
    }

    // função para iniciar rotas
    public function initRoutes() {

        $routes['home'] = array(
            'route' => '/',
            'controller' => 'IndexController',
            'action' => 'index'
        );

        $routes['sobre'] = array(
            'route' => '/sobre',
            'controller' => 'SobreController',
            'action' => 'sobre'
        );

        $routes['contato'] = array(
            'route' => '/contato',
            'controller' => 'ContatoController',
            'action' => 'contato'
        );

        $this->setRoutes($routes);
    }

    public function run($url) {
        foreach($this->getRoutes() as $key => $route) {
            echo '<pre>';
            print_r($route['action']);
            if($url == $route['route']) {
                // criando a classe
                $classController = "App\\Controllers\\".$route['controller']; 

                // instanciando a classe
                $controller = new $classController;

                // resgatando a action do controller de acordo com a rota requisitada
                $action = $route['action'];

                // executando a action 
                $controller->$action();
            }
        }
    }
    // Obtendo o path atual do usuário
    public function getUrl() {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}