<?php

namespace App;

use MVC\Init\Bootstrap;

class Route extends Bootstrap {

    // função para iniciar rotas
    protected function initRoutes() {
        
        // Rotas de Sessão do usuário
            // Rota de formulário de login
            $routes['login'] = array (
                'route' => '/',
                'controller' => 'AuthController',
                'action' => 'index'
            );

            // Rota para validar login
            $routes['auth'] = array (
                'route' => '/auth',
                'controller' => 'AuthController',
                'action' => 'auth'
            );

            // Rota para encerrar sessão
            $routes['logout'] = array (
                'route' => '/logout',
                'controller' => 'AuthController',
                'action' => 'logout'
            );

        // Rota privadas da aplicação
            // Rota de incio
            $routes['home'] = array (
                'route' => '/home',
                'controller' => 'IndexController',
                'action' => 'index'
            );
            
            // Lista de todos os usuários
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

            // Deletar usuário do banco
            $routes['deleteuser'] = array (
                'route' => '/deleteuser',
                'controller' => 'UsersController',
                'action' => 'delete'
            );
            
            // Formulário de criação de perfil
            $routes['createprofile'] = array (
                'route' => '/createprofile',
                'controller' => 'ProfileController',
                'action' => 'create'
            );

        $this->setRoutes($routes);
    }
}