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
                        @lang('messages.followed') :
                        <a href="{{ action('Web\FollowsController@show', ['user' => Auth::id()]) }}">
                            {{ $numOfFollowed }}
                        </a>
                    </li>
                    <li>
                        @lang('messages.users') :
                        {!! $users->each(function ($user) {
                                $user->name = link_to_action('Web\UsersController@show', $user->name, [
                                    'user' => $user->id
                                ]);

                                return $user;
                            })->implode('name', ', ')
                        !!}
                    </li>
                    {{ $users->links() }}
                </ul>
            </div>
            <div class="col-md-8">
                <div class="panel panel-info">
                    <div class="panel-heading">{{ trans_choice('messages.activities', $lessons->total()) }}</div>
                    <div class="panel-body">
                    @if ($lessons->total() != 0)
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
        <div class="row">
            <div class="col-md-8 col-md-offset-4">
                <div class="panel panel-info">
                    <div class="panel-heading">@lang('messages.following')</div>
                    <div class="panel-body">
                    @if (count($follows) != 0)
                        @if ($lessonsOfFollowed->total() != 0)
                            @foreach ($lessonsOfFollowed as $lesson)
                            <ul>
                                <li>
                                    <a href="{{ action('Web\LessonsController@show', ['lessonId' => $lesson->id]) }}">
                                    {{ $lesson->user->name }} @lang('messages.learned') {{ $lesson->words()->count() }}
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
                    @else
                        @lang('messages.notfollowing', ['User' => trans('messages.you')])
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
