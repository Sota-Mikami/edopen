@extends('layouts.app')

@section('title','Confirm')

@section('content')
<table>
@if (session()->exists('content'))
    @php
        $content = session()->get('content');
    @endphp
@endif


@foreach ($content['images'] as $index => $e)
    @if (!empty($e))
        <tr>
            <th>教材イメージ {{ $index +1}}</th>
            <td>{{ $e }}</td>
        </tr>
    @endif
@endforeach
    <tr>
        <th>教材名</th><td>{{ $content['title'] }}</td>
    </tr>
    <tr>
        <th>教材の詳細説明</th><td>{{ $content['detail'] }}</td>
    </tr>
    <tr>
        <th>販売価格</th><td>{{ $content['price'] }}</td>
    </tr>
</table>

<form action="/contents/store" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="title" value="{{ $content['title'] }}">
    <input type="hidden" name="detail" value="{{ $content['detail'] }}">
    <input type="hidden" name="price" value="{{ $content['price'] }}">
    @foreach ($content['images'] as $index => $e)
        @if (!empty($e))
            <input type="hidden" name="images[][img]" value="{{ $e }}">
        @endif
    @endforeach
    <input type="submit" value="登録する">
    <a href="/contents/cancel">更新せずに戻る</a>
</form>




@endsection
