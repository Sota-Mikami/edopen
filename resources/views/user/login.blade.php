@extends('layouts.app')

@section('title','Sign in')



@section('content')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


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
            <th></th><td><input type="submit" value="ログイン" ></td>
        </tr>
    </form>
</table>

<br>
<a href="/users/login/facebook">Sign in with Facebook</a>
<br>

<a href="/users/sign_up">新規登録</a><br>
<a href="/">ホーム画面へ</a>

@endsection
