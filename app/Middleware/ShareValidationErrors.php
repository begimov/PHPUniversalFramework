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
        $this->view->share([
            'errors' => 'errors',
            'oldInput' => 'oldInput',
        ]);
        return $next($request, $response);
    }
}
