{{-- Part of asukademy project. --}}

@extends('admin._global.layout')

@section('page_title')
講師管理@stop


@section('toolbar')
    {{ \Riki\Toolbar\Toolbar::add('tutor', 'admin:new', [], 'btn-lg') }}
@stop

@section('content')

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th width="1%">#</th>
            <th width="1%">ID</th>
            <th width="80">Image</th>
            <th width="150">Name</th>
            <th>Nick</th>
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
                    <a href="{{{ $router->buildHtml('tutor', ['id' => $item->id]) }}}">
                        {{{ $item->name }}}
                    </a>
                </td>
                <td>{{{ $item->nick }}}</td>
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

