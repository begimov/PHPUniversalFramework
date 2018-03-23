<?php

namespace App\Middleware;

use App\Views\View;

class ShareValidationErrors
{
    protected $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function __invoke($request, $response, callable $next)
    {
        return $next($request, $response);
    }
}
