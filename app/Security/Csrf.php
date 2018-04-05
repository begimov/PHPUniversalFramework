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

    public function hash()
    {
        return 'hash';
    }
}
