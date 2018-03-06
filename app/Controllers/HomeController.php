<?php

namespace App\Controllers;

class HomeController
{
    protected $view;

    public function __construct($view)
    {
        $this->view = $view;
    }

    public function index($request, $response)
    {
        return $this->view->render($response);
    }
}
