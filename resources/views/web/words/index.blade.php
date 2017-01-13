@extends('web.words.filter_form')
@section('word')
    <div class="list-group">
    @foreach ($words as $word)
        <li class="list-group-item">{{ $word->word }}</li>
    @endforeach
    </div>
@endsection
