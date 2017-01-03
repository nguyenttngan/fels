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

</head>
<body>
    <div id="app">
        @include('layouts.header')
        @yield('content')
    </div>

    <!-- Scripts -->
    {!! Html::script(elixir('js/app.js')) !!}
    @yield('js')
</body>
</html>
