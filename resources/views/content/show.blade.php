@extends('layouts.app')

@section('title','Show')

@php
    // dd($content->id);
@endphp

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


<script src="https://js.stripe.com/v3/"></script>

<script type="text/javascript">
    var stripe = Stripe('pk_test_DkBhCe5j7DYIXalUiOULSwra');
    var elements = stripe.elements({
        fonts: [
            {
                  family: 'Open Sans',
                  weight: 400,
                  src: 'local("Open Sans"), local("OpenSans"), url(https://fonts.gstatic.com/s/opensans/v13/cJZKeOuBrn4kERxqtaUH3ZBw1xU1rKptJj_0jans920.woff2) format("woff2")',
                  unicodeRange: 'U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215',
            },
        ]
    });

    var style = {
      base: {
        // ここでStyleの調整をします。
        fontSize: '16px',conColor: '#F99A52',
        color: '#32315E',
        lineHeight: '48px',
        fontWeight: 400,
        fontFamily: '"Open Sans", "Helvetica Neue", "Helvetica", sans-serif',
        fontSize: '15px',
        '::placeholder': {
          color: '#CFD7DF',
        }
      }
    };

    // card Element のインスタンスを作成
    var card = elements.create('card', {
        hidePostalCode: true,
        style: style
    });

    // マウント
    card.mount('#card-element');

    card.addEventListener('change', function(event) {
      var displayError = document.getElementById('card-errors');
      if (event.error) {
        displayError.textContent = event.error.message;
      } else {
        displayError.textContent = '';
      }
    });


    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // エラー表示.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // トークンをサーバに送信
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token) {
        // tokenをフォームへ包含し送信
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit します
        form.submit();
    }


</script>

<style media="screen">
    @font-face {
        font-family: 'Open Sans';
        font-weight: 400;
        src: local("Open Sans"), local("OpenSans"), url(https://fonts.gstatic.com/s/opensans/v13/cJZKeOuBrn4kERxqtaUH3ZBw1xU1rKptJj_0jans920.woff2) format("woff2");
        unicodeRange: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215;
    }

    * {
        font-family: "Open Sans", "Helvetica Neue", Helvetica, sans-serif;
        font-size: 15px;
        font-variant: normal;
        padding: 0;
        margin: 0;
    }

    html {
        height: 100%;
    }

    body {
        background: #F6F9FC;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100%;
    }

    form {
        width: 480px;
        margin: 20px 0;
    }

    label {
        position: relative;
        color: #6A7C94;
        font-weight: 400;
        height: 48px;
        line-height: 48px;
        margin-bottom: 10px;
        display: flex;
        flex-direction: row;
    }

    label > span {
        width: 115px;
    }

    .field {
        background: white;
        box-sizing: border-box;
        font-weight: 400;
        border: 1px solid #CFD7DF;
        border-radius: 24px;
        color: #32315E;
        outline: none;
        flex: 1;
        height: 48px;
        line-height: 48px;
        padding: 0 20px;
        cursor: text;
    }

    .field::-webkit-input-placeholder { color: #CFD7DF; }
    .field::-moz-placeholder { color: #CFD7DF; }

    .field:focus,
    .field.StripeElement--focus {
        border-color: #F99A52;
    }

    button {
        float: left;
        display: block;
        background-image: linear-gradient(-180deg, #F8B563 0%, #F99A52 100%);
        box-shadow: 0 1px 2px 0 rgba(0,0,0,0.10), inset 0 -1px 0 0 #E57C45;
        color: white;
        border-radius: 24px;
        border: 0;
        margin-top: 20px;
        font-size: 17px;
        font-weight: 500;
        width: 100%;
        height: 48px;
        line-height: 48px;
        outline: none;
    }

    button:focus {
        background: #EF8C41;
    }

    button:active {
        background: #E17422;
    }

    .outcome {
        float: left;
        width: 100%;
        padding-top: 8px;
        min-height: 20px;
        text-align: center;
    }

    .success, .error {
        display: none;
        font-size: 13px;
    }

    .success.visible, .error.visible {
        display: inline;
    }

    .error {
        color: #E4584C;
    }

    .success {
        color: #F8B563;
    }

    .success .token {
        font-weight: 500;
        font-size: 13px;
    }

    /* 追加 */
    div#card-element {
        width: 400px;
    }
</style>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<a href="/">もどる</a>


@endsection
