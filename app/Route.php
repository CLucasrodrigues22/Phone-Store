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

        $routes['signin'] = array(
            'route' => '/signin',
            'controller' => 'SigninController',
            'action' => 'index'
        );

        $routes['createUser'] = array(
            'route' => '/createUser',
            'controller' => 'SigninController',
            'action' => 'createUser'
        );

        $this->setRoutes($routes);
    }
}