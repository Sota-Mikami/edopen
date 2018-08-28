@extends('layouts.app')

@section('title','Add Content')


@section('content')

<table>
    <form action="/contents/create" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($errors->has('img1'))
            <tr>
                <th>ERROR</th><td>{{ $errors->first('img1') }}</td>
            </tr>
        @endif
        <tr>
            <th>教材イメージ1</th>
            <td>
                <input type="file" name="img1" multiple>
            </td>
        </tr>
        @if ($errors->has('img2'))
            <tr>
                <th>ERROR</th><td>{{ $errors->first('img2') }}</td>
            </tr>
        @endif
        <tr>
            <th>教材イメージ2</th>
            <td>
                <input type="file" name="img2" multiple>
            </td>
        </tr>
        @if ($errors->has('img3'))
            <tr>
                <th>ERROR</th><td>{{ $errors->first('img3') }}</td>
            </tr>
        @endif
        <tr>
            <th>教材イメージ3</th>
            <td>
                <input type="file" name="img3" multiple>
            </td>
        </tr>
        @if ($errors->has('img4'))
            <tr>
                <th>ERROR</th><td>{{ $errors->first('img4') }}</td>
            </tr>
        @endif
        <tr>
            <th>教材イメージ4</th>
            <td>
                <input type="file" name="img4" multiple>
            </td>
        </tr>
        @if ($errors->has('title'))
            <tr>
                <th>ERROR</th><td>{{ $errors->first('title') }}</td>
            </tr>
        @endif
        <tr>
            <th>教材名</th>
            <td>
                <input type="text" name="title">
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
                <textarea name="detail" rows="8" cols="80"></textarea>
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
                <input type="text" name="price">
            </td>
        </tr>
        <tr>
            <th></th><td><input type="submit" value="出品する" ></td>
        </tr>
    </form>

</table>


@endsection
