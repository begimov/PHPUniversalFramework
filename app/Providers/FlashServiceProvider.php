<?php

namespace App\Providers;

use App\Session\Flash;
use App\Session\ISession;
use League\Container\ServiceProvider\AbstractServiceProvider;

class FlashServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        Flash::class
    ];

    public function register()
    {
        $container = $this->getContainer();

        $container->share(Flash::class, function () use ($container) {
            return new Flash($container->get(ISession::class));
        });
    }
}
