<?php

namespace App\Exceptions;

class ValidationException extends \Exception
{
    public function __construct($request, array $errors)
    {
        $this->request = $request;
        $this->errors = $errors;
    }
}
