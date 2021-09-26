<?php

namespace App\Http\Validator;

use Illuminate\Validation\Validator;

class CustomValidator extends Validator
{
    public function validateAlphaNumHalf($attribute, $value, $parameters)
    {
        if (preg_match("/^[a-zA-Z0-9]+$/u", $value)) {
            return true;
        }
    }

    public function validateAlphaNumSymbolHalf($attribute, $value, $parameters)
    {
        if (preg_match("/^[!-~]+$/", $value)) {
            return true;
        }
    }
}
