<?php

namespace App\Middleware;

use App\Session\ISession;

class VerifyCsrfToken
{
    protected $csrf;

    public function __construct(Csrf $csrf)
    {
        $this->csrf = $csrf;
    }

    public function __invoke($request, $response, callable $next)
    {
        //
        return $next($request, $response);
    }
}
