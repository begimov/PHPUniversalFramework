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

    protected $recaller;

    public function __construct(
        EntityManager $db, 
        IHasher $hasher, 
        ISession $session,
        Recaller $recaller)
    {
        $this->db = $db;
        $this->hasher = $hasher;
        $this->session = $session;
        $this->recaller = $recaller;
    }

    public function attempt($email, $password, $remember = false)
    {
        $user = $this->getUserByEmail($email);

        if (!$user || !$this->hasValidCredentials($user, $password)) {
            return false;
        }

        if ($this->needsRehash($user)) {
            $this->rehashPassword($user, $password);
        }

        $this->setUserSession($user);

        if ($remember) {
            $this->setRememberToken($user);
        }

        return true;
    }

    public function logout()
    {
        $this->session->clear($this->key());
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

    protected function setRememberToken($user)
    {
        dump($this->recaller->generate());
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
        $this->db->getRepository(User::class)->find($user->id)->update([
            'password' => $this->hasher->create($password)
        ]);

        $this->db->flush();
    }
}
