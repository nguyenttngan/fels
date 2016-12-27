<div>
    <div class="form-group">
        {!! Form::open(array('url' => action('Web\WordsController@index'), 'method' => 'get')) !!}
        Category:
        {!! Form::select('category_id', $categorySelect, $categoryId, ['placeholder' => trans('messages.all') ]) !!}
        {!! Form::radio('filter', '', $filter == '') !!} {{ trans('messages.all') }}
        {!! Form::radio('filter', 'learned', $filter == config('custom.filter.learned')) !!} {{ trans('messages.learned') }}
        {!! Form::radio('filter', 'unlearned', $filter == config('custom.filter.unlearned')) !!} {{ trans('messages.unlearned') }}
        {!! Form::submit(trans('messages.filter')) !!}
        {!! Form::close() !!}
    </div>
</div>
