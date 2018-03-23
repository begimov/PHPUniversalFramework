<?php

namespace App\Middleware;

use App\Views\View;
use App\Session\ISession;

class ShareValidationErrors
{
    protected $view;
    protected $session;

    public function __construct(View $view, ISession $session)
    {
        $this->view = $view;
        $this->session = $session;
    }

    public function __invoke($request, $response, callable $next)
    {
        $this->view->share([
            'errors' => $this->session->get('errors', []),
            'oldInput' => $this->session->get('oldInput', []),
        ]);
        return $next($request, $response);
    }
}
