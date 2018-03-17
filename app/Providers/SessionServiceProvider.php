<?php

namespace App\Providers;

use App\Session\Session;
use App\Session\ISession;
use League\Container\ServiceProvider\AbstractServiceProvider;

class SessionServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        ISession::class
    ];

    public function register()
    {
        $container = $this->getContainer();

        $container->share(ISession::class, function () {
            return new Session();
        });
    }
}
