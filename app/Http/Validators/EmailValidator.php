<?php

namespace App\Http\Validators;

use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;

class EmailValidator extends Validator
{
    public function validateUniqueEmail($attribute, $email , $param)
    {
        $input_user = User::where('email',$email)->first();
        $login_user = Auth::user();

        //ログインユーザーのメアドなら可
        //且つ、他ユーザーのメアドの場合は不可
        if (($input_user->email !== $login_user->email ) && ($input_user->email == $email)) {
            return false;
        }
        return true;
    }
}
