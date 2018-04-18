<?php

namespace App\Controllers;

use App\Views\View;
use App\Auth\Auth;
use App\Cookie\CookieJar;

class HomeController
{
    protected $view;
    protected $cookie;

    public function __construct(View $view, CookieJar $cookie)
    {
        $this->view = $view;
        $this->cookie = $cookie;
    }

    public function index($request, $response)
    {
        $this->cookie->set('name', 'value');
        
        return $this->view->render($response, 'home.twig');
    }
}
