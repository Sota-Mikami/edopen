<?php

namespace App\Http\Validators;

use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class PasswordValidator extends Validator{

    public function validateUserPassowordCheck($attribute, $value, $parameters)
    {
        $user = Auth::user();
        $password = Hash::make($value);

        if ($user->password !== $password) {
            return false;
        }

        return true;
    }


}
