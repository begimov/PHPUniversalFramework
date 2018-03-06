<?php

namespace App\Controllers;

class HomeController
{
    public function __construct($view)
    {
        var_dump($view);
    }

    public function index($request, $response)
    {
        $response->getBody()->write('/');
        return $response;
    }
}
