@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    {{ $category->name }} : {{ $words->total() }}
                    {{ trans_choice('messages.words', $words->total()) }}
                </div>
                <div class="panel-body">
                @if ($words->total() != 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{ trans_choice('messages.words', 2) }}</th>
                                <th>{{ trans_choice('messages.meanings', 2) }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($words as $word)
                            <tr>
                                <td>{{ $word->word }}</td>
                                <td>{{ $word->correctMeaning->content }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    {{ trans('messages.empty', ['item' => trans_choice('messages.words', 1)]) }}
                @endif
                </div>
                <div class="panel-footer">
                    {{ $words->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
