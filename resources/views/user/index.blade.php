@extends('layouts.app')

@section('title','ユーザー一覧')

@section('content')

<h3>ユーザー一覧</h3>
<ul>
    @foreach ($users as $user)
        <li>
            <a href="/users/show?id={{ $user->id }}">{{ $user->name }}</a>
        </li>
    @endforeach
</ul>


{{ $users->links() }}

<br>
<br>
<br>
<a href="/">戻る</a>
@endsection
