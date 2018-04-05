<?php

namespace App\Security;

use App\Session\ISession;

class Csrf
{
    protected $session;

    public function __construct(ISession $session)
    {
        $this->session = $session;
    }

    public function token()
    {
        $this->session->set(
            $this->key(), 
            $token = bin2hex(random_bytes(32))
        );

        return $token;
    }

    protected function key()
    {
        return '_token';
    }
}
