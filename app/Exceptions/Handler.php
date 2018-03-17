<?php

namespace App\Exceptions;

use App\Session\ISession;

class Handler
{
    protected $exception;
    protected $session;

    public function __construct(\Exception $exception, ISession $session)
    {
        $this->exception = $exception;
        $this->session = $session;
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
}
