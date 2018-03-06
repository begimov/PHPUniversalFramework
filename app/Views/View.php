<?php

namespace App\Views;

use Twig_Environment;

class View
{
    protected $twig;

    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function render($response)
    {
        $response->getBody()->write('/');
        return $response;
    }
}
