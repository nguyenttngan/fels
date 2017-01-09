@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    {{ trans('messages.edit', ['item' => trans_choice('messages.categories', 1)])}}
                </div>
                <div class="panel-body">
                    {!! Form::open([
                        'method' => 'PUT',
                        'action' => ['Admin\CategoryController@update', $category->id],
                        'class' => 'form-horizontal',
                    ]) !!}

                        <div class="{!! Form::showErrClass('name') !!}">
                            {!! Form::label('name', trans('messages.name'), ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('name', $category->name, [
                                    'class' => 'form-control',
                                    'id' => 'name',
                                    'required',
                                    'autofocus',
                                ]) !!}
                                {!! Form::showErrField('name') !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <div class="btn-group">
                                    {!! Form::submit(trans('messages.edit'), ['class' => 'btn btn-success']) !!}
                                    <a class="btn btn-primary pull-right"
                                        href="{{ action('Admin\CategoryController@index') }}">@lang('messages.cancel')
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
