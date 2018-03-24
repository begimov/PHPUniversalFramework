<?php

namespace App\Auth;

use Doctrine\ORM\EntityManager;

class Auth
{
    protected $db;

    public function __construct(EntityManager $db)
    {
        $this->db = $db;
    }

    public function attempt($email, $password)
    {
        //
    }

    public function getUserByEmail($email)
    {
        //
    }
}
