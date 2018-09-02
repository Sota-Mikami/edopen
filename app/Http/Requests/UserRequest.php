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
            $rules['email'] = 'email | unique:users,email,'.$this->email.',email';
        }else{
            info("new");
            info($this);
            $rules['email'] = 'email | unique:users,email';
            $rules['password'] = 'required';
            // $password = ['password' =>'required'];
        }

        // dd($rules);

        return $rules;

        // return [
        //     'email'=>'email | '.$unique,
        //     'password' =>'required',
        //      // 'files.*.photo' => 'image|mimes:jpeg,bmp,png',
        // ];
    }

    public function messages(){
        return  [
            'email.email' =>'メールアドレスが必要です。',
            'email.unique'=>'入力されたメールアドレスはすでに使用されています。',
            'password.required' => 'パスワードは必ず入力してください。',
        ];
    }
}
