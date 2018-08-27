@extends('layouts.app')

@section('title','Add Content')


@section('content')
<form action="/content/create" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <tr>
        <th>教材イメージ1</th>
        <td>
            <input type="file" name="img1" multiple>
        </td>
    </tr>
    <tr>
        <th>教材イメージ2</th>
        <td>
            <input type="file" name="img2" multiple>
        </td>
    </tr>
    <tr>
        <th>教材イメージ3</th>
        <td>
            <input type="file" name="img3" multiple>
        </td>
    </tr>
    <tr>
        <th>教材イメージ4</th>
        <td>
            <input type="file" name="img4" multiple>
        </td>
    </tr>
    <tr>
        <th>教材名</th>
        <td>
            <input type="text" name="title">
        </td>
    </tr>
    <tr>
        <th>教材の詳細説明</th>
        <td>
            <textarea name="detail" rows="8" cols="80"></textarea>
        </td>
    </tr>
    <tr>
        <th>販売価格</th>
        <td>
            <input type="text" name="price">
        </td>
    </tr>
    <tr>
        <th></th><td><input type="submit" value="出品する" ></td>
    </tr>
</form>


@endsection
