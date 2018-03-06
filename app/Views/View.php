<?php

namespace App\Views;

use Twig_Enviroment;

class View
{
    protected $twig;

    public function __construct(Twig_Enviroment $twig)
    {
        $this->twig = $twig;
    }

    public function render($response)
    {
        return $response->getBody()->write('/');
    }
}
