@extends('layouts.app')

@section('title','Edit Password')

@section('content')
    <table>
        <form action="/user/password/edit" method="post">
            <tr>
                <th>メールアドレス</th>
                <td><input type="email" name="email" value=""></td>
            </tr>
            <tr>
                <th>現在のパスワード</th>
                <td><input type="password" name="old_password" value=""></td>
            </tr>
            <tr>
                <th>新しいパスワード</th>
                <td><input type="password" name="new_password" value=""></td>
            </tr>
            <tr>
                <th>新しいパスワード（確認用）</th>
                <td><input type="password" name="confirm_password" value=""></td>
            </tr>
        </form>
    </table>
@endsection
