<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{!! asset('/css/bootstrap.min.css') !!}" type="text/css">
    <link rel="stylesheet" href="{!! asset('/css/custom.css') !!}">


    <script type="text/javascript" src="{!! asset('/js/jquery-3.3.1.slim.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/jquery-3.3.1.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/jquery.validate.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/bootstrap.min.js') !!}"></script>

</head>

<body>
    <div class="content">
        @yield('content')
    </div>
</body>
</html>
