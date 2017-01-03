@extends('layouts.app')

@section('content')
<div class="container">
    {{ $exception->getMessage() }}
</div>
@endsection
