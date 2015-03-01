{{-- Part of asukademy project. --}}

@extends('admin._global.layout')

@section('page_title')
分類管理@stop


@section('toolbar')
    {{ \Riki\Toolbar\Toolbar::add('category', 'admin:new', [], 'btn-lg') }}
    {{ \Riki\Toolbar\Toolbar::reorder('admin:categories', [], 'btn-lg') }}
@stop

@section('content')
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th width="1%">#</th>
            <th width="1%">ID</th>
            <th>Title</th>
            <th>English</th>
            <th width="10%">Ordering</th>
            <th>State</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $k => $item)
            <tr>
                <td><input type="checkbox" name="cid[]" id="cb{{{ $k }}}" /></td>
                <td>{{{ $item->id }}}</td>
                <td>
                    <a href="{{{ $router->buildHtml('category', ['id' => $item->id]) }}}">
                        {{{ $item->title }}}
                    </a>
                </td>
                <td>{{{ $item->eng_title }}}</td>
                <td>
                    <input name="ordering[{{{ $item->id }}}]" class="form-control" type="text" value="{{{ $item->ordering }}}" />
                </td>
                <td>
                    @if ($item->state)
                        <span class="label label-success">啟動</span>
                    @else
                        <span class="label label-danger">關閉</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="20">
                {{ $pagination->render('admin:orders') }}
            </td>
        </tr>
        </tfoot>
    </table>
@stop
