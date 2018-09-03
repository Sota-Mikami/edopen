<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Validator;

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

        // dd($this->instance()->all());

        // $rules = [
        //     'title'=>'required',
        //     'detail'=>'required',
        //     'price'=>'required|integer',
        // ];
        //
        // $request  = $this->instance()->all();
        // $images = $request['files'];
        // $images_rules = 'image | mimes:jpeg,png,jpg,gif | max:1024| required ';
        //
        // if (count($images)>0) {
        //     foreach ($$images as $key => $image) {
        //         $rules['files.'.$key] = $images_rules;
        //     }
        // }
        //
        // return $rules;


        // foreach($this->request->get('img'))


        return [
            'files.*.img'=>'image | mimes:jpeg,png,jpg,gif | max:1024| required ',
            'teaching_material'=>'required | file | mimes:pdf,doc,ppt',
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
            'price.integer'=>'販売価格を数字で入力してください。',
            'files.*.image'=>'指定されたファイルが画像ではありません。',
            'files.*.mimes'=>'指定された拡張子（ PNG / JPG / GIF ) ではありません。',
            'files.*.max'=>'1 M を超えています。',
            'teaching_material.file' =>'ファイルをアップロードしてください。',
            'teaching_material.mimes'=>'指定された拡張子（ PDF , Word , PowerPoint ）ではありません。',
            'teaching_material.required' =>'教材コンテンツをアップロードしてください。',
        ];
    }
}
