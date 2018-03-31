<?php

namespace App\Auth;

use Doctrine\ORM\EntityManager;
use App\Models\User;
use App\Auth\Hashing\IHasher;
use App\Session\ISession;

class Auth
{
    protected $db;
    protected $hasher;
    protected $session;
    protected $user;

    public function __construct(EntityManager $db, IHasher $hasher, ISession $session)
    {
        $this->db = $db;
        $this->hasher = $hasher;
        $this->session = $session;
    }

    public function attempt($email, $password)
    {
        $user = $this->getUserByEmail($email);

        if (!$user || !$this->hasValidCredentials($user, $password)) {
            return false;
        }

        if ($this->needsRehash($user)) {
            $this->rehashPassword($user, $password);
        }

        $this->setUserSession($user);

        return true;
    }

    public function user()
    {
        return $this->user;
    }

    public function check()
    {
        return $this->hasUserInSession();
    }

    public function hasUserInSession()
    {
        return $this->session->exists($this->key());
    }

    public function setUserFromSession()
    {
        $user = $this->getById($this->session->get($this->key()));

        if (!$user) {
            throw new \Exception();
        }
        $this->user = $user;
    }

    protected function key()
    {
        return 'id';
    }

    protected function setUserSession($user)
    {
        $this->session->set($this->key(), $user->id);
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

    protected function getById($id)
    {
        return $this->db->getRepository(User::class)->find($id);
    }

    protected function needsRehash($user)
    {
        return $this->hasher->needsToBeRehashed($user->password);
    }

    protected function rehashPassword($user, $password)
    {
        dump('REHASH');
        $hash = $this->hasher->create($password);
    }
}
