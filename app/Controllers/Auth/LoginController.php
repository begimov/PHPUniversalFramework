<?php

namespace App\Controllers\Auth;

use App\Views\View;
use App\Auth\Auth;
use App\Controllers\Controller;

class LoginController extends Controller
{
    protected $view;
    protected $auth;

    public function __construct(View $view, Auth $auth)
    {
        $this->view = $view;
        $this->auth = $auth;
    }

    public function index($request, $response)
    {
        return $this->view->render($response, 'auth/login.twig');
    }

    public function login($request, $response)
    {
        $data = $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $this->auth->attempt($data['email'], $data['password']);
    }
}