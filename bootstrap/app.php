<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $dotenv = (new Dotenv\Dotenv(base_path()))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

require_once base_path('bootstrap/container.php');

$session = $container->get(App\Session\ISession::class);
$session->set('name', 'gb');
$session->set(['key1' => 'v1', 'key2' => 2]);
dump($_SESSION);
$session->clear('name', 'key2');
dump($_SESSION);

$route = $container->get(League\Route\RouteCollection::class);

require_once base_path('routes/web.php');

try {
    $response = $route->dispatch(
        $container->get('request'), $container->get('response')
    );
} catch (\Exception $e) {
    $response = (new App\Exceptions\Handler($e))->respond();
}
