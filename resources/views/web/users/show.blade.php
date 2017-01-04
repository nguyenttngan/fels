@extends('layouts.app')

@section('content')
    <div class="row col-md-6 col-md-offset-3">
        <h3> {{ $user->name }}</h3>
        @can('update-user-profile', $user)
            <a href="{{ action('Web\UsersController@edit') }}" type="button" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-pencil"></span> {{ trans('messages.edit') }}
            </a>
        @endcan
        <img src="{{ $user->avatarUrl }}" alt="avatar" class="avatar-profile">
        <h4>{{ trans('messages.name') }}</h4>
        <li class="list-group-item"> {{ $user->name }}</li>
        <h4>{{ trans('messages.email') }} </h4>
        <li class="list-group-item"> {{ $user->email }}</li>
    </div>
@endsection
