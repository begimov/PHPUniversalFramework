<?php

namespace App\Middleware;

class ShareValidationErrors
{
    public function __invoke($request, $response, callable $next)
    {
        dump('ShareValidationErrors');
        return $next($request, $response);
    }
}
