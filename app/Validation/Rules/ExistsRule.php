<?php

class ExistsRule
{
    public function validate($column, $value, $params, $columns)
    {
        return false;
    }
}
