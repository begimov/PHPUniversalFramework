<?php

namespace App\Session;

use App\Session\ISession;

class Flash
{
    protected $session;
    
    public function __construct(ISession $session)
    {
        $this->session = $session;

        $this->addFlashMsgsToCache();

        $this->clear();
    }

    public function now($key, $value)
    {
        $this->session->set('flash', array_merge(
            $this->session->get('flash') ?? [], [
                $key => $value
            ]
        ));
    }

    public function getAll()
    {
        return $this->session->get('flash');
    }

    protected function addFlashMsgsToCache(Type $var = null)
    {
        $this->messages = $this->getAll();
    }

    protected function clear()
    {
        $this->session->clear('flash');
    }
}
