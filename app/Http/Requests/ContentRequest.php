<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // 一旦、下記のメソッドは保留
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'img1'=>'required',
            // 'img2'=>'required',
            // 'img3'=>'required',
            // 'img4'=>'required',
            'title'=>'required',
            'detail'=>'required',
            'price'=>'required|integer',
        ];
    }

    public function messages(){
        return [
            'title.required' => 'タイトルは必ず入力してください。',
            'detail.required'=>'教材の詳細説明は必ず入力してください。',
            'price.required'=>'販売価格は必ず入力してください。',
            'price.integer'=>'販売価格を数字で入力してください。'
        ];
    }
}
