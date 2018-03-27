<?php

namespace App\Middleware;

use App\Auth\Auth;

class Authenticate
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function __invoke($request, $response, callable $next)
    {
        //
        return $next($request, $response);
    }
}
