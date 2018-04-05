<?php

namespace App\Providers;

use App\Security\Csrf;
use League\Container\ServiceProvider\AbstractServiceProvider;

class CsrfServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        Csrf::class
    ];

    public function register()
    {
        $container = $this->getContainer();

        $container->share(Crsf::class, function () {
            return new Csrf;
        });
    }
}
