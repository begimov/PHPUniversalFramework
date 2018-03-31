<?php

namespace App\Session;

use App\Session\ISession;

class Flash
{
    protected $session;
    
    public function __construct(ISession $session)
    {
        $this->session = $session;
    }

    public function now($key, $value)
    {
        $this->session->set('flash', array_merge(
            $this->session->get('flash') ?? [], [
                $key => $value
            ]
        );
    }
}
