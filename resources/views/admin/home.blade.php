@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    @lang('messages.dashboard')
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ trans_choice('messages.users', 2) }}</th>
                                <th>{{ trans_choice('messages.categories', 2) }}</th>
                                <th>{{ trans_choice('messages.words', 2) }}</th>
                                <th>{{ trans_choice('messages.lessons', 2) }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $user }}</td>
                                <td>{{ $categories }}</td>
                                <td>{{ $words }}</td>
                                <td>{{ $lessons }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
