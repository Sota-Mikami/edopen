@extends('layouts.app')

@section('title','Index')


@section('content')

{{-- ログインユーザー情報 --}}
<h3>ログインユーザー情報</h3>
<table>
    <tr>
        <th>Name</th><td><p>{{ $user->name }}</p></td>
    </tr>
    <tr>
        <th>Email</th><td><p>{{ $user->email }}</p></td>
    </tr>
    <tr>
        <th>画像</th>
        @if (empty($user->img))
            <td>
                <p>未入力</p>
            </td>
        @else
            <td style="width:200px; hight:200px;">
                    <img style="width:200px;" src="{{public_path('profile_images/'.$user->img)}}" alt="ユーザー画像">
                </td>
        @endif
    </tr>
    <tr>
        <th>自己紹介</th>
        @if (empty($user->bio))
            <td>
                <p>未入力</p>
            </td>
        @else
            <td>{{ $user->bio }}</td>
        @endif
    </tr>
</table>




{{-- ログアウトボタン --}}
<p><a href="users/logout">ログアウト</a></p>

{{-- 編集ボタン --}}
<p><a href="user/edit">ユーザー情報を編集</a></p>

{{-- 教材アップロードボタン --}}
<p><a href="#">教材をアップロード</a></p>


@endsection
