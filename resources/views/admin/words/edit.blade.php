@extends('layouts.admin.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        {{ trans('messages.edit', ['item' => trans_choice('messages.words', 1)]) }}
                    </div>
                    <div class="panel-body">
                        {!! Form::open([
                            'method' => 'PUT',
                            'action' => ['Admin\WordsController@update', $word->id],
                            'class' => 'form-horizontal',
                        ]) !!}
                        <div class="{!! Form::showErrClass('name') !!}">
                            {!! Form::label('word', trans_choice('messages.words', 1), ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('word', $word->word, [
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
                                {!! Form::select('category', $categoriesCollection, $word->category->id, [
                                    'class' => 'has-feedback form-group has-feedback-right list-group-item']) !!}
                                {!! Form::showErrField('word') !!}
                            </div>
                        </div>
                        <div class="{!! Form::showErrClass('meaning_id') !!}">
                            {!! Form::label('meaning', trans_choice('messages.meanings', 1), ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                <div class="has-feedback form-group has-feedback-right list-group-item">
                                    {!! Form::text('meaning[' . $word->correctMeaning->id . ']', $word->correctMeaning->content, [
                                        'class' => 'form-control',
                                        'required',
                                        'autofocus',
                                    ]) !!}
                                    <i class="glyphicon glyphicon-ok form-control-feedback"></i>
                                </div>
                                @foreach($falseMeanings as $meaning)
                                    <div class="has-feedback form-group has-feedback-right list-group-item">
                                        {!! Form::text('meaning[' . $meaning->id . ']', $meaning->content, [
                                            'class' => 'form-control',
                                            'required',
                                            'autofocus',
                                        ]) !!}
                                        <i class="glyphicon glyphicon-remove form-control-feedback"></i>
                                    </div>
                                @endforeach
                                {!! Form::showErrField('meaning_id') !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <div class="btn-group">
                                    {!! Form::submit(trans('messages.update'), ['class' => 'btn btn-success']) !!}
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
