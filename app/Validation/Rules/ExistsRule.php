<?php

namespace App\Validation\Rules;

use Doctrine\ORM\EntityManager;

class ExistsRule
{
    protected $db;

    public function __construct(EntityManager $db)
    {
        $this->db = $db;
    }
    
    public function validate($column, $value, $params, $columns)
    {
        return false;
    }
}
