@extends('layouts.app')

@section('title','Edit Email')

@section('content')

    <table>
        <form action="/user/email/edit" method="post">
            {{ csrf_field() }}

            <input type="hidden" name="id" value="{{ $user->id }}">
            <tr>
                @if ($errors->has('old_email'))
                    <th>ERROR</th>
                    <td>{{ $errors->first('old_email') }}</td>
                @endif
            </tr>
            <tr>
                <th>現在のメールアドレス</th>
                <td><input type="email" name="old_email" value=""></td>
            </tr>
            <tr>
                @if ($errors->has('password'))
                    <th>ERRROR</th><td>{{ $errors->first('password') }}</td>
                @endif
            </tr>
            <tr>
                <th>パスワード</th>
                <td><input type="password" name="password" value=""></td>
            </tr>
            <tr>
                @if ($errors->has('new_email'))
                    <th>ERROR</th><td>{{ $errors->first('new_email') }}</td>
                @endif
            </tr>
            <tr>
                <th>新しいメールアドレス</th>
                <td><input type="email" name="new_email" value=""></td>
            </tr>


            <tr>
                <th></th>
                <td><input type="submit" value="変更"></td>
            </tr>
        </form>
    </table>
    <br>
    <p>メールアドレスの変更に必要な情報をこの新しいメールアドレス宛に送信します。</p>
    <p>*セキュリティのため現在のメールアドレス、パスワードを入力頂いております。</p>

@endsection
