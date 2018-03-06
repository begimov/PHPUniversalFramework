<?php

namespace App\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;

class ViewServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        //
    ];

    public function register()
    {
        $container = $this->getContainer();

        $loader = new Twig_Loader_Filesystem(__DIR__ . '/../../views');

        $twig = new Twig_Enviroment($loader, [
            'cache' => false
        ]);
    }
}