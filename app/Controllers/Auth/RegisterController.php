<?php

namespace App\Controllers\Auth;

use App\Models\User;
use App\Views\View;
use App\Auth\Auth;
use App\Session\Flash;
use App\Controllers\Controller;
use League\Route\RouteCollection;

class RegisterController extends Controller
{
    protected $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function index($request, $response)
    {
        return $this->view->render($response, 'auth/register.twig');
    }

    public function register($request, $response)
    {
        $data = $this->validate($request, [
            'email' => ['required', 'email', ['exists', User::class]],
            'name' => ['required'],
            'password' => ['required'],
            'password_confirmation' => ['required', ['equals', 'password']]
        ]);

        $this->createUser($data);
    }

    protected function createUser($data)
    {
        $user = new User;
    }
}