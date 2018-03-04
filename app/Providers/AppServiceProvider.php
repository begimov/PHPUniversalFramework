<?php

namespace App\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;

class AppServiceProvider extends AbstractServiceProvider
{
    protected $provides = ['test'];

    public function register()
    {
        $container = $this->getContainer();

        $container->share('test', function () {
            return 'TEST';
        });
    }
}
