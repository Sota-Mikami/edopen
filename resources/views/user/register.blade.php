@extends('layouts.app')

@section('title','Sign up')


@section('content')
<table>
    <form action="/users/sign_up" method="post">
        {{ csrf_field() }}
        @if ($errors->has('email'))
            <tr>
                <th>ERROR</th><td>{{ $errors->first('email') }}</td>
            </tr>
        @endif
        <tr>
            <th>Email</th><td><input type="text" name="email"></td>
        </tr>
        @if ($errors->has('password'))
            <tr>
                <th>ERROR</th><td>{{ $errors->first('password') }}</td>
            </tr>
        @endif
        <tr>
            <th>Password</th><td><input type="password" name="password"></td>
        </tr>
        <tr>
            <th></th><td><input type="submit" value="登録"></td>
        </tr>
    </form>
</table>

<a href="/users/login">ログイン</a><br>
<a href="/">ホーム画面へ</a>

@endsection
