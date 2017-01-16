@extends('layouts.app')

@section('content')
    <div class="row col-md-6 col-md-offset-3">
        <h3>{{ $user->name }}</h3>
        <div class="pull-right">
            @if($user->id != Auth::id())
                @if($following)
                    {!! Form::button(trans('messages.following'), [
                        'class' => 'btn button follow following',
                        'data-id' => $user->id,
                        'data-follow' => trans('messages.follow'),
                        'data-following' => trans('messages.following'),
                        'data-unfollow' => trans('messages.unfollow'),
                    ]) !!}
                @else
                    {!! Form::button(trans('messages.follow'), [
                        'class' => 'btn button follow',
                        'data-id' => $user->id,
                        'data-follow' => trans('messages.follow'),
                        'data-following' => trans('messages.following'),
                        'data-unfollow' => trans('messages.unfollow'),
                    ]) !!}
                @endif
            @endif
            @can('update-user-profile', $user)
                <a href="{{ action('Web\UsersController@edit') }}" type="button" class="btn btn-primary btn-md">
                    <span class="glyphicon glyphicon-pencil"></span> {{ trans('messages.edit') }}
                </a>
            @endcan
        </div>
        <img src="{{ $user->avatarUrl }}" alt="avatar" class="avatar-profile">
        <h4>{{ trans('messages.name') }}</h4>
        <li class="list-group-item"> {{ $user->name }}</li>
        <h4>{{ trans('messages.email') }} </h4>
        <li class="list-group-item"> {{ $user->email }}</li>
    </div>
@endsection

@section('js')
    {!! Html::script(elixir('js/follow.js')) !!}
@endsection
