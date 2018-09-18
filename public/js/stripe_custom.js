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
    hiddenInput.setAttribute('type', 'hidden');//フォームデータのvalueを取得
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    form.submit();
}
