<?php

namespace App\Providers;

use Valitron\Validator;
use Doctrine\ORM\EntityManager;
use App\Validation\Rules\ExistsRule;
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
            return (new ExistsRule($this->getContainer()->get(EntityManager::class)))
                        ->validate($column, $value, $params, $columns);
        }, 'already in use');
    }

    public function register()
    {
        //
    }
}
