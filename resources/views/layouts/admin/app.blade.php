<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@lang('messages.title')</title>

    <!-- Styles -->
    {!! Html::style(elixir('css/app.css')) !!}

</head>
<body>
    <div id="app">
        @include('layouts.admin.header')
        <main class="content">
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>

    <!-- Scripts -->
    {!! Html::script(elixir('js/app.js')) !!}
    {!! Html::script(elixir('js/laroute.js')) !!}
    @yield('js')
</body>
</html>
