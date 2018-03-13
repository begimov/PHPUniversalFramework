<?php

namespace App\Controllers;

use App\Views\View;
use App\Models\User;
use Doctrine\ORM\EntityManager;

class HomeController
{
    protected $view;
    protected $db;

    public function __construct(View $view, EntityManager $db)
    {
        $this->view = $view;
        $this->db = $db;
    }

    public function index($request, $response)
    {
        $user = $this->db->getRepository(User::class)->find(1);

        return $this->view->render($response, 'home.twig', [
            'user' => $user
        ]);
    }
}
