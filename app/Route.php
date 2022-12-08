<?php

namespace App;

use MVC\Init\Bootstrap;

class Route extends Bootstrap {

    // função para iniciar rotas
    protected function initRoutes() {
        
        // Rotas de Sessão do usuário
        $routes['login'] = array (
            'route' => '/',
            'controller' => 'AuthController',
            'action' => 'index'
        );

        $routes['auth'] = array (
            'route' => '/auth',
            'controller' => 'AuthController',
            'action' => 'auth'
        );

        // Rota Index Principal
        $routes['home'] = array (
            'route' => '/home',
            'controller' => 'IndexController',
            'action' => 'index'
        );
        
        // Rotas de CRUD usuários
        $routes['listusers'] = array (
            'route' => '/listusers',
            'controller' => 'UsersController',
            'action' => 'index'
        );

        // Formulário de criação de usuários
        $routes['createusers'] = array (
            'route' => '/createusers',
            'controller' => 'UsersController',
            'action' => 'create'
        );

        // Salva usuário no banco
        $routes['storeusers'] = array (
            'route' => '/storeusers',
            'controller' => 'UsersController',
            'action' => 'store'
        );

        // Montra dados do usuário pelo ID
        $routes['showuser'] = array (
            'route' => '/showuser',
            'controller' => 'UsersController',
            'action' => 'show'
        );

        // Atualiza dados do usuário no banco
        $routes['updateuser'] = array (
            'route' => '/updateuser',
            'controller' => 'UsersController',
            'action' => 'update'
        );

        $routes['deleteuser'] = array (
            'route' => '/deleteuser',
            'controller' => 'UsersController',
            'action' => 'delete'
        );
        $this->setRoutes($routes);
    }
}