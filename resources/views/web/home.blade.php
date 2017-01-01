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
                        @lang('messages.followed') : <a href="{{ action('Web\FollowsController@show') }}">{{ $numOfFollowed }}</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-8">
                <div class="panel panel-info">
                    <div class="panel-heading">{{ trans_choice('messages.activities', 2) }}</div>

                    <div class="panel-body">
                        <li>
                            <a href="#">
                                @lang('messages.learned') 20 {{ trans_choice('messages.words', 2)}}
                                in {{ trans_choice('messages.lessons', 1) }} "Basic 500" - 22/12/2016
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                @lang('messages.learned') 20 {{ trans_choice('messages.words', 2)}}
                                in {{ trans_choice('messages.lessons', 1) }} "Basic 500" - 22/12/2016
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                @lang('messages.learned') 20 {{ trans_choice('messages.words', 2)}}
                                in {{ trans_choice('messages.lessons', 1) }} "Basic 500" - 22/12/2016
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                @lang('messages.learned') 20 {{ trans_choice('messages.words', 2)}}
                                in {{ trans_choice('messages.lessons', 1) }} "Basic 500" - 22/12/2016
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                @lang('messages.learned') 20 {{ trans_choice('messages.words', 2)}}
                                in {{ trans_choice('messages.lessons', 1) }} "Basic 500" - 22/12/2016
                            </a>
                        </li>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
