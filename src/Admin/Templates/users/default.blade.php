{{-- Part of asukademy project. --}}

@extends('admin._global.layout')

@section('page_title')
會員管理@stop

@section('toolbar')
    <a class="btn btn-default btn-lg" href="{{{ $router->buildHtml('user') }}}">
        <span class="glyphicon glyphicon-plus"></span> New
    </a>
@stop

@section('content')
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th width="1%">#</th>
        <th width="1%">ID</th>
        <th width="80">Name</th>
        <th>Username</th>
        {{--<th width="20%">Email</th>--}}
        <th width="12%">Phone</th>
        <th>Org</th>
        <th>State</th>
        <th width="10%">Registered</th>
        <th width="10%">Last Login</th>
        <th width="1%">Del</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $k => $item)
        <tr>
            <td>
                <input type="checkbox" name="cid[]" id="cb{{ $k }}" value="{{ $item->id }}" />
            </td>
            <td>
                {{ $item->id }}
            </td>
            <td>
                <p><a href="{{ $router->buildHtml('user', ['id' => $item->id]) }}">{{{ $item->name }}}</a></p>
                <p><small>{{{ $item->nick }}}</small></p>
            </td>
            <td class="word-break">
                <p><a href="{{ $router->buildHtml('user', ['id' => $item->id]) }}">{{{ $item->username }}}</a></p>
                <p>{{{ $item->email }}}</p>
            </td>
            <td>
                <p>{{{ $item->mobile }}}</p>
                <p>{{{ $item->phone }}}</p>
            </td>
            <td>
                {{{ $item->organization }}}
            </td>
            <td>
                @if ($item->state)
                    <span class="label label-success">啟動</span>
                @else
                    <span class="label label-danger">關閉</span>
                @endif
                /
                @if (!$item->activation)
                    <span class="label label-success">已認證</span>
                @else
                    <span class="label label-danger">未認證</span>
                @endif
            </td>
            <td>
                {{{ $item->registered }}}
            </td>
            <td>
                {{{ $item->last_login }}}
            </td>
            <td>
                <button type="button" class="btn btn-default"
                    onclick="RikiForm.deleteItem('{{{ $router->buildHttp('user', ['id' => $item->id]) }}}');">
                    <span class="glyphicon glyphicon-trash text-danger"></span>
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>

    <tfoot>
    <tr>
        <td colspan="15">
            {{ $pagination->render('admin:users') }}
        </td>
    </tr>
    </tfoot>
</table>
@stop
