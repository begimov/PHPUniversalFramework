<?php

namespace App\Auth;

use Doctrine\ORM\EntityManager;
use App\Models\User;

class Auth
{
    protected $db;

    public function __construct(EntityManager $db)
    {
        $this->db = $db;
    }

    public function attempt($email, $password)
    {
        $user = $this->getUserByEmail($email);

        if (!$user) {
            return false;
        }
    }

    protected function hasValidCredentials($user, $password)
    {
        //
    }

    public function getUserByEmail($email)
    {
        return $this->db->getRepository(User::class)->findOneBy([
            'email' => $email
        ]);
    }
}
