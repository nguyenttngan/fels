@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        {{ $category->name }}: {{ $count }}/{{ config('custom.wordsPerLesson') }}
                    </div>
                    {!! Form::open(['method' => 'POST', 'action' => 'Web\LessonsController@update']) !!}
                        <div class="panel-body">
                            <div class="col-md-3 col-md-offset-2">
                                <h4>
                                    <strong>{{ $word->word }}</strong>
                                </h4>
                                <p id="correctMng" class="hidden">{{ $correctMng->content }}</p>
                                {!! Form::hidden('cateId', $category->id) !!}
                                {!! Form::hidden('wordId', $word->id) !!}
                                {!! Form::hidden('lessonId', $lessonId, null) !!}
                                {!! Form::hidden('count', $count, null) !!}
                            </div>
                            <div class="col-md-5 col-md-offset-2">
                            @foreach ($word->meanings as $meaning)
                                {!! Form::radio('meanings', $meaning->id, null, [
                                    'required',
                                ]) !!} {{ $meaning->content }} </br>
                            @endforeach
                                {!! Form::hidden('selectedMng') !!}
                            </div>
                        </div>
                        <div class="panel-footer">
                            @if ($count < config('custom.wordsPerLesson'))
                                {!! Form::submit(trans('messages.next'), ['class' => 'btn btn-info']) !!}
                            @else
                                {!! Form::submit(trans('messages.finish'), ['class' => 'btn btn-info']) !!}
                            @endif
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
{!! Html::script(elixir('js/lesson.js')) !!}
@endsection
