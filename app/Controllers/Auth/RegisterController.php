<?php

namespace App\Controllers\Auth;

use App\Models\User;
use App\Views\View;
use App\Auth\Auth;
use App\Session\Flash;
use App\Controllers\Controller;
use League\Route\RouteCollection;
use App\Auth\Hashing\IHasher;
use Doctrine\ORM\EntityManager;

class RegisterController extends Controller
{
    protected $view;
    protected $hasher;
    protected $router;
    protected $db;

    public function __construct(
        View $view, 
        IHasher $hasher,
        RouteCollection $router,
        EntityManager $db)
    {
        $this->view = $view;
        $this->hasher = $hasher;
        $this->router = $router;
        $this->db = $db;
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

        $user = $this->createUser($data);

        return redirect($this->router->getNamedRoute('home')->getPath());
    }

    protected function createUser($data)
    {
        $user = new User;

        $user->fill([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $this->hasher->create($data['password'])
        ]);

        $this->db->persist($user);
        $this->db->flush();

        return $user;
    }
}