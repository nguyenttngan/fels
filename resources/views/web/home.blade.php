@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <ul>
                    <img src="{{ Auth::user()->avatarUrl }}" alt="avatar" class="avatar-profile">
                    <li>
                        <a href="{{ action('Web\UsersController@show') }}">{{ Auth::user()->name }}</a>
                    </li>
                    <li>
                        @lang('messages.learned') {{ $numOfLearnedWord }} {{ trans_choice('messages.words', 2) }}
                    </li>
                    <li>
                        @lang('messages.followed') : <a href="{{ action('Web\FollowsController@show', ['user' => Auth::id()]) }}">{{ $numOfFollowed }}</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-8">
                <div class="panel panel-info">
                    <div class="panel-heading">{{ trans_choice('messages.activities', count($lessons)) }}</div>

                    <div class="panel-body">
                        @foreach ($lessons as $lesson)
                        <ul>
                            <li>
                                <a href="{{ action('Web\LessonsController@show', ['lessonId' => $lesson->id]) }}">
                                @lang('messages.learned') {{ $lesson->words()->count() }}
                                @lang('messages.learned') @lang('messages.in') {{ trans_choice('messages.lessons', 1) }}
                                <strong>{{ $lesson->category->name }}</strong> - {{ $lesson->created_at }} </a>
                            </li>
                        </ul>
                        @endforeach
                        {{ $lessons->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
