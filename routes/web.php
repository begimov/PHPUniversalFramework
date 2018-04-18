<?php

$route->get('/', 'App\Controllers\HomeController::index')->setName('home');

$route->group('', function ($route) {
    $route->get('/dashboard', 'App\Controllers\DashboardController::index')->setName('dashboard');
})->middleware($container->get(App\Middleware\Authenticated::class));

$route->group('/auth', function ($route) {
    $route->get('/login', 'App\Controllers\Auth\LoginController::index')->setName('auth.login');
    $route->post('/login', 'App\Controllers\Auth\LoginController::login');
    $route->post('/logout', 'App\Controllers\Auth\LogoutController::logout')->setName('auth.logout');

    $route->get('/register', 'App\Controllers\Auth\RegisterController::index')->setName('auth.register');
    $route->post('/register', 'App\Controllers\Auth\RegisterController::register');
});