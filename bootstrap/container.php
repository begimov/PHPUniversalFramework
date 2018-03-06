<?php

use App\Providers\AppServiceProvider;
use App\Providers\ViewServiceProvider;

$container = new League\Container\Container;

$container->addServiceProvider(new AppServiceProvider());
$container->addServiceProvider(new ViewServiceProvider());