<?php

namespace App\Middleware;

use App\Security\Csrf;

class VerifyCsrfToken
{
    protected $csrf;

    public function __construct(Csrf $csrf)
    {
        $this->csrf = $csrf;
    }

    public function __invoke($request, $response, callable $next)
    {
        if (!isProtectionRequired()) {
            return $next($request, $response);
        }

        //

        return $next($request, $response);
    }

    protected function isProtectionRequired($request)
    {
        return in_array($request->getMethod(), ['POST', 'PUT', 'DELETE', 'PATCH']);
    }
}
