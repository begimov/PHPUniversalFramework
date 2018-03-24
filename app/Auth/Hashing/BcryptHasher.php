<?php

namespace App\Auth\Hashing;

class BcryptHasher implements IHasher
{
    public function create($plainPassword)
    {
        $hash = password_hash($plainPassword, PASSWORD_BCRYPT, $this->options());

        if (!$hash) {
            throw new RuntimeException("Hash algorithm is not supported.");
        }

        return $hash;
    }

    public function check($plainPassword, $hash)
    {
        return password_verify($plainPassword, $hash);
    }

    public function needsToBeRehashed($hash)
    {
        return password_needs_rehash($hash, PASSWORD_BCRYPT, $this->options());
    }

    protected function options()
    {
        return [
            'cost' => 12
        ];
    }
}
