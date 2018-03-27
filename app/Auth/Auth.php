<?php

namespace App\Auth;

use Doctrine\ORM\EntityManager;
use App\Models\User;
use App\Auth\Hashing\IHasher;

class Auth
{
    protected $db;
    protected $hasher;

    public function __construct(EntityManager $db, IHasher $hasher)
    {
        $this->db = $db;
        $this->hasher = $hasher;
    }

    public function attempt($email, $password)
    {
        $user = $this->getUserByEmail($email);

        if (!$user || !$this->hasValidCredentials($user, $password)) {
            return false;
        }
        
        return true;
    }

    protected function hasValidCredentials($user, $password)
    {
        return $this->hasher->check($password, $user->password);
    }

    public function getUserByEmail($email)
    {
        return $this->db->getRepository(User::class)->findOneBy([
            'email' => $email
        ]);
    }
}
