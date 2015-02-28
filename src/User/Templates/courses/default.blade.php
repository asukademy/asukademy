{{-- Part of asukademy project. --}}

@extends('layouts.global.manager')

<?php
\Riki\Asset\Asset::addScript(\Riki\Uri\Uri::media() . 'riki/js/form.js');
?>

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
        <table class="uk-table courses-table">
            <thead>
            <tr>
                <th>編號</th>
                <th>課程名稱</th>
                <th>上課日期</th>
                <th width="95">報名資訊</th>
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
                    <p>
                        <a href="{{{ $router->buildHtml('front:course', ['category_alias' => $item->category_alias, 'alias' => $item->course_alias]) }}}">
                            {{{ $item->course_title }}}
                        </a>
                    </p>
                    <a class="uk-text-muted" href="{{{ $router->buildHtml('front:stage', ['id' => $item->stage_id, 'category_alias' => $item->category_alias, 'course_alias' => $item->course_alias]) }}}">
                        <small>{{{ $item->stage_title }}}</small>
                    </a>
                </td>
                <td>{{{ \Asukademy\Helper\DateTimeHelper::format($item->stage_start, 'Y-m-d', true) }}}</td>
                <td>
                    <a class="uk-button uk-button-success" href="{{{ $router->buildHtml('order', ['id' => $item->id]) }}}">
                        詳細資訊
                    </a>
                </td>
                <td class="uk-text-center">
                    <?php $stateTitle = \Admin\Helper\OrderHelper::getStateTitle($item->state); ?>
                    @if ($item->state == \Admin\Helper\OrderHelper::STATE_PENDING)
                        <span data-uk-tooltip title="{{{ $stateTitle }}}" class="uk-icon-clock-o uk-text-warning"></span>
                    @elseif ($item->state == \Admin\Helper\OrderHelper::STATE_WAIT_PAY)
                        <span data-uk-tooltip title="{{{ $stateTitle }}}" class="uk-icon-credit-card uk-text-warning"></span>
                    @elseif ($item->state == \Admin\Helper\OrderHelper::STATE_PAID_SUCCESS)
                        <span data-uk-tooltip title="{{{ $stateTitle }}}" class="uk-icon-check uk-text-success"></span>
                    @elseif ($item->state == \Admin\Helper\OrderHelper::STATE_PROCESSING)
                        <span data-uk-tooltip title="{{{ $stateTitle }}}" class="uk-icon-group uk-text-primary"></span>
                    @elseif ($item->state == \Admin\Helper\OrderHelper::STATE_PROCESSING)
                        <span data-uk-tooltip title="{{{ $stateTitle }}}" class="uk-icon-graduation-cap"></span>
                    @elseif ($item->state == \Admin\Helper\OrderHelper::STATE_CANCELED)
                        <span data-uk-tooltip title="{{{ $stateTitle }}}" class="uk-icon-close uk-text-danger"></span>
                    @endif
                </td>
                <td class="uk-text-center">
                    @if ($item->state > \Admin\Helper\OrderHelper::STATE_CANCELED && $item->state < \Admin\Helper\OrderHelper::STATE_PROCESSING)
                        <button type="button" class="uk-button"
                            onclick="RikiForm.deleteItem('{{{ $router->buildHttp('user:order', ['id' => $item->id]) }}}');">
                        <span class="uk-icon-close uk-text-danger"></span>
                    </button>
                    @else
                    -
                    @endif
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
            <p class="uk-text-large">您還沒有報名任何課程</p>

            <p>
                <a class="uk-button uk-button-primary uk-button-hero" href="{{{ $router->buildHtml('front:courses') }}}">
                    <span class="uk-icon-book"></span> 按此瀏覽課程
                </a>
            </p>
        </div>
        @endif
    </form>
@stop
