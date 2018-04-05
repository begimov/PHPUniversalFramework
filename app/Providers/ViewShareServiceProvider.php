<?php

namespace App\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

use App\Views\View;

class ViewShareServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    public function boot()
    {
        $container = $this->getContainer();

        $container->get(View::class)->share([
            'config' => $container->get('config'),
            'auth' => $container->get(\App\Auth\Auth::class),
            'flash' => $container->get(\App\Session\Flash::class),
            'csrf' => $container->get(\App\Security\Csrf::class)
        ]);
    }

    public function register()
    {
        //
    }
}
