@extends('layouts.app')

@section('content')
    <div>
    @if (count($users) != 0)
        @foreach($users as $user)
            <li class="list-group-item col-md-6 col-md-offset-3">
                <a href="{{ action('Web\UsersController@show', ['user' => $user->id]) }}">
                    <img src="{{ $user->avatarUrl }}" alt="avatar" class="avatar-navigation"> {{ $user->name }}
                </a>
            </li>
        @endforeach
    @else
        <div class="col-md-8 col-md-offset-2">
            <div class="alert alert-info">
                @lang('messages.notfollowed', ['User' => $user->name])
            </div>
        </div>
    @endif
    </div>
@endsection
