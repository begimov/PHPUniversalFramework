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

    public function createHash($token)
    {
        return hash('sha256', $token);
    }

    public function splitCookieValue($value)
    {
        return explode($this->separator, $value);
    }

    public function validateToken($plain, $hash)
    {
        return $this->createHash($plain) === $hash;
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
