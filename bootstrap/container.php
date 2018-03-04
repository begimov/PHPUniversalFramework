<?php

use App\Providers\AppServiceProvider;

$container = new League\Container\Container;

$container->addServiceProvider(new AppServiceProvider());