<?php

namespace App\Cookie;

class CookieJar
{
    protected $path = '/';

    protected $domain = null;

    protected $secure = false;

    protected $httpOnly = true;

    public function set($name, $value, $minutes = 60)
    {
        $expiry = time() + ($minutes * 60);

        setcookie(
            $name, $value, $expiry, 
            $this->path, $this->domain, $this->secure, $this->httpOnly
        );
    }

    public function get($key, $default = null)
    {
        if ($this->exists($key)) {
            return $_COOKIE[$key];
        }

        return $default;
    }

    public function exists()
    {
        # code...
    }

    public function clear()
    {
        # code...
    
    }
    public function forever()
    {
        # code...
    }
}