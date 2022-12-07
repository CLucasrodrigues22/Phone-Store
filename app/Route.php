<?php

namespace App;

use MVC\Init\Bootstrap;

class Route extends Bootstrap {

    // função para iniciar rotas
    protected function initRoutes() {

        // Rota Index Principal
        $routes['home'] = array(
            'route' => '/',
            'controller' => 'IndexController',
            'action' => 'index'
        );
        
        // Rotas de CRUD usuários
        $routes['listusers'] = array(
            'route' => '/listusers',
            'controller' => 'UsersController',
            'action' => 'index'
        );

        $routes['createusers'] = array(
            'route' => '/createusers',
            'controller' => 'UsersController',
            'action' => 'create'
        );

        $routes['storeusers'] = array(
            'route' => '/storeusers',
            'controller' => 'UsersController',
            'action' => 'store'
        );

        $routes['showuser'] = array (
            'route' => '/showuser',
            'controller' => 'UsersController',
            'action' => 'show'
        );

        $routes['updateuser'] = array (
            'route' => '/updateuser',
            'controller' => 'UsersController',
            'action' => 'update'
        );

        $this->setRoutes($routes);
    }
}