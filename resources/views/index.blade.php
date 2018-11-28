@extends('layouts.app')

@section('title','Index')


@section('content')
<br>
<form class="search-box" action="/search" method="post">
    {{ csrf_field() }}
    <input type="text" name="keyword" value="" placeholder="コース検索" style="display:inline-block;">
    <input type="submit"  value="検索">
</form>

<br>

@if (Auth::check())
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
                        <img style="width:200px;" src="{!! asset('storage/'.$user->img) !!}" alt="ユーザー画像">
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
        <tr>
            <th>フォロー</th><td><a href="/relationship?status=following">{{ $follow_data['following'] }}</a></td>
        </tr>
        <tr>
            <th>フォロワー</th><td><a href="/relationship?status=followed">{{ $follow_data['followed'] }}</a></td>
        </tr>
    </table>
    <br>
    <br>
    <br>

    {{-- ログアウトボタン --}}
    <p><a href="users/logout">ログアウト</a></p>

    {{-- 編集ボタン --}}
    <p><a href="user/edit">ユーザー情報を編集</a></p>

    {{-- 教材アップロードボタン --}}
    <p><a href="contents/create">教材をアップロード</a></p>

    {{-- カテゴリー作成ページ --}}
    <p><a href="categories">カテゴリーページへ</a></p>

    {{-- ユーザー一覧ページ --}}
    <p><a href="users/index">ユーザー一覧ーページへ</a></p>

    <br>
    <br>
    <br>

    <h3 style="margin-top:100px;">購入済みコンテンツ一覧</h3>
    @foreach ($paid_contents as $key => $paid_content)
        <ul>
            <li>
                <a href="/content/show?id={{ $paid_content->id }}">
                    No.{{ $key +1 .' : '. $paid_content->title}}
                </a>
            </li>
        </ul>
    @endforeach
@endif


@if (!Auth::check())
    <p><a href="users/login">ログイン</a></p>
    <p><a href="users/sign_up">新規登録</a></p>

@endif

<h3 style="margin-top:100px;">コンテンツ一覧</h3>

<table>
    @foreach ($contents as $key => $value)
        <ul>
            <li>
                <a href="/content/show?id={{ $value->id }}">
                    No.{{ $key +1 .' : '. $value->title}}
                </a>
            </li>
        </ul>


    @endforeach
</table>




@endsection
