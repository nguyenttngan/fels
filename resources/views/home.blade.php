@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
                <ul>
                    <img src="{{ asset('storage/avatar.jpg') }}" alt="avatar" height="100" width="100">
                    <li>
                        <a href="#">Nguyen Van A</a>
                    </li>
                    <li>
                        @lang('messages.learned') 100 {{ trans_choice('messages.words', 2) }}
                    </li>
                    <li>
                        @lang('messages.followed') :
                        <a href="#">Tran Van B</a>,
                        <a href="#">Bui Thi C</a>
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
