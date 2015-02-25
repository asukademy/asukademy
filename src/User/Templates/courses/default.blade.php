{{-- Part of asukademy project. --}}

@extends('layouts.global.manager')

@section('page_title')
我的課程@stop

@section('left')
    @include('layouts.left', ['active' => 'courses'])
@stop

@section('content')
    <style>
        .courses-table td {
            vertical-align: middle;
        }
    </style>
    <form action="{{{ $uri['current'] }}}" method="post" id="adminForm" enctype="multipart/form-data">
        <table class="uk-table uk-table-striped courses-table">
            <thead>
            <tr>
                <th>課程名稱</th>
                <th>時間</th>
                <th></th>
                <th></th>
                <th>狀態</th>
                <th>取消</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $k => $item)
            <tr>
                <td>
                    <p>{{{ $item->course_title }}}</p>
                    <small>{{{ $item->stage_title }}}</small>
                </td>
                <td>{{{ $item->stage_start }}}</td>
                <td>{{{ '' }}}</td>
                <td></td>
                <td>{{{ $item->state }}}</td>
                <td>
                    <button type="button" class="uk-button"
                            onclick="RikiForm.deleteItem('{{{ $router->buildHttp('user:courses', ['id' => $item->id]) }}}');">
                        <span class="uk-icon-close uk-text-danger"></span>
                    </button>
                </td>
            </tr>
            </tbody>
            @endforeach
            <tfoot>
            <tr>
                <td colspan="20">
                    {{ $pagination->render('user:courses', 'widget.pagination') }}
                </td>
            </tr>
            </tfoot>
        </table>
    </form>
@stop
