@extends('layouts.app')

<!-- Main Content -->
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
                        'class' => 'form-horizontal',
                        'role' => 'form',
                        'action' => 'Auth\ForgotPasswordController@sendResetLinkEmail',
                    ]) !!}

                        <div class="{!! Form::showErrClass('email') !!}">
                            {!! Form::label('email', trans('messages.email'), ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::email('email', null, [
                                    'class' => 'form-control',
                                    'id' => 'email',
                                    'required',
                                ]) !!}
                                {!! Form::showErrField('email') !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit( trans('messages.send_reset_link'), ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
