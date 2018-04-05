<?php

namespace App\Exceptions;

use App\Session\ISession;
use App\Views\View;

class Handler
{
    protected $exception;
    protected $session;
    protected $view;

    public function __construct(
        \Exception $exception, 
        ISession $session,
        View $view
    )
    {
        $this->exception = $exception;
        $this->session = $session;
        $this->view = $view;
    }

    public function respond()
    {
        $class = (new \ReflectionClass($this->exception))->getShortName();

        if (method_exists($this, $method = 'handle' . $class)) {
            return $this->$method();
        }

        return $this->unhandledException();
    }

    protected function unhandledException()
    {
        throw $this->exception;
        
    }

    protected function handleValidationException()
    {
        $this->session->set([
            'errors' => $this->exception->getErrors(),
            'oldInput' => $this->exception->getOldInput(),
        ]);

        return redirect($this->exception->getPath());
    }

    protected function handleCsrfTokenException()
    {
        return $this->view->render('', 'errors/csrf.twig');
    }
}
