@extends('layouts.app')

@section('title','ユーザー詳細')

@section('content')
    <h5>Name</h5>
    <p>{{ $user->name }}</p>

    <a href="/user/follow?id={{ $user->id }}">フォローする</a>
    <br>
    <a href="/user/unfollow?id={{ $user->id }}">フォロー解除する</a>
    <br>
    <a href="/users/index">戻る</a>
@endsection
