<?php

use App\Providers\{
    AppServiceProvider,
    ViewServiceProvider,
    ConfigServiceProvider
};

$container = new League\Container\Container;

$container->delegate(
    new League\Container\ReflectionContainer
);

$container->addServiceProvider(new ConfigServiceProvider());

foreach ($container->get('config')->get('app.providers') as $provider) {
    $container->addServiceProvider($provider);
}
