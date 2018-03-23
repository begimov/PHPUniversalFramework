<?php

namespace App\Views\Extensions;

class PathExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('route', [$this, 'route'])
        ];
    }

    public function route($name)
    {
        return '1';
    }
}
