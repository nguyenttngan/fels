@extends('layouts.app')

@section('content')
    <div>
        @foreach($users as $user)
            <li class="list-group-item col-md-6 col-md-offset-3">
                <a href="{{ action('Web\UsersController@show', ['user' => $user->id]) }}">
                    <img src="{{ $user->avatarUrl }}" alt="avatar" class="avatar-navigation"> {{ $user->name }}
                </a>
            </li>
        @endforeach
    </div>
@endsection
