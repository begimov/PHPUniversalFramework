<?php

namespace App\Middleware;

class ShareValidationErrors
{
    public function __invoke($request, $response, callable $next)
    {
        return $next($request, $response);
    }
}
