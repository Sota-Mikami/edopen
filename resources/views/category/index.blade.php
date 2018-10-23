@extends('layouts.app')

@section('title','Category List')

@section('content')


{{-- <p><a href="/categories/create">カテゴリー作成</a></p> --}}

<h2>カテゴリー作成フォーム</h2>
<br>
<table>
    <form action="/categories/create" method="post">
        {{ csrf_field() }}
        <tr>
            <th>カテゴリー名</th>
            <td>
                <input type="text" name="category_name" value="">
            </td>
        </tr>
        <tr>
            <th></th><td><input type="submit" value="作成"></td>
        </tr>

    </form>
</table>
<br>
<br>
<br>
<br>

<h2>カテゴリーリスト</h2>
@if (!empty($categories))
    <ul>
        @foreach ($categories as $category)
            <li>
                <form action="/categories/update" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                    <input type="text" name="category_name" value="{{ $category->name }}"><br>
                    <input type="submit" value="保存">
                </form>
                <a href="/categories/delete?id={{ $category->id }}">削除</a>
            </li>

        @endforeach
    </ul>
@endif


<br>
<br>
<br>
<br>
<a href="/">もどる</a>




@endsection
