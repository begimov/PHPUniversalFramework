<?php

namespace App\Controllers;

abstract class Controller
{
    public function validate($request, $rules)
    {
        dump($request, $rules);
    }
}