<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $dotenv = (new Dotenv\Dotenv(base_path()))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

$config = new App\Config\Config();
$config->load([
    new App\Config\Loaders\ArrayLoader([
    'app' => base_path('config/app.php'),
    'cache' => base_path('config/cache.php'),
    ])
]);

dump($config->get('app.version.numeric.ver'));
dump($config->get('app.name'));
dump($config->get('','dfgdfg'));
dump($config->get(''));

die();

require_once base_path('bootstrap/container.php');

$route = $container->get(League\Route\RouteCollection::class);

require_once base_path('routes/web.php');

$response = $route->dispatch(
    $container->get('request'), $container->get('response')
);