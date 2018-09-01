@extends('layouts.app')

@section('title','Sign in')


@section('content')
<p>{{ $message }}</p>


<table>
    <form action="/users/login" method="post">
        {{ csrf_field() }}
        <tr>
            <th>mail :</th><td><input type="text" name="email" ></td>
        </tr>
        <tr>
            <th>password :</th><td><input type="password" name="password" ></td>
        </tr>
        <tr>
            <th></th><td><input type="submit" value="send" ></td>
        </tr>
    </form>
</table>

<a href="/users/sign_up">新規登録</a>

@endsection
