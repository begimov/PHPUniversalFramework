<?php

namespace App\Controllers;

use App\Views\View;
use App\Auth\Auth;

class HomeController
{
    protected $view;

    public function __construct(View $view, Auth $auth)
    {
        $this->view = $view;
    }

    public function index($request, $response)
    {
        return $this->view->render($response, 'home.twig', [
            'user' => $auth->user()
        ]);
    }
}
