<?php

namespace App\Session;

class Session implements ISession
{
    public function get($key, $default = null)
    {
        //
    }

    public function set($key, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $skey => $svalue) {
                $_SESSION[$skey] = $svalue;
            }
            return;
        }
        $_SESSION[$key] = $value;
    }

    public function exists($key)
    {
        //
    }

    public function clear(...$key)
    {
        foreach ($key as $skey) {
            unset($_SESSION[$skey]);
        }
    }
}
