<?php

namespace App\Middleware;

use App\Security\Csrf;
use App\Exceptions\CsrfTokenException;

class VerifyCsrfToken
{
    protected $csrf;

    public function __construct(Csrf $csrf)
    {
        $this->csrf = $csrf;
    }

    public function __invoke($request, $response, callable $next)
    {
        if (!$this->isProtectionRequired($request)) {
            return $next($request, $response);
        }

        if (!$this->csrf->isValid($this->getToken($request))) {
            throw new CsrfTokenException; 
        }

        return $next($request, $response);
    }

    public function getToken($request)
    {
        return $request->getParsedBody()[$this->csrf->key()] ?? null;
    }

    protected function isProtectionRequired($request)
    {
        return in_array($request->getMethod(), ['POST', 'PUT', 'DELETE', 'PATCH']);
    }
}
