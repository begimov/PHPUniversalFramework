<?php

namespace App\Validation\Rules;

use Doctrine\ORM\EntityManager;

class ExistsRule implements IRule
{
    protected $db;

    public function __construct(EntityManager $db)
    {
        $this->db = $db;
    }

    public function validate($column, $value, $params, $columns)
    {
        $result = $this->db->getRepository($params[0])->findOneBy([
            $column => $value
        ]);

        return $result === null;
    }
}
