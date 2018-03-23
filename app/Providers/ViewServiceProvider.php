<?php

namespace App\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;

use Twig_Environment;
use Twig_Loader_Filesystem;
use Twig_Extension_Debug;
use App\Views\View;
use App\Views\Extensions\PathExtension;

class ViewServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        View::class
    ];

    public function register()
    {
        $container = $this->getContainer();

        $config = $container->get('config');

        $router = $container->get(\League\Route\RouteCollection::class);

        $container->share(View::class, function() use ($config, $router) {
            $loader = new Twig_Loader_Filesystem(base_path('views'));

            $twig = new Twig_Environment($loader, [
                'cache' => $config->get('cache.views.path'),
                'debug' => $config->get('app.debug'),
            ]);

            if ($config->get('app.debug')) {
                $twig->addExtension(new Twig_Extension_Debug);
            }

            $twig->addExtension(new PathExtension($router));

            return new View($twig);
        });
    }
}
