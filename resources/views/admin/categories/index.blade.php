@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
            <div class="panel panel-info">
                <div class="panel-heading clearfix">
                    <div class="panel-title pull-left">
                        {{ trans_choice('messages.categories', $categories->total()) }} : {{ $categories->total() }}
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary"
                            href="{{ action('Admin\CategoryController@create') }}">@lang('messages.add')</a>
                    </div>
                </div>
                <div class="panel-body">
                @if ($categories->total() != 0)
                    <table class="table table-hover table-bordered text-center">
                    @foreach ($categories as $category)
                        <tr>
                            <td>
                                <a href="{{ action('Admin\CategoryController@show', [
                                'category' => $category->id]) }}">{{ $category->name }}</a>
                            </td>
                            <td>
                                <a class="btn btn-warning"
                                    href="{{ action('Admin\CategoryController@edit', ['category' => $category->id]) }}">
                                    @lang('messages.edit')
                                </a>
                            </td>
                            <td>
                                @include('layouts.admin.includes._delete', [
                                    'action' => ['Admin\CategoryController@destroy', 'category' => $category->id],
                                ])
                            </td>
                        </tr>
                    @endforeach
                    </table>
                @else
                    {{ trans('messages.empty', ['item' => trans_choice('messages.categories', 1)]) }}
                @endif
                </div>
                <div class="panel-footer">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
{!! Html::script(elixir('js/form-delete.js')) !!}
@endsection
