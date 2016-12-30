@include('web.words.filter_form')
<div>
    @foreach ($words as $word)
        <li>{{ $word->word }}</li>
    @endforeach
</div>
