<?php

namespace App\Controllers;

use App\Views\View;
use App\Auth\Auth;

class HomeController
{
    protected $view;
    protected $authview;

    public function __construct(View $view, Auth $auth)
    {
        $this->view = $view;
        $this->auth = $auth;
    }

    public function index($request, $response)
    {
        return $this->view->render($response, 'home.twig', [
            'user' => $this->auth->user()
        ]);
    }
}
