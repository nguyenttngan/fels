@extends('layouts.admin.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        {{ trans('messages.new', ['item' => trans_choice('messages.words', 1)]) }}
                    </div>
                    <div class="panel-body">
                        {!! Form::open([
                            'method' => 'POST',
                            'action' => ['Admin\WordsController@store'],
                            'class' => 'form-horizontal',
                        ]) !!}
                        <div class="{!! Form::showErrClass('word') !!}">
                            {!! Form::label('word', trans_choice('messages.words', 1), ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('word', null, [
                                    'class' => 'form-control has-feedback form-group has-feedback-right list-group-item',
                                    'id' => 'word',
                                    'required',
                                    'autofocus',
                                ]) !!}
                                {!! Form::showErrField('word') !!}
                            </div>
                        </div>
                        <div class="{!! Form::showErrClass('category_id') !!}">
                            {!! Form::label('category', trans_choice('messages.categories', 1), ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('category', $categoriesCollection, null, [
                                    'class' => 'has-feedback form-group has-feedback-right list-group-item']) !!}
                                {!! Form::showErrField('category') !!}
                            </div>
                        </div>
                        <div class="{!! Form::showErrClass('meaning') !!}">
                            {!! Form::label('meaning', trans_choice('messages.meanings', 1), ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                @for ($i = 0; $i <4; $i++)
                                <div class="has-feedback form-group has-feedback-right list-group-item">
                                    {!! Form::text('meaning[' . $i .']', null, [
                                        'class' => 'form-control',
                                        'required',
                                        'autofocus',
                                    ]) !!}
                                    @if ($i == 0)
                                        <i class="glyphicon glyphicon-ok form-control-feedback"></i>
                                    @else
                                        <i class="glyphicon glyphicon-remove form-control-feedback"></i>
                                    @endif
                                </div>
                                @endfor
                                {!! Form::showErrField('meaning') !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <div class="btn-group">
                                    {!! Form::submit(trans('messages.save'), ['class' => 'btn btn-success']) !!}
                                    <a class="btn btn-primary pull-right"
                                       href="{{ action('Admin\WordsController@index') }}">@lang('messages.cancel')
                                    </a>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
