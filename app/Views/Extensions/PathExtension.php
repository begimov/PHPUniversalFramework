<?php

namespace App\Views\Extensions;

class PathExtension extends \Twig_Extension
{
    protected $router;

    public function __construct(\League\Route\RouteCollection $router)
    {
        $this->router = $router;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('route', [$this, 'route'])
        ];
    }

    public function route($name)
    {
        return $this->router->getNamedRoute($name)->getPath();
    }
}
