@extends('layouts.app')

@section('title','Confirm')

@section('content')
<table>
    @if (!emtpy($content->img1))
        <tr>
            <th>教材イメージ 1</th><td>{{ $content->img1 }}</td>
        </tr>
    @endif
    @if (!emtpy($content->img2))
        <tr>
            <th>教材イメージ 2</th><td>{{ $content->img2 }}</td>
        </tr>
    @endif
    @if (!emtpy($content->img3))
        <tr>
            <th>教材イメージ 3</th><td>{{ $content->img3 }}</td>
        </tr>
    @endif
    @if (!emtpy($content->img4))
        <tr>
            <th>教材イメージ 4</th><td>{{ $content->img4 }}</td>
        </tr>
    @endif
    <tr>
        <th>教材名</th><td>{{ $content->title }}</td>
    </tr>
    <tr>
        <th>教材の詳細説明</th><td>{{ $content->detail }}</td>
    </tr>
    <tr>
        <th>販売価格</th><td>{{ $content->price }}</td>
    </tr>

</table>



@endsection
