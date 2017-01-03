@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($categories as $category)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <strong>{{ $category->name }}</strong>
                    @lang('messages.youve') @lang('messages.learned')
                    {{ Auth::user()->countLearnedWords($category->id) }}/{{ $category->words()->count() }}
                    {{ trans_choice('messages.words', 2) }}
                </div>
                <div class="panel-body">
                    <a class="btn btn-info pull-right" href="{{ action('Web\LessonsController@create', [
                        'categoryId' => $category->id,
                    ]) }}">@lang('messages.start')</a>
                    {{ $category->words->take(5)->implode('word', ',') }}
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection
