<?php

namespace App\Controllers\Auth;

use App\Views\View;
use App\Auth\Auth;
use App\Controllers\Controller;
use League\Route\RouteCollection;

class LoginController extends Controller
{
    protected $view;
    protected $auth;
    protected $router;

    public function __construct(View $view, Auth $auth, RouteCollection $router)
    {
        $this->view = $view;
        $this->auth = $auth;
        $this->router = $router;
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

        $attempt = $this->auth->attempt($data['email'], $data['password']);

        if (!$attempt) {
            $this->flash->now('error','User email and password dont match.');
            return redirect($request->getUri()->getPath());
        }

        return redirect($this->router->getNamedRoute('home')->getPath());
    }
}