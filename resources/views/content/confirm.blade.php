@extends('layouts.app')

@section('title','Confirm')

@section('content')

@empty ($content)
    @php
        redirect('/contents/create');
    @endphp
@endempty

<table>
    <tr>
        <th>教材イメージ</th>
        <td>
            @foreach ($content['images'] as $image)
                <img style="width:200px;" src="{!! asset('storage/'.$image) !!}" alt="教材イメージ">
            @endforeach
        </td>
    </tr>
    <tr>
        <th>教材名</th><td>{{ $content['title'] }}</td>
    </tr>
    <tr>
        <th>教材の詳細説明</th><td>{{ $content['detail'] }}</td>
    </tr>
    <tr>
        <th>販売価格</th><td>{{ $content['price'] }}</td>
    </tr>
    <tr>
        <th>教材コンテンツ</th><td>{{ $content['teaching_material'] }}</td>
    </tr>
</table>

<form action="/contents/store" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="action" value="store">
    <input type="hidden" name="title" value="{{ $content['title'] }}">
    <input type="hidden" name="detail" value="{{ $content['detail'] }}">
    <input type="hidden" name="price" value="{{ $content['price'] }}">
    @foreach ($content['images'] as $image)
        @if (!empty($image))
            <input type="hidden" name="images[][img]" value="{{ $image }}">
        @endif
    @endforeach

    <input type="hidden" name="teaching_material" value="{{ $content['teaching_material'] }}">
    <input type="submit" value="登録する">
    <a href="/contents/cancel">更新せずに戻る</a>
</form>


@endsection
