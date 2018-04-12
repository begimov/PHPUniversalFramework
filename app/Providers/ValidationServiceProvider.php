<?php

namespace App\Providers;

use Valitron\Validator;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

class ValidationServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    protected $provides = [
        //
    ];

    public function boot()
    {
        Validator::addRule('exists', function($column, $value, $params, $columns) {
            return false;
        }, 'already in use');
    }

    public function register()
    {
        //
    }
}
