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
            $rules['email'] = 'email | unique:users,email,'.$this->email.',email';

            // try {
            //     return $rules;
            // } catch (\Exception $e) {
            //     $errorCode = $e->errorInfo[1];
            //     if($errorCode == 1062) //重複エラーをここでキャッチ
            //       {
            //         return back()->withInput()->withErrors(['email' => "入力されたメールアドレスはすでに使用されています。"]);
            //       }
            //
            // }

        }else{
            info("new");
            $rules['email'] = 'email | unique:users,email';
            $rules['password'] = 'required';
        }



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
