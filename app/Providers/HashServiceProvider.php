<?php

namespace App\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;

use App\Auth\Hashing\IHasher;
use App\Auth\Hashing\BcryptHasher;

class HashServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        IHasher::class
    ];

    public function register()
    {
        $container = $this->getContainer();
        $container->share(IHasher::class, function () {
            return new BcryptHasher;
        });
    }
}
