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
            <a class="navbar-brand" href="{{ action('Admin\HomeController@index') }}">
                {{ config('custom.adminbrand', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">

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


    <!-- Left Side Of Navbar -->
<div class="nav-side-menu">
    <div class="menu-list">
        @if (!Auth::guest())
            <ul>
                <li data-toggle="collapse" data-target="#user" class="collapsed">
                    <a href="#"><i class="fa fa-user" aria-hidden="true"></i></i>Users<span class="caret"></span></a>
                </li>
                <ul class="sub-menu collapse" id="user">
                    <li>
                        <a href="{{ action('Admin\UsersController@index') }}">List users</a>
                    </li>
                    <li>
                        <a href="{{ action('Admin\UsersController@create') }}">Add user</a>
                    </li>
                </ul>
                <li data-toggle="collapse" data-target="#category" class="collapsed">
                    <a href="#"><i class="fa fa-suitcase" aria-hidden="true"></i>Categories<span class="caret"></span></a>
                </li>
                <ul class="sub-menu collapse" id="category">
                    <li>
                        <a href="{{ action('Admin\CategoryController@index') }}">List categories</a>
                    </li>
                    <li>
                        <a href="{{ action('Admin\CategoryController@create') }}">Add categories</a>
                    </li>
                </ul>
                <li data-toggle="collapse" data-target="#word" class="collapsed">
                    <a href="#"><i class="fa fa-file-word-o" aria-hidden="true"></i>Words<span class="caret"></span></a>
                </li>
                <ul class="sub-menu collapse" id="word">
                    <li>
                        <a href="{{ action('Admin\WordsController@index') }}">List words</a>
                    </li>
                    <li>
                        <a href="{{ action('Admin\WordsController@create') }}">Add word</a>
                    </li>
                </ul>

            </ul>
        @endif
    </div>
</div>


