<?php

namespace App\Middleware;

use App\Auth\Auth;

class AuthenticateFromCookie
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function __invoke($request, $response, callable $next)
    {
        if ($this->auth->check()) {
            return $next($request, $response);
        }

        if ($this->auth->hasRecaller()) {
            //
        }

        return $next($request, $response);
    }
}
