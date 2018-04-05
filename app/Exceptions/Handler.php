<?php

namespace App\Exceptions;

use App\Session\ISession;
use App\Views\View;
use Psr\Http\Message\ResponseInterface;

class Handler
{
    protected $exception;
    protected $session;
    protected $response;
    protected $view;

    public function __construct(
        \Exception $exception, 
        ISession $session,
        ResponseInterface $response,
        View $view
    )
    {
        $this->exception = $exception;
        $this->session = $session;
        $this->response = $response;
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
        return $this->view->render($this->response, 'errors/csrf.twig');
    }
}
