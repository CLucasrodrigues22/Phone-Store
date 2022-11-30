<?php

    // require autoload.php for class
    require_once "../vendor/autoload.php";

    // use routes
    use App\Route;


    $route = new Route();
    echo '<pre>';
    print_r($route->getUrl());




    