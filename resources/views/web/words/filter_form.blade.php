@extends('layouts.app')
@section('content')
    <div class="col-md-6 col-md-offset-3">
        {!! Form::open([
            'action' => 'Web\WordsController@index',
            'method' => 'get'
        ]) !!}
            {!! trans_choice('messages.categories', 2) !!}
            <div class="form-group">
                {!! Form::select('category_id', $categorySelect, $categoryId, [
                    'placeholder' => trans('messages.all'),
                    'class' => 'form-control',
                ]) !!}
            </div>
            <div class="form-group">
                <label class="radio-inline">
                    {!! Form::radio('filter', '', $filter == '') !!} {{ trans('messages.all') }}
                </label>
                <label class="radio-inline">
                    {!! Form::radio('filter', 'learned', $filter == config('custom.filter.learned')) !!}
                        {{ trans('messages.learned') }}
                </label>
                <label class="radio-inline">
                    {!! Form::radio('filter', 'unlearned', $filter == config('custom.filter.unlearned')) !!}
                        {{ trans('messages.unlearned') }}
                </label>
            </div>
            <div class="form-group">
                {!! Form::submit(trans('messages.filter'), [
                    'class' => 'btn btn-primary',
                ]) !!}
            </div>
        {!! Form::close() !!}
        @yield('word')
    </div>
@endsection
