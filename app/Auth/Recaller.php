<?php

namespace App\Auth;

class Recaller
{
    protected $separator = '|';

    public function generate()
    {
        return [$this->generateIdentifier(), $this->generateToken()];
    }

    public function generateCookieValue($identifier, $token)
    {
        return $identifier . $this->separator . $token;
    }

    protected function generateIdentifier()
    {
        return bin2hex(random_bytes(32));
    }

    protected function generateToken()
    {
        return bin2hex(random_bytes(32));
    }
}
