@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        {{ $category->name }}
                    </div>
                    <div class="panel-body">
                        <div class="col-md-3 col-md-offset-2">
                            <h4>
                                <strong>{{ $word->word }}</strong>
                            </h4>
                        </div>
                        <div class="col-md-5">
                            <ul>
                                <li>Answer 1</li>
                                <li>Answer 2</li>
                                <li>Answer 3</li>
                                <li>Answer 4</li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a class="btn btn-info" href="{{ action('Web\LessonsController@create', [
                            'categoryId' => $category->id,
                            'lessonId' => $lesson->id,
                        ]) }}">@lang('messages.next')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
