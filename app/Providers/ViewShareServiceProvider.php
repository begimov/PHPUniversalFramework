<?php

namespace App\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;

use App\Views\View;

class ViewShareServiceProvider extends AbstractServiceProvider
{
    public function boot()
    {
        $container = $this->getContainer();

        $container->get(View::class)->share([
            'config' => $container->get('config')
        ]);
    }

    public function register()
    {
        //
    }
}
