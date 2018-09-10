<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     */
    public function authorize()
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];

        if ($this->id) {
            info("update");
            //変更前のメールアドレスをバリデーションから外す
            $rules['email'] = 'email | uniqueEmail';

        }else{
            info("new");
            $rules['email'] = 'email | unique:users,email';
            $rules['password'] = 'required';
        }



        return $rules;

    }

    public function messages(){
        return  [
            'email.email' =>'メールアドレスが必要です。',
            'email.unique_email'=>'入力されたメールアドレスは既に使用されています。',
            'password.required' => 'パスワードは必ず入力してください。',
        ];
    }
}
