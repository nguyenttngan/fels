@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('messages.login')</div>
                <div class="panel-body">
                    {!! Form::open(['method' => 'POST',
                        'action' => 'Auth\LoginController@login',
                        'class' => 'form-horizontal',
                        'role' => 'form',
                    ]) !!}

                        <div class="{!! Form::showErrClass('email') !!}">
                            {!! Form::label('email', trans('messages.email'), ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::email('email', null, [
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

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('remember') !!} @lang('messages.remember_me')
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                {!! Form::submit('Login', ['class' => 'btn btn-primary btn-raised']) !!}

                                <a class="btn btn-link"
                                    href="{{ action('Auth\ForgotPasswordController@showLinkRequestForm') }}">
                                    @lang('messages.forgot_password')
                                </a>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <div class="col-md-4 col-md-offset-4">
                        @lang('messages.loginwith') :
                        <a href="{{ action('Auth\SocialAuthController@redirect', [
                            'provider' => config('custom.provider.facebook')
                            ]) }}" class="btn btn-social-icon btn-facebook">
                            <span class="fa fa-facebook"></span>
                        </a>
                        <a href="{{ action('Auth\SocialAuthController@redirect', [
                            'provider' => config('custom.provider.google')
                            ]) }}" class="btn btn-social-icon btn-google">
                            <span class="fa fa-google"></span>
                        </a>
                        <a href="{{ action('Auth\SocialAuthController@redirect', [
                            'provider' => config('custom.provider.twitter')
                            ]) }}" class="btn btn-social-icon btn-twitter">
                            <span class="fa fa-twitter"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
