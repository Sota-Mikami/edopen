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
</table>



{{-- ログアウトボタン --}}
<p><a href="users/logout">ログアウト</a></p>

{{-- 編集ボタン --}}
<p><a href="user/edit">ユーザー情報を編集</a></p>

{{-- 教材アップロードボタン --}}
<p><a href="contents/create">教材をアップロード</a></p>

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


<!DOCTYPE html>
<html>
    <head>
        <link href="./img/favicon.png" rel="shortcut icon"/>
        <meta charset="utf-8"/>
        <meta content="width=1440px, maximum-scale=1.0" name="viewport"/>
        <link href="./css/index.css" rel="stylesheet" type="text/css"/>
        <meta content="Launchpad by Anima" name="author">
        </meta>
    </head>
    <body style="margin: 0;
 background: rgba(255, 255, 255, 1.0);">
        <input id="anPageName" name="page" type="hidden" value="index"/>
        <div class="index">
            <div style="width: 1440px; height: 100%; position:relative; margin:auto;">
                <div class="mainarea">
                    <img anima-src="./img/loginsns-bass.png" class="bass" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                    <div class="footer">
                        <div class="bottom">
                            <div class="text">
                                利用規約
                            </div>
                            <div class="text1">
                                プライバシーポリシー
                            </div>
                            <div class="sns">
                                <div class="fb">
                                    <img anima-src="./img/user001following-oval@2x.png" class="oval" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-stroke-87@2x.png" class="stroke87" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                </div>
                                <div class="ig">
                                    <img anima-src="./img/user001following-oval@2x.png" class="oval" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <div class="insta">
                                        <img anima-src="./img/user001following-stroke-38@2x.png" class="stroke38" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                        <img anima-src="./img/user001following-stroke-40@2x.png" class="stroke40" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                        <img anima-src="./img/user001following-stroke-42@2x.png" class="stroke42" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    </div>
                                </div>
                                <div class="tw">
                                    <div class="group3">
                                        <img anima-src="./img/user001following-oval@2x.png" class="oval" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    </div>
                                    <img anima-src="./img/user001following-stroke-89@2x.png" class="stroke89" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                </div>
                            </div>
                            <div class="copywrite">
                                © 2018. EDOPEN
                            </div>
                        </div>
                        <div class="line2">
                        </div>
                        <div class="menus">
                            <div class="text">
                                運営
                            </div>
                            <div class="text1">
                                広告出稿
                            </div>
                            <div class="text2">
                                Q&amp;A
                            </div>
                            <div class="text3">
                                お知らせ
                            </div>
                            <div class="text4">
                                EDOPEN の使い方
                            </div>
                            <div class="text5">
                                EDOPEN について
                            </div>
                        </div>
                        <div class="line1">
                        </div>
                    </div>
                    <div class="contentnew">
                        <div class="contentcard">
                            <div class="content">
                                <div class="base">
                                </div>
                                <div class="autor">
                                    <div class="autorname">
                                        by 能年 玲奈
                                    </div>
                                    <img anima-src="./img/user001following-autorimg@2x.png" class="autorimg" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                </div>
                                <div class="stars">
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px1" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px2" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px3" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstarhalf24px@2x.png" class="icstarhalf24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                </div>
                                <div class="price">
                                    ¥600 -
                                </div>
                                <div class="contentname">
                                    秋のことばを学ぶ。
                                </div>
                                <div class="contentimg">
                                    <div class="mask">
                                    </div>
                                    <img anima-src="./img/user001following-pexels-photo-355302.png" class="pexelsphoto355302" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                </div>
                            </div>
                        </div>
                        <div class="contentcard1">
                            <div class="content">
                                <div class="base">
                                </div>
                                <div class="autor">
                                    <div class="autorname">
                                        by 能年 玲奈
                                    </div>
                                    <img anima-src="./img/user001following-autorimg@2x.png" class="autorimg" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                </div>
                                <div class="stars">
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px1" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px2" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px3" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstarhalf24px@2x.png" class="icstarhalf24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                </div>
                                <div class="price">
                                    ¥600 -
                                </div>
                                <div class="contentname">
                                    秋のことばを学ぶ。
                                </div>
                                <div class="contentimg">
                                    <div class="mask">
                                    </div>
                                    <img anima-src="./img/user001following-pexels-photo-355302.png" class="pexelsphoto355302" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                </div>
                            </div>
                        </div>
                        <div class="contentcard2">
                            <div class="content">
                                <div class="base">
                                </div>
                                <div class="autor">
                                    <div class="autorname">
                                        by 能年 玲奈
                                    </div>
                                    <img anima-src="./img/user001following-autorimg@2x.png" class="autorimg" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                </div>
                                <div class="stars">
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px1" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px2" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px3" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstarhalf24px@2x.png" class="icstarhalf24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                </div>
                                <div class="price">
                                    ¥600 -
                                </div>
                                <div class="contentname">
                                    秋のことばを学ぶ。
                                </div>
                                <div class="contentimg">
                                    <div class="mask">
                                    </div>
                                    <img anima-src="./img/user001following-pexels-photo-355302.png" class="pexelsphoto355302" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                </div>
                            </div>
                        </div>
                        <div class="contentcard3">
                            <div class="content">
                                <div class="base">
                                </div>
                                <div class="autor">
                                    <div class="autorname">
                                        by 能年 玲奈
                                    </div>
                                    <img anima-src="./img/user001following-autorimg@2x.png" class="autorimg" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                </div>
                                <div class="stars">
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px1" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px2" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px3" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstarhalf24px@2x.png" class="icstarhalf24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                </div>
                                <div class="price">
                                    ¥600 -
                                </div>
                                <div class="contentname">
                                    秋のことばを学ぶ。
                                </div>
                                <div class="contentimg">
                                    <div class="mask">
                                    </div>
                                    <img anima-src="./img/user001following-pexels-photo-355302.png" class="pexelsphoto355302" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                </div>
                            </div>
                        </div>
                        <div class="contentcard4">
                            <div class="content">
                                <div class="base">
                                </div>
                                <div class="autor">
                                    <div class="autorname">
                                        by 能年 玲奈
                                    </div>
                                    <img anima-src="./img/user001following-autorimg@2x.png" class="autorimg" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                </div>
                                <div class="stars">
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px1" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px2" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px3" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstarhalf24px@2x.png" class="icstarhalf24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                </div>
                                <div class="price">
                                    ¥600 -
                                </div>
                                <div class="contentname">
                                    秋のことばを学ぶ。
                                </div>
                                <div class="contentimg">
                                    <div class="mask">
                                    </div>
                                    <img anima-src="./img/user001following-pexels-photo-355302.png" class="pexelsphoto355302" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                </div>
                            </div>
                        </div>
                        <div class="contentcard5">
                            <div class="content">
                                <div class="base">
                                </div>
                                <div class="autor">
                                    <div class="autorname">
                                        by 能年 玲奈
                                    </div>
                                    <img anima-src="./img/user001following-autorimg@2x.png" class="autorimg" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                </div>
                                <div class="stars">
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px1" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px2" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px3" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstarhalf24px@2x.png" class="icstarhalf24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                </div>
                                <div class="price">
                                    ¥600 -
                                </div>
                                <div class="contentname">
                                    秋のことばを学ぶ。
                                </div>
                                <div class="contentimg">
                                    <div class="mask">
                                    </div>
                                    <img anima-src="./img/user001following-pexels-photo-355302.png" class="pexelsphoto355302" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                </div>
                            </div>
                        </div>
                        <div class="h2">
                            最新の教材
                        </div>
                    </div>
                    <div class="rectangle5">
                    </div>
                    <div class="teacherspopular">
                        <div class="teachercard">
                            <img anima-src="./img/loginsns-base.png" class="base" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                            <img anima-src="./img/loginsns-icclose@2x.png" class="icclose" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                            <div class="teachername">
                                橋本 環奈
                            </div>
                            <div class="teacherbio">
                                タイの大学で働いています。過去には中国の学校にもいました。
                            </div>
                            <img anima-src="./img/loginsns-teacherimg@2x.png" class="teacherimg" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                        </div>
                        <div class="teachercard1">
                            <img anima-src="./img/loginsns-base.png" class="base" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                            <img anima-src="./img/loginsns-icclose@2x.png" class="icclose" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                            <div class="teachername">
                                橋本 環奈
                            </div>
                            <div class="teacherbio">
                                タイの大学で働いています。過去には中国の学校にもいました。
                            </div>
                            <img anima-src="./img/loginsns-teacherimg@2x.png" class="teacherimg" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                        </div>
                        <div class="teachercard2">
                            <img anima-src="./img/loginsns-base.png" class="base" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                            <img anima-src="./img/loginsns-icclose@2x.png" class="icclose" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                            <div class="teachername">
                                橋本 環奈
                            </div>
                            <div class="teacherbio">
                                タイの大学で働いています。過去には中国の学校にもいました。
                            </div>
                            <img anima-src="./img/loginsns-teacherimg@2x.png" class="teacherimg" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                        </div>
                        <div class="teachercard3">
                            <img anima-src="./img/loginsns-base.png" class="base" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                            <img anima-src="./img/loginsns-icclose@2x.png" class="icclose" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                            <div class="teachername">
                                橋本 環奈
                            </div>
                            <div class="teacherbio">
                                タイの大学で働いています。過去には中国の学校にもいました。
                            </div>
                            <img anima-src="./img/loginsns-teacherimg@2x.png" class="teacherimg" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                        </div>
                        <div class="teachercard4">
                            <img anima-src="./img/loginsns-base.png" class="base" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                            <img anima-src="./img/loginsns-icclose@2x.png" class="icclose" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                            <div class="teachername">
                                橋本 環奈
                            </div>
                            <div class="teacherbio">
                                タイの大学で働いています。過去には中国の学校にもいました。
                            </div>
                            <img anima-src="./img/loginsns-teacherimg@2x.png" class="teacherimg" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                        </div>
                        <div class="teachercard5">
                            <img anima-src="./img/loginsns-base.png" class="base" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                            <img anima-src="./img/loginsns-icclose@2x.png" class="icclose" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                            <div class="teachername">
                                橋本 環奈
                            </div>
                            <div class="teacherbio">
                                タイの大学で働いています。過去には中国の学校にもいました。
                            </div>
                            <img anima-src="./img/loginsns-teacherimg@2x.png" class="teacherimg" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                        </div>
                        <div class="h2">
                            人気の先生
                        </div>
                    </div>
                    <div class="line">
                    </div>
                    <div class="recomendcontent">
                        <div class="contentcard">
                            <div class="content">
                                <div class="base">
                                </div>
                                <div class="autor">
                                    <div class="autorname">
                                        by 能年 玲奈
                                    </div>
                                    <img anima-src="./img/user001following-autorimg@2x.png" class="autorimg" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                </div>
                                <div class="stars">
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px1" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px2" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px3" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstarhalf24px@2x.png" class="icstarhalf24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                </div>
                                <div class="price">
                                    ¥600 -
                                </div>
                                <div class="contentname">
                                    秋のことばを学ぶ。
                                </div>
                                <div class="contentimg">
                                    <div class="mask">
                                    </div>
                                    <img anima-src="./img/user001following-pexels-photo-355302.png" class="pexelsphoto355302" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                </div>
                            </div>
                        </div>
                        <div class="contentcard1">
                            <div class="content">
                                <div class="base">
                                </div>
                                <div class="autor">
                                    <div class="autorname">
                                        by 能年 玲奈
                                    </div>
                                    <img anima-src="./img/user001following-autorimg@2x.png" class="autorimg" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                </div>
                                <div class="stars">
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px1" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px2" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px3" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstarhalf24px@2x.png" class="icstarhalf24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                </div>
                                <div class="price">
                                    ¥600 -
                                </div>
                                <div class="contentname">
                                    秋のことばを学ぶ。
                                </div>
                                <div class="contentimg">
                                    <div class="mask">
                                    </div>
                                    <img anima-src="./img/user001following-pexels-photo-355302.png" class="pexelsphoto355302" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                </div>
                            </div>
                        </div>
                        <div class="contentcard2">
                            <div class="content">
                                <div class="base">
                                </div>
                                <div class="autor">
                                    <div class="autorname">
                                        by 能年 玲奈
                                    </div>
                                    <img anima-src="./img/user001following-autorimg@2x.png" class="autorimg" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                </div>
                                <div class="stars">
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px1" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px2" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstar24px@2x.png" class="icstar24px3" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                    <img anima-src="./img/user001following-icstarhalf24px@2x.png" class="icstarhalf24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                </div>
                                <div class="price">
                                    ¥600 -
                                </div>
                                <div class="contentname">
                                    秋のことばを学ぶ。
                                </div>
                                <div class="contentimg">
                                    <div class="mask">
                                    </div>
                                    <img anima-src="./img/user001following-pexels-photo-355302.png" class="pexelsphoto355302" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                </div>
                            </div>
                        </div>
                        <div class="h2">
                            あなたへのおすすめ教材
                        </div>
                    </div>
                    <div class="ad">
                        <img anima-src="./img/loginsns-adarea.png" class="adarea" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                        <div class="admessage">
                            広告枠
                        </div>
                        <div class="icclose24px">
                            <img anima-src="./img/loginsns-icclose24px@2x.png" class="icclose24px1" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                        </div>
                    </div>
                </div>
                <div class="sidebar">
                    <img anima-src="./img/user001following-sidebase.png" class="sidebase" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                    <img anima-src="./img/user001following-line@2x.png" class="line" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                    <img anima-src="./img/user001following-line@2x.png" class="line1" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                    <div class="followlist">
                        <div class="btnmore">
                            <div class="btnarea">
                            </div>
                            <div class="text1">
                                もっと見る
                            </div>
                        </div>
                        <div class="usersfollowing">
                            <div class="group">
                                <div class="username">
                                    坂口 健太郎
                                </div>
                                <img anima-src="./img/user001following-userimg 5@2x.png" class="userimg" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                            </div>
                            <div class="group1">
                                <div class="username">
                                    坂口 健太郎
                                </div>
                                <img anima-src="./img/user001following-userimg 5@2x.png" class="userimg" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                            </div>
                            <div class="group2">
                                <div class="username">
                                    坂口 健太郎
                                </div>
                                <img anima-src="./img/user001following-userimg 5@2x.png" class="userimg" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                                <img anima-src="./img/user001following-notification@2x.png" class="notification" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                            </div>
                            <div class="group3">
                                <div class="username">
                                    坂口 健太郎
                                </div>
                                <img anima-src="./img/user001following-userimg 5@2x.png" class="userimg" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                            </div>
                            <div class="group4">
                                <div class="username">
                                    坂口 健太郎
                                </div>
                                <img anima-src="./img/user001following-userimg 5@2x.png" class="userimg" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                            </div>
                        </div>
                        <div class="text">
                            フォローリスト
                        </div>
                    </div>
                    <div class="sidesubmenu">
                        <div class="sidebarmenu">
                            <div class="text">
                                設定
                            </div>
                            <img anima-src="./img/user001following-icsettings24px@2x.png" class="icsettings24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                        </div>
                        <div class="sidebarmenu1">
                            <div class="text">
                                フィードバック
                            </div>
                            <img anima-src="./img/user001following-icfeedback24px@2x.png" class="icfeedback24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                        </div>
                        <div class="sidebarmenu2">
                            <div class="text">
                                ヘルプ
                            </div>
                            <img anima-src="./img/user001following-ichelp24px@2x.png" class="ichelp24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                        </div>
                    </div>
                    <div class="sidemainmenu">
                        <div class="sidebarmenu">
                            <div class="text">
                                人気の教材
                            </div>
                            <img anima-src="./img/user001following-icgrade24px@2x.png" class="icgrade24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                        </div>
                        <div class="sidebarmenu1">
                            <div class="text">
                                マイページ
                            </div>
                            <img anima-src="./img/user001following-icaccountcircle24px@2x.png" class="icaccountcircle24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                        </div>
                        <div class="sidebarmenu2">
                            <div class="text">
                                フォローリスト
                            </div>
                            <img anima-src="./img/user001following-icsupervisoraccount24px@2x.png" class="icsupervisoraccount24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                        </div>
                        <div class="sidebarmenu3">
                            <div class="text">
                                閲覧履歴
                            </div>
                            <img anima-src="./img/user001following-ichistory24px@2x.png" class="ichistory24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                        </div>
                        <div class="sidebarmenu4">
                            <div class="text">
                                お気に入り
                            </div>
                            <img anima-src="./img/user001following-icthumbup24px@2x.png" class="icthumbup24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                        </div>
                        <div class="sidebarmenunow">
                            <div class="text">
                                ホーム
                            </div>
                            <img anima-src="./img/user001following-ichome24px@2x.png" class="ichome24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                        </div>
                    </div>
                </div>
                <div class="headerindex">
                    <div class="area">
                    </div>
                    <div class="menus">
                        <div class="menu">
                            カテゴリー
                        </div>
                        <div class="menu1">
                            ホーム
                        </div>
                        <div class="menu2">
                            <div class="menu3">
                                フォローリスト
                            </div>
                            <img anima-src="./img/user001following-notification@2x.png" class="notification" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                        </div>
                    </div>
                    <div class="search">
                        <img anima-src="./img/user001following-icsearch24px@2x.png" class="icsearch24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                        <div class="text">
                            教材を検索する..
                        </div>
                    </div>
                    <img anima-src="./img/user001following-notifications@2x.png" class="notifications" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                    <img anima-src="./img/user001following-icexpandmore24px@2x.png" class="icexpandmore24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                    <div class="overridesavatar">
                        <img anima-src="./img/user001following-mask@2x.png" class="mask" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                        <img anima-src="./img/user001following-avatar@2x.png" class="avatar" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                    </div>
                    <div class="btnupload">
                        <div class="btnarea">
                        </div>
                        <img anima-src="./img/user001following-icbackup24px@2x.png" class="icbackup24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                        <div class="text">
                            教材を投稿する
                        </div>
                    </div>
                    <img anima-src="./img/user001following-logoedopen@2x.png" class="logoedopen" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                    <img anima-src="./img/user001following-icmenu24px@2x.png" class="icmenu24px" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="/>
                </div>
            </div>
        </div>
        <!-- Scripts -->
        <script>
            anima_isHidden = function(e) {
                if (!(e instanceof HTMLElement)) return !1;
                if (getComputedStyle(e).display == "none") return !0; else if (e.parentNode && anima_isHidden(e.parentNode)) return !0;
                return !1;
            };
            anima_loadAsyncSrcForTag = function(tag) {
                var elements = document.getElementsByTagName(tag);
                var toLoad = [];
                for (var i = 0; i < elements.length; i++) {
                    var e = elements[i];
                    var src = e.getAttribute("src");
                    var loaded = (src != undefined && src.length > 0 && src != 'data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==');
                    if (loaded) continue;
                    var asyncSrc = e.getAttribute("anima-src");
                    if (asyncSrc == undefined || asyncSrc.length == 0) continue;
                    if (anima_isHidden(e)) continue;
                    toLoad.push(e);
                }
                toLoad.sort(function(a, b) {
                    return anima_getTop(a) - anima_getTop(b);
                });
                for (var i = 0; i < toLoad.length; i++) {
                    var e = toLoad[i];
                    var asyncSrc = e.getAttribute("anima-src");
                    e.setAttribute("src", asyncSrc);
                }
            };
            anima_pauseHiddenVideos = function(tag) {
                var elements = document.getElementsByTagName("video");
                for (var i = 0; i < elements.length; i++) {
                    var e = elements[i];
                    var isPlaying = !!(e.currentTime > 0 && !e.paused && !e.ended && e.readyState > 2);
                    var isHidden = anima_isHidden(e);
                    if (!isPlaying && !isHidden && e.getAttribute("autoplay") == "autoplay") {
                        e.play();
                    } else if (isPlaying && isHidden) {
                        e.pause();
                    }
                }
            };
            anima_loadAsyncSrc = function(tag) {
                anima_loadAsyncSrcForTag("img");
                anima_loadAsyncSrcForTag("iframe");
                anima_loadAsyncSrcForTag("video");
                anima_pauseHiddenVideos();
            };
            var anima_getTop = function(e) {
                var top = 0;
                do {
                    top += e.offsetTop || 0;
                    e = e.offsetParent;
                } while (e);
                return top;
            };
            anima_loadAsyncSrc();
            anima_old_onResize = window.onresize;
            anima_new_onResize = undefined;
            anima_updateOnResize = function() {
                if (anima_new_onResize == undefined || window.onresize != anima_new_onResize) {
                    anima_new_onResize = function(x) {
                        if (anima_old_onResize != undefined) anima_old_onResize(x);
                        anima_loadAsyncSrc();
                    };
                    window.onresize = anima_new_onResize;
                    setTimeout(function() {
                        anima_updateOnResize();
                    }, 3000);
                }
            };
            anima_updateOnResize();
            setTimeout(function() {
                anima_loadAsyncSrc();
            }, 200);
        </script>
        <!-- End of Scripts -->
    </body>
</html>











@endsection
