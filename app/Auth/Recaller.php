<?php

namespace App\Auth;

class Recaller
{
    public function generate()
    {
        return [$this->generateIdentifier(), $this->generateToken()];
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
