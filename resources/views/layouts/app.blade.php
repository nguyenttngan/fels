<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@lang('messages.title')</title>

    <!-- Styles -->
    {!! Html::style(elixir('css/app.css')) !!}
    {!! Html::style(elixir('css/bootstrap-social.css')) !!}


</head>
<body>
    <div id="app">
        @include('layouts.header')
        @yield('content')
        @include('layouts.footer')
    </div>

    <!-- Scripts -->
    {!! Html::script(elixir('js/app.js')) !!}
    {!! Html::script(elixir('js/laroute.js')) !!}
    <script src="https://use.fontawesome.com/48d8ab8fc4.js"></script>
    @yield('js')
</body>
</html>
