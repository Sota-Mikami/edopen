@extends('layouts.app')

@section('title','ユーザー詳細')

@section('content')
    <h5>Name</h5>
    <p>{{ $user->name }}</p>


    @if ($followOrNot)
        <a href="/user/unfollow?id={{ $user->id }}">フォロー解除する</a>
    @else
        <a href="/user/follow?id={{ $user->id }}">フォローする</a>
    @endif

    <br>
    <br>
    <h4>教材一覧</h4>
    <ul>
        @foreach ($contents as $content)
            <li>
                <a href="/content/show?id={{ $content->id }}">{{ $content->title }}</a>
            </li>
        @endforeach
    </ul>


    <br>
    <a href="/users/index">戻る</a>
@endsection
