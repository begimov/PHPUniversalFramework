<?php

namespace App\Controllers;

use Valitron\Validator;

abstract class Controller
{
    public function validate($request, array $rules)
    {
        $validator = new Validator($request->getParsedBody());

        $validator->mapFieldsRules($rules);

        if (!$validator->validate()) {
            dump('failed');
            die();
        }

        return $request->getParsedBody();
    }
}
