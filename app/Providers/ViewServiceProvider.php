<?php

namespace App\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;

use Twig_Environment;
use Twig_Loader_Filesystem;
use Twig_Extension_Debug;
use App\Views\View;

class ViewServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        View::class
    ];

    public function register()
    {
        $container = $this->getContainer();

        $config = $container->get('config');

        $container->share(View::class, function() use ($config) {
            $loader = new Twig_Loader_Filesystem(base_path('views'));

            $twig = new Twig_Environment($loader, [
                'cache' => false,
                'debug' => $config->get('app.debug'),
            ]);

            $twig->addExtension(new Twig_Extension_Debug);

            return new View($twig);
        });
    }
}
