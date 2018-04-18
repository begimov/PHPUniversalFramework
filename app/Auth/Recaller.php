<?php

namespace App\Auth;

class Recaller
{
    public function generate()
    {
        dump($this->generateIdentifier());
    }

    protected function generateIdentifier()
    {
        return bin2hex(random_bytes(32));
    }
}
