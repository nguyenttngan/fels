@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <strong>{{ $lesson->category->name }}</strong> : {{ $numCorrectAns }}/{{ $numAns }}
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{ trans_choice('messages.words', 2) }}</th>
                                <th>{{ trans_choice('messages.meaning', 2) }}</th>
                                <th>{{ trans_choice('messages.yourans', 2) }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($lesson->words as $word)
                            <tr>
                                <td>{{ $word->word }}</td>
                                <td>{{ $word->correctMeaning->content }}</td>
                                <td>
                                    {{ $answers[$word->id] }}
                                    @if ($word->meaning_id == $word->pivot->meaning_id)
                                        <span class="glyphicon glyphicon-ok"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove"></span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
