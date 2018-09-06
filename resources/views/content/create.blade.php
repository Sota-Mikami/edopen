@extends('layouts.app')

@section('title','Add Content')

@php
    // 確認画面でキャンセルされた場合に初期値をセット
    $value = [
        'title' => '',
        'detail' =>'',
        'price'=>'',
    ];
    $input_session = session()->all();

    if (!empty($input_session['_old_input'])) {
        $value = $input_session['_old_input'];
    }


@endphp

@section('content')


<script type="text/javascript" src="{!! asset('/js/dropzone/dropzone-custom.js') !!}"></script>


<table>
    <form action="/contents/confirm" method="post" class="dropzone" id="imageUpload" enctype="multipart/form-data">
        {{ csrf_field() }}

        {{-- バリデーションで使用 --}}
        <input type="hidden" name="action" value="confirm">
        @if ($errors->has('image'))
            <tr>
                <th>ERROR</th><td>{{ $errors->first('image') }}</td>
            </tr>
        @endif
        <tr>
            <th>教材イメージ1</th>
            <td>
                <div class="dropzone" id="myDropzone"></div>
                {{-- <input type="file" name="image" multiple> --}}
            </td>
        </tr>
        {{-- @if ($errors->has('files[][img]'))
            <tr>
                <th>ERROR</th><td>{{ $errors->first('files[][img]') }}</td>
            </tr>
        @endif
        <tr>
            <th>教材イメージ2</th>
            <td>
                <input type="file" name="files[][img]" multiple>
            </td>
        </tr>
        @if ($errors->has('files[][img]'))
            <tr>
                <th>ERROR</th><td>{{ $errors->first('files[][img]') }}</td>
            </tr>
        @endif
        <tr>
            <th>教材イメージ3</th>
            <td>
                <input type="file" name="files[][img]" multiple>
            </td>
        </tr>
        @if ($errors->has('files[][img]'))
            <tr>
                <th>ERROR</th><td>{{ $errors->first('files[][img]') }}</td>
            </tr>
        @endif
        <tr>
            <th>教材イメージ4</th>
            <td>
                <input type="file" name="files[][img]" multiple>
            </td>
        </tr> --}}
        @if ($errors->has('title'))
            <tr>
                <th>ERROR</th><td>{{ $errors->first('title') }}</td>
            </tr>
        @endif
        <tr>
            <th>教材名</th>
            <td>
                <input type="text" id="title" name="title" value="{{ $value['title'] }}">
            </td>
        </tr>
        @if ($errors->has('detail'))
            <tr>
                <th>ERROR</th><td>{{ $errors->first('detail') }}</td>
            </tr>
        @endif
        <tr>
            <th>教材の詳細説明</th>
            <td>
                <textarea name="detail" id="detail" rows="8" cols="80">{{ $value['detail'] }}</textarea>
            </td>
        </tr>
        @if ($errors->has('price'))
            <tr>
                <th>ERROR</th><td>{{ $errors->first('price') }}</td>
            </tr>
        @endif
        <tr>
            <th>販売価格</th>
            <td>
                <input type="text" id="price" name="price" value="{{ $value['price'] }}">
            </td>
        </tr>
        @if ($errors->has('teaching_material'))
            <tr>
                <th>ERROR</th><td>{{ $errors->first('teaching_material') }}</td>
            </tr>
        @endif
        <tr>
            <th>教材コンテンツ</th>
            <td>
                <input type="file" id="teaching_material" name="teaching_material" multiple>
            </td>
        </tr>
        <tr>
            {{-- <th></th><td><input type="submit"  value="出品する" ></td> --}}
            <th></th>
            <td>
                <button type="submit" id="submit-all">出品する</button>
                {{-- <button type="submit" id="submit-all"> upload </button> --}}
            </td>
        </tr>
    </form>

</table>
<a href="/">もどる</a>
<script type="text/javascript" src="{!! asset('/js/jquery-3.3.1.min.js') !!}"></script>

@endsection
