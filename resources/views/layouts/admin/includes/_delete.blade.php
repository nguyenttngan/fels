{!! Form::open(['method' => 'DELETE', 'action' => $action]) !!}

    <button class="btn btn-danger btn-delete" type="button" data-message="{{ trans('messages.confirmDeleteCategory') }}">
        @lang('messages.delete')
    </button>

{!! Form::close() !!}
