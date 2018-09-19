<?php

namespace App\Http\Validators;

class ParameterValidator {

    public function validateNoControlCharacters($attribute, $value, $parameters){
        if (mb_ereg('\A[[:^cntrl:]]*\z', $value)) {
            return true;
        }
        return false;
    }




}
