<a href="{{ action('Auth\LoginController@logout') }}"
    onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
    @lang('messages.logout')
</a>

{!! Form::open([
    'method' => 'POST',
    'action' => 'Auth\LoginController@logout',
    'id' => 'logout-form',
    'style' => 'display: none;',
]) !!}
{!! Form::close() !!}
