@extends('layouts.admin.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            {!! Form::open([
                'action' => 'Admin\WordsController@index',
                'method' => 'get'
            ]) !!}
                {!! Form::label('categories', trans_choice('messages.categories', 2), [
                    'class' => 'control-label'])
                !!}
                <div class="form-group">
                    {!! Form::select('category_id', $categorySelect, $categoryId, [
                        'placeholder' => trans('messages.all'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit(trans('messages.filter'), [
                        'class' => 'btn btn-primary',
                    ]) !!}
                </div>
            {!! Form::close() !!}
            @yield('word')
        </div>
    </div>
</div>
@endsection
