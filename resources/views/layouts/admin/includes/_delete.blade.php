{!! Form::open(['method' => 'DELETE', 'action' => $action, 'message' => $message]) !!}

    <button class="btn btn-danger btn-delete" type="button" data-message="{{ $message }}">
        @lang('messages.delete')
    </button>

{!! Form::close() !!}
