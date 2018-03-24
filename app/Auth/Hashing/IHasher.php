<?php

namespace App\Auth\Hashing;

interface IHasher
{
    public function create($plainPassword);

    public function check($plainPassword, $hash);

    public function needsToBeRehashed($hash);
}