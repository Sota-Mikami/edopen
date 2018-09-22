@extends('layouts.app')

@section('title','Edit')

{{-- @php
    $user =Auth::user();
@endphp --}}

@section('content')

<table>
    <form action="/user/edit" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $user->id }}">
        <tr>
            <th>名前</th><td><input type="text" name="name" value="{{ old( 'name',$user->name) }}"></td>
        </tr>
        @if ($errors->has('email'))
            <tr>
                <th>ERROR</th><td>{{ $errors->first('email') }}</td>
            </tr>
        @endif
        <tr>
            {{-- <th>メール</th><td><input type="email" name="email" value="{{ old('email',$user->email)}}"></td> --}}
            <th>メール</th><td><a href="/user/email/edit">メールアドレスの変更</a></td>
        </tr>
        <tr>
            <th>パスワード</th><td><a href="/user/password/edit">パスワードの変更</a></td>
        </tr>
        <tr>
            {{-- <th>プロフィール画像</th><td> <input type="file" class="form-control" name="files[][photo]" multiple></td> --}}
            <th>プロフィール画像</th><td> <input type="file" class="form-control" name="profile_img" multiple></td>

        </tr>
        <tr>
            <th>BIO</th><td><textarea name="bio">{{ old('bio',$user->bio) }}</textarea></td>
        </tr>
        <tr>
            <th></th><td><input type="submit" value="send" ></td>
        </tr>
    </form>
</table>

<a href="/">もどる</a>
@endsection
