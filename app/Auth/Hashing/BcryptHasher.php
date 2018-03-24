<?php

namespace App\Auth\Hashing;

class BcryptHasher implements IHasher
{
    public function create($plainPassword)
    {
        //
    }

    public function check($plainPassword, $hash)
    {
        //
    }

    public function needsToBeRehashed($hash)
    {
        //
    }
}
