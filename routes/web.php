<?php

// $route->get('/', 'App\Controllers\HomeController::index')->setName('home');
$route->get('/', function($request, $response) use ($container) {
    return (new App\Controllers\HomeController($container->get(App\Views\View::class)))->index($request, $response);
})->setName('home');