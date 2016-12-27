@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('messages.reset_password')</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {!! Form::open(['method' => 'POST',
                        'action' => 'Auth\ResetPasswordController@reset',
                        'class' => 'form-horizontal',
                        'role' => 'form',
                    ]) !!}

                        {!! Form::hidden('token', $token) !!}

                        <div class="{!! Form::showErrClass('email') !!}">
                            {!! Form::label('email', trans('messages.email'),
                                ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::email('email', $email, [
                                    'class' => 'form-control',
                                    'id' => 'email',
                                    'required',
                                    'autofocus',
                                ]) !!}
                                {!! Form::showErrField('email') !!}
                            </div>
                        </div>

                        <div class="{!! Form::showErrClass('password') !!}">
                            {!! Form::label('password', trans('messages.password'),
                                ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::password('password', [
                                    'class' => 'form-control',
                                    'id' => 'password',
                                    'required',
                                ]) !!}
                                {!! Form::showErrField('password') !!}
                            </div>
                        </div>

                        <div class="{!! Form::showErrClass('password_confirmation') !!}">
                            {!! Form::label('password-confirm', trans('messages.confirm_password'),
                                ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::password('password_confirmation', [
                                    'class' => 'form-control',
                                    'id' => 'password-confirm',
                                    'required',
                                ]) !!}

                                {!! Form::showErrField('password_confirmation') !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit(trans('messages.reset_password'), ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
