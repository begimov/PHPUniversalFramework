<?php

use App\Provides\AppServiceProvider;

$container = new League\Container\Container;

$container->addServiceProvider(new AppServiceProvider());