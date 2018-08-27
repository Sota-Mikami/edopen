<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     */
    public function authorize()
    {
        return true ;
        //// TODO: 下記の認証のやり方が良いのかが分からない
        // if ($this->path() == 'users/sign_up' || 'user/edit') {
        //     return true ;
        // } else {
        //     return false;
        // }

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'=>'email',
            'password' =>'required',
             // 'files.*.photo' => 'image|mimes:jpeg,bmp,png',
        ];
    }

    public function messages(){
        return  [
            'email.email' =>'メールアドレスが必要です。',
            'password.required' => 'パスワードは必ず入力してください。',
        ];
    }
}
