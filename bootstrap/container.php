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

$container->addServiceProvider(new AppServiceProvider());
$container->addServiceProvider(new ViewServiceProvider());
$container->addServiceProvider(new ConfigServiceProvider());