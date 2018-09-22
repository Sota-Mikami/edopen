<?php

namespace App\Http\Validators;

use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserCustomValidator extends Validator
{

    //入力されたEmailが、認証済みユーザー以外に、
    //既にデータベースに存在しないかチェック
    public function validateExistEmail($attribute, $email , $param)
    {
        $input_user = User::where('email',$email)->first();
        //データベースに存在していたらアウト
        if (!is_null($input_user)) {
            return false;
        }
        return true;
    }

    //入力されたEmailと認証済みユーザーのEmailの確認
    public function validateAuthEmail($attribute, $email, $parameters){

        $login_user = Auth::user();
        $input_user = User::where('email',$email)->first();

        if ( is_null($input_user) || ($login_user->email !== $input_user->email) ) {
            return false;
        }
        return true;
    }

    // パスワード認証
    public function validateUserPasswordCheck($attribute, $value, $parameters)
    {
        $user = Auth::user();

        if (!Hash::check($value, $user->password)) {
            return false;
        }

        return true;
    }

    // 現在のパスワードと同じパスワードが同じ場合、弾く
    public function validateNotUserPasswordCheck($attribute, $value, $parameters)
    {
        $user = Auth::user();

        if (Hash::check($value, $user->password)) {
            return false;
        }

        return true;
    }

    //ユーザー名と新しいパスワードの同値チェック
    public function validateNotSameUserNameToPassword($attribute, $value, $parameters){

        $user = Auth::user();

        if ($user->name == $value) {
            return false ;
        }
        return true;
    }





}
