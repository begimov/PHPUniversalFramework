<?php

use App\Providers\AppServiceProvider;
use App\Providers\ViewServiceProvider;

$container = new League\Container\Container;

$container->delegate(
    new League\Container\ReflectionContainer
);

$container->addServiceProvider(new AppServiceProvider());
$container->addServiceProvider(new ViewServiceProvider());