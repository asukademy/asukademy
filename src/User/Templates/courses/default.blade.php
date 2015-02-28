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

        @if ($items->notNull())
        <table class="uk-table uk-table-striped courses-table">
            <thead>
            <tr>
                <th>編號</th>
                <th>課程名稱</th>
                <th>時間</th>
                <th></th>
                <th>報名資訊</th>
                <th>狀態</th>
                <th>取消</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $k => $item)
            <tr>
                <td>
                    {{{ $item->id }}}
                </td>
                <td>
                    <p>{{{ $item->course_title }}}</p>
                    <small>{{{ $item->stage_title }}}</small>
                </td>
                <td>{{{ $item->stage_start }}}</td>
                <td>{{{ '' }}}</td>
                <td>
                    <a href="{{{ $router->buildHtml('order', ['id' => $item->id]) }}}">
                        報名資訊
                    </a>
                </td>
                <td>{{{ \Admin\Helper\OrderHelper::getStateTitle($item->state) }}}</td>
                <td>
                    <button type="button" class="uk-button"
                            onclick="RikiForm.deleteItem('{{{ $router->buildHttp('user:courses', ['id' => $item->id]) }}}');">
                        <span class="uk-icon-close uk-text-danger"></span>
                    </button>
                </td>
            </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="20">
                    {{ $pagination->render('user:courses', 'widget.pagination') }}
                </td>
            </tr>
            </tfoot>
        </table>
        @else
        <div class="uk-panel uk-panel-box uk-text-center" style="padding-bottom: 120px; padding-top: 120px;">
            <h2>您還沒有報名任何課程</h2>

            <p>
                <a class="uk-button uk-button-primary uk-button-hero" href="{{{ $router->buildHtml('front:courses') }}}">
                    <span class="uk-icon-book"></span> 按此瀏覽課程
                </a>
            </p>
        </div>
        @endif
    </form>
@stop
