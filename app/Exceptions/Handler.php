<?php

namespace App\Exceptions;

class Handler
{
    protected $exception;

    public function __construct(\Exception $exception)
    {
        $this->exception = $exception;
    }

    public function respond()
    {
        $class = (new \ReflectionClass($this->exception))->getShortName();

        if (method_exists($this, $method = 'handle' . $class)) {
            return $this->$method();
        }
    }

    protected function handleValidationException()
    {
        dump('CALLED');
    }
}
