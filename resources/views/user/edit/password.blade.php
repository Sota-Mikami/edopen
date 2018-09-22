@extends('layouts.app')

@section('title','Edit Password')

@section('content')
    <table>
        <form action="/user/password/edit" method="post">
            {{ csrf_field() }}


            <tr>
                @if ($errors->has('email'))
                    <th>ERROR</th><td>{{ $errors->first('email') }}</td>
                @endif
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td><input type="email" name="email" value=""></td>
            </tr>


            <tr>
                @if ($errors->has('old_password'))
                    <th>ERROR</th><td>{{ $errors->first('old_password') }}</td>
                @endif
            </tr>
            <tr>
                <th>現在のパスワード</th>
                <td><input type="password" name="old_password" value=""></td>
            </tr>


            <tr>
                @if ($errors->has('password'))
                    <th>ERROR</th><td>{{ $errors->first('password') }}</td>
                @endif
            </tr>
            <tr>
                <th>新しいパスワード</th>
                <td><input type="password" name="password" value=""></td>
            </tr>


            <tr>
                @if ($errors->has('password_confirmation'))
                    <th>ERROR</th><td>{{ $errors->first('password_confirmation') }}</td>
                @endif
            </tr>
            <tr>
                <th>新しいパスワード（確認用）</th>
                <td><input type="password" name="password_confirmation" value=""></td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input type="submit" value="変更">
                </td>
            </tr>
        </form>
    </table>

<a href="/user/edit">もどる</a>

@endsection
