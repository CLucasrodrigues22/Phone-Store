<?php

namespace App;

use MVC\Init\Bootstrap;

class Route extends Bootstrap {

    // função para iniciar rotas
    protected function initRoutes() {

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
}