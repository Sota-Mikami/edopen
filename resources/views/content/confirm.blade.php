@extends('layouts.app')

@section('title','Confirm')

@section('content')
<table>
@if (session()->exists('content'))
    @php
        $content = session()->get('content');
        // unset($content)
    @endphp
@endif

<tr>
    <th>教材イメージ</th>
    <td>
        @foreach ($content->images as $image)
            <img src="{{ url('/content/content_image',$image->id) }}" alt="">
        @endforeach
    </td>
</tr>



{{-- @foreach ($content['images'] as $index => $e)
    @if (!empty($e))
        <tr>
            <th>教材イメージ {{ $index +1}}</th>
            <td>
                <img style="width:200px;" src="{!! asset('storage/'.$e) !!}" alt="ユーザー画像">
            </td>
        </tr>
    @endif
@endforeach --}}
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

{{-- <form action="/contents/store" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="action" value="store">
    <input type="hidden" name="title" value="{{ $content['title'] }}">
    <input type="hidden" name="detail" value="{{ $content['detail'] }}">
    <input type="hidden" name="price" value="{{ $content['price'] }}">
    @foreach ($content['images'] as $index => $e)
        @if (!empty($e))
            <input type="hidden" name="images[][img]" value="{{ $e }}">
        @endif
    @endforeach
    <input type="hidden" name="teaching_material" value="{{ $content['teaching_material'] }}">
    <input type="submit" value="登録する">
    <a href="/contents/cancel">更新せずに戻る</a>
</form> --}}




@endsection
