<?php

namespace App\Middleware;

use App\Session\ISession;

class ClearValidationErrors
{
    protected $session;

    public function __construct(ISession $session)
    {
        $this->session = $session;
    }

    public function __invoke($request, $response, callable $next)
    {
        $next = $next($request, $response);

        $this->session->clear('errors', 'oldInput');

        return $next;
    }
}
