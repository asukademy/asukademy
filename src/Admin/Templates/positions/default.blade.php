{{-- Part of asukademy project. --}}

@extends('admin._global.layout')

@section('page_title')
場地管理@stop

@section('toolbar')
    {{ \Riki\Toolbar\Toolbar::add('position', 'admin:new', [], 'btn-lg') }}
@stop

@section('content')
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th width="1%">#</th>
        <th width="1%">ID</th>
        <th width="80">圖片</th>
        <th>標題</th>
        <th>地址</th>
        <th>狀態</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $k => $item)
        <tr>
            <td><input type="checkbox" name="cid[]" id="cb{{{ $k }}}" /></td>
            <td>{{{ $item->id }}}</td>
            <td>
                @if ($item->image)
                    <img src="{{{ \Asukademy\Helper\ThumbHelper::resize($item->image, 75, 75) }}}" alt="Avatar" width="75" height="75" />
                @endif
            </td>
            <td>
                <a href="{{{ $router->buildHtml('position', ['id' => $item->id]) }}}">
                    {{{ $item->title }}}
                </a>
            </td>
            <td>{{{ $item->address }}}</td>
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
