<?php

namespace App\Validation\Rules;

interface IRule
{
    public function validate($column, $value, $params, $columns);
}
