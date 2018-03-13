<?php

namespace App\Providers;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use League\Container\ServiceProvider\AbstractServiceProvider;

class DatabaseServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        EntityManager::class
    ];

    public function register()
    {
        $container = $this->getContainer();

        $config = $container->get('config');

        $container->share(EntityManager::class, function () use ($config) {
            $emConfig = $config->get('db.' . env('DB_CONNECTION'));

            $entityManager = EntityManager::create(
                $emConfig, 
                Setup::createAnnotationMetadataConfiguration(
                    [base_path('app')],
                    $config->get('app.debug')
                )
            );
            return $entityManager;
        });
    }
}
