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
            // ------------------------- Usuário -------------------------
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

            // Alterar senha do usuário
            $routes['updatepassword'] = array (
                'route' => '/updatepassword',
                'controller' => 'UsersController',
                'action' => 'updatePassword'
            );
            
            // ------------------------- Perfis -------------------------

            // Lista de todos os tipos de perfis 
            $routes['listprofiles'] = array (
                'route' => '/listprofiles',
                'controller' => 'ProfileController',
                'action' => 'index'
            );

            // Formulário de criação de perfil
            $routes['createprofile'] = array (
                'route' => '/createprofile',
                'controller' => 'ProfileController',
                'action' => 'create'
            );
            
            // Armazenar dados do perfil no banco
            $routes['storeprofile'] = array (
                'route' => '/storeprofile',
                'controller' => 'ProfileController',
                'action' => 'store'
            );

            // Mostrar dados do perfil por ID
            $routes['showprofile'] = array (
                'route' => '/showprofile',
                'controller' => 'ProfileController',
                'action' => 'show'
            );

            // Atualização de perfil
            $routes['updateprofile'] = array (
                'route' => '/updateprofile',
                'controller' => 'ProfileController',
                'action' => 'update'
            );

            // Deletar perfil do banco
            $routes['deleteprofile'] = array (
                'route' => '/deleteprofile',
                'controller' => 'ProfileController',
                'action' => 'delete'
            );

        $this->setRoutes($routes);
    }
}