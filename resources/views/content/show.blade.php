@extends('layouts.app')

@section('title','Show')

@php
    // dd($content->id);
@endphp

@section('content')
<table>
    @if ($content_imgs)
        @foreach ($content_imgs as $index => $img)
            <tr>
                <th>画像{{ $index+1 }}</th>
                <td>
                    <img style="width:200px;" src="{!! asset('storage/content_images/'.$content->id.'/'.$img->img) !!}" alt="教材イメージ">
                </td>
            </tr>
        @endforeach
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

<a href="/">もどる</a>


@endsection
