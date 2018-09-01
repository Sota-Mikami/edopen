@extends('layouts.app')

@section('title','Show')

@php
    // var_dump($content);
@endphp

@section('content')
<table>
    @if ($content_imgs->img1)
        <tr>
            <th>画像1</th><td>{{ $content_imgs->img1 }}</td>
        </tr>
    @endif
    @if ($content_imgs->img2)
        <tr>
            <th>画像2</th><td>{{ $content_imgs->img2 }}</td>
        </tr>
    @endif
    @if ($content_imgs->img3)
        <tr>
            <th>画像3</th><td>{{ $content_imgs->img3 }}</td>
        </tr>
    @endif
    @if ($content_imgs->img4)
        <tr>
            <th>画像4</th><td>{{ $content_imgs->img4 }}</td>
        </tr>
    @endif
    <tr>
        <th>タイトル</th><td>{{ $content->title }}</td>
    </tr>
    <tr>
        <th>教材詳細</th><td>{{ $content->detail }}</td>
    </tr>
    <tr>
        <th>販売価格</th><td>{{ $content->price }}</td>
    </tr>
    <tr>
        <th>教材コンテンツ</th><td>{{ $content->teaching_material }}</td>
    </tr>
</table>

<form action="/content/download" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $content->id }}">
    <input type="hidden" name="file_name" value="{{ $content->teaching_material }}">
    <input type="submit" value="購入する">
</form>

<a href="/index">もどる</a>


@endsection
