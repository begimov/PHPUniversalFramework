<?php

namespace App\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;

use App\Auth\Auth;
use App\Auth\Recaller;

class AuthServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        Auth::class
    ];

    public function register()
    {
        $container = $this->getContainer();

        $container->share(Auth::class, function () use ($container) {
            return new Auth(
                $container->get(\Doctrine\ORM\EntityManager::class),
                $container->get(\App\Auth\Hashing\IHasher::class),
                $container->get(\App\Session\ISession::class),
                new Recaller(),
                $container->get(\App\Cookie\CookieJar::class)
            );
        });
    }
}
