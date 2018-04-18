<?php

namespace App\Auth;

use Doctrine\ORM\EntityManager;
use App\Models\User;
use App\Auth\Hashing\IHasher;
use App\Session\ISession;
use App\Cookie\CookieJar;

class Auth
{
    protected $db;

    protected $hasher;

    protected $session;

    protected $user;

    protected $recaller;

    protected $cookie;

    public function __construct(
        EntityManager $db, 
        IHasher $hasher, 
        ISession $session,
        Recaller $recaller,
        CookieJar $cookie
    )
    {
        $this->db = $db;
        $this->hasher = $hasher;
        $this->session = $session;
        $this->recaller = $recaller;
        $this->cookie = $cookie;
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
        list($identifier, $token) = $this->recaller->generate();

        $this->cookie->set('remember', $this->recaller->generateCookieValue($identifier, $token));

        $this->db->getRepository(User::class)->find($user->id)->update([
            'remember_identifier' => $identifier,
            'remember_token' => $this->recaller->hashTokenForDB($token)
        ]);

        $this->db->flush();
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
