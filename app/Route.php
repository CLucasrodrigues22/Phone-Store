<?php

namespace App;

class Route {

    // função para iniciar rotas
    public function initRoutes() {

        $routes['home'] = array(
            'route' => '/',
            'controller' => 'indexController',
            'action' => 'index'
        );

        $routes['sobre_nos'] = array(
            'route' => '/sobre_nos',
            'controller' => 'sobreController',
            'action' => 'sobre_nos'
        );
    }

    // Obtendo URL
    public function getUrl() {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}