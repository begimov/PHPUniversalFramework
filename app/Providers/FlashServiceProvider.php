<?php

namespace App\Providers;

use App\Session\Flash;
use League\Container\ServiceProvider\AbstractServiceProvider;

class FlashServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        Flash::class
    ];

    public function register()
    {
        $container = $this->getContainer();

        $container->share(Flash::class, function () {
            return new Flash();
        });
    }
}
