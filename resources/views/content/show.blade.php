@extends('layouts.app')

@section('title','Show')

@section('content')
<table>
    @if ($content_imgs)
        @foreach ($content_imgs as $index => $img)
            <tr>
                <th>画像{{ $index+1 }}</th>
                <td>
                    <img style="width:200px;" src="{!! asset('storage/content_images/'.$content->id.'/'.$img->img) !!}" alt="教材イメージ">
                </td>
            </tr>
        @endforeach
    @endif
    <tr>
        <th>タイトル</th><td>{{ $content->title }}</td>
    </tr>
    <tr>
        <th>教材詳細</th><td>{{ $content->detail }}</td>
    </tr>
    <tr>
        <th>販売価格</th><td>{{ $content->price }}</td>
    </tr>
    <tr>
        <th>教材コンテンツ</th><td>{{ $content->teaching_material }}</td>
    </tr>
</table>


{{-- stripe決済 --}}
<script src="https://js.stripe.com/v3/"></script>
<form action="/charge" method="post" id="payment-form">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $content->id }}">
    <input type="hidden" name="price" value="{{ $content->price }}">
    <input type="hidden" name="file_name" value="{{ $content->teaching_material }}">
    <div class="form-row">
        <label for="card-element">
            クレジット・デビットカード番号
        </label>
        <div id="card-element">
            <!-- Stripe Element がここに入ります。 -->
        </div>

        <!-- Element のエラーを入れます。 -->
        <div id="card-errors" role="alert"></div>
    </div>
    <button>お支払い</button>
</form>
<script type="text/javascript" src="{!! asset('/js/stripe_custom.js') !!}"></script>


<br>
<br>
<br>
<br>

@if ($content->user_id == $login_id)
    <a href="/content/edit?id={{ $content->id }}">編集ボタン</a>
    <br>
    <a href="/content/delete?id={{ $content->id }}">削除ボタン</a>
@endif

<br>
<br>
<br>
<br>

<a href="/">もどる</a>


@endsection
