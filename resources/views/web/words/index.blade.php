@extends('web.words.filter_form')
@section('word')
    <div>
        @foreach ($words as $word)
            <li class="list-group-item col-md-6 col-md-offset-3">{{ $word->word }}</li>
        @endforeach
    </div>
@endsection
