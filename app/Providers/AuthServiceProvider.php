<?php

namespace App\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;

class AuthServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        //
    ];

    public function register()
    {
        $container = $this->getContainer();
    }
}
