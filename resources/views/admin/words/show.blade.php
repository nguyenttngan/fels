@extends('layouts.admin.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <div class="panel-title text-center">
                            {{ $word->word }}
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover table-bordered text-center">
                                <tr>
                                    <td>
                                        {{ trans_choice('messages.categories', 1) }} : {{ $word->category->name }}
                                    </td>
                                    <td>
                                        {{ trans_choice('messages.meanings', 1) }} : {{ $word->correctMeaning->content }}
                                    </td>
                                </tr>
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <div class="btn-group">
                            <a class="btn btn-success"
                                href="{{ action('Admin\WordsController@edit', ['word' => $word->id]) }}">
                                @lang('messages.edit')
                            </a>
                            <a class="btn btn-primary pull-right"
                                href="{{ action('Admin\WordsController@index') }}">@lang('messages.cancel')
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {!! Html::script(elixir('js/form-delete.js')) !!}
@endsection
