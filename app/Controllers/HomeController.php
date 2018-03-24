<?php

namespace App\Controllers;

use App\Views\View;
use App\Auth\Hashing\IHasher;

class HomeController
{
    protected $view;
    protected $hasher;

    public function __construct(View $view, IHasher $hasher)
    {
        $this->view = $view;
        $this->hasher = $hasher;
    }

    public function index($request, $response)
    {
        dump($this->hasher->create('dfsdfs'));
        return $this->view->render($response, 'home.twig');
    }
}
