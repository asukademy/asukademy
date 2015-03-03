{{-- Part of asukademy project. --}}

@extends('admin._global.layout')

@section('page_title')
課程管理@stop

@section('toolbar')
{{ \Riki\Toolbar\Toolbar::add('course', 'admin:new', [], 'btn-lg') }}
{{ \Riki\Toolbar\Toolbar::reorder('admin:courses', [], 'btn-lg') }}
@stop

@section('content')
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th width="1%">#</th>
            <th width="1%">ID</th>
            <th>分類</th>
            <th>標題</th>
            <th width="10%">排序</th>
            <th>狀態</th>
            <th width="1%">刪除</th>
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
                    {{{ $item->category_title }}}
                </td>
                <td>
                    <p><a href="{{ $router->buildHtml('edit', ['name' => 'course', 'id' => $item->id]) }}">{{{ $item->title }}}</a></p>
                </td>
                <td>
                    <input name="ordering[{{{ $item->catid }}}][{{{ $item->id }}}]" class="form-control" type="text" value="{{{ $item->ordering }}}" />
                </td>
                <td>
                    @if ($item->state)
                        <span class="label label-success">啟動</span>
                    @else
                        <span class="label label-danger">關閉</span>
                    @endif
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
                {{ $pagination->render('admin:courses') }}
            </td>
        </tr>
        </tfoot>
    </table>
@stop
