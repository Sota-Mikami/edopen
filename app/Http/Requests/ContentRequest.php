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
        // $rules = [];
        $rules = [
            'title'=>'required',
            'detail'=>'required',
            'price'=>'required|integer',
        ];

        if ($this->all()['action']==='confirm') {
            $rules['file.*']  = ' mimes:jpg,png,jpeg, gif | image';
            $rules['teaching_material']  = 'required | file | mimes:pdf,doc,ppt';
        }

        return $rules;
    }

    public function messages(){
        return [
            'title.required' => 'タイトルは必ず入力してください。',
            'detail.required'=>'教材の詳細説明は必ず入力してください。',
            'price.required'=>'販売価格は必ず入力してください。',
            'price.integer'=>'販売価格を数字で入力してください。',
            'file.*.image'=>'画像ファイルをアップロードしてください。',
            'file.*.mimes'=>'指定された拡張子（ jpg , png , jpeg,gif ）ではありません。',
            'teaching_material.file' =>'ファイルをアップロードしてください。',
            'teaching_material.mimes'=>'指定された拡張子（ PDF , Word , PowerPoint ）ではありません。',
            'teaching_material.required' =>'教材コンテンツをアップロードしてください。',
        ];
    }

}
