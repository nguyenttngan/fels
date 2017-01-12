<nav class="navbar navbar-default navbar-static-top header">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ action('Web\HomeController@index') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav navbar-left">
                &nbsp;
                @if (!Auth::guest())
                    <li>
                        <a href="{{ action('Web\WordsController@index') }}">{{ trans_choice('messages.words', 2) }}</a>
                    </li>
                    <li>
                        <a href="{{ action('Web\CategoriesController@index') }}">
                            {{ trans_choice('messages.categories', 2) }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ action('Web\LessonsController@index') }}">
                            {{ trans_choice('messages.lessons', 2) }}
                        </a>
                    </li>
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li>
                        <a href="{{ action('Auth\LoginController@showLoginForm') }}">
                            @lang('messages.login')
                        </a>
                    </li>
                    <li>
                        <a href="{{ action('Auth\RegisterController@showRegistrationForm')}}">
                            @lang('messages.register')
                        </a>
                    </li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <img src="{{ Auth::user()->avatarUrl }}" alt="avatar" class="avatar-navigation">
                            {{ Auth::user()->name }}
                            <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ action('Web\UsersController@show') }}">@lang('messages.profile')</a>
                            </li>
                            <li>
                                @include('layouts._logout')
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
