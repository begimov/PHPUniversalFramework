<?php

namespace App\Security;

use App\Session\ISession;

class Csrf
{
    protected $session;
    protected $persist = false;

    public function __construct(ISession $session)
    {
        $this->session = $session;
    }

    public function token()
    {
        if (!$this->needsToBeGenerated()) {
            return $this->getFromSession();
        }

        $this->session->set(
            $this->key(), 
            $token = bin2hex(random_bytes(32))
        );

        return $token;
    }

    protected function getFromSession()
    {
        return $this->session->get($this->key());
    }

    protected function needsToBeGenerated()
    {
        if ($this->shouldPersist()) {
            return false;
        }
        return $this->session->exists($this->key());
    }

    protected function shouldPersist()
    {
        return $this->persist;
    }

    protected function key()
    {
        return '_token';
    }
}
