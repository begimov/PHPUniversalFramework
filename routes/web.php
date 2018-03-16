<?php

// $route->get('/', 'App\Controllers\HomeController::index')->setName('home');
$route->get('/', 'App\Controllers\Auth\LoginController::index')->setName('auth.login');
$route->post('/', 'App\Controllers\Auth\LoginController::login');

// $route->group('/auth', function ($route) {
//     $route->get('/login', 'App\Controllers\Auth\LoginController::index')->setName('auth.login');
//     $route->post('/login', 'App\Controllers\Auth\LoginController::login');
// });