@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                {{ trans_choice('messages.activities', count($lessons)) }}
            </div>
            <div class="panel-body">
            @if (count($lessons) != 0)
                @foreach ($lessons as $lesson)
                    <ul>
                        <li>
                            <a href="{{ action('Web\LessonsController@show', ['lessonId' => $lesson->id]) }}">
                            @lang('messages.learned') {{ $lesson->words()->count() }}
                            {{ trans_choice('messages.words', $lesson->words()->count()) }} @lang('messages.in')
                            {{ trans_choice('messages.lessons', 1) }}
                            <strong>{{ $lesson->category->name }}</strong> - {{ $lesson->created_at }} </a>
                        </li>
                    </ul>
                @endforeach
                {{ $lessons->links() }}
            @else
                @lang('messages.noact')
            @endif
            </div>
        </div>
    </div>
</div>
@endsection
