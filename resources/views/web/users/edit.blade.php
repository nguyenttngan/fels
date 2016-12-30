@extends('layouts.app')

@section('content')
    <div class="row col-md-6 col-md-offset-3">
        {!! Form::open(['url' => action('Web\UsersController@update', ['user' => $user->id]),
            'method' => 'put',
            'files' => true]) !!}
        <h3> {{ $user->name }}</h3>
        <div>
            <img src="{{ $user->avatarUrl }}" alt="avatar" class="avatar-profile"> {!! Form::file('avatar') !!}
        </div>
        <div class="{!! Form::showErrClass('name') !!}">
            <label>{{ trans('messages.name') }}</label>
            {!! Form::text('name', $user->name, [
                'class' => 'form-control',
                'id' => 'name',
                'required',
                'autofocus',
            ]) !!}
            {!! Form::showErrField('name') !!}
        </div>
        <div class="{!! Form::showErrClass('password') !!}">
            <label>{{ trans('messages.password') }}</label>
            {!! Form::password('password', [
                'placeholder' => trans('messages.unchanged'),
                'class' => 'form-control',
                'id' => 'password',
            ]) !!}
            {!! Form::showErrField('password') !!}
        </div>
        <div class="{!! Form::showErrClass('email') !!}">
            <label>{{ trans('messages.email') }} </label>
            {!! Form::email('email', $user->email, [
                'class' => 'form-control',
                'id' => 'email',
                'required',
            ]) !!}
            {!! Form::showErrField('email') !!}
        </div>
        <div>
            {!! Form::submit(trans('messages.save'), ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
