@extends('layouts.app')

@section('title','Sign in')


@section('content')


{{-- <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '{your-app-id}',
      cookie     : true,
      xfbml      : true,
      version    : '{api-version}'
    });

    FB.AppEvents.logPageView();

  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script> --}}


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
