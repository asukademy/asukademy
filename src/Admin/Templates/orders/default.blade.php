{{-- Part of asukademy project. --}}

@extends('admin._global.layout')

@section('page_title')
報名管理@stop

@section('toolbar')
    {{ \Riki\Toolbar\Toolbar::add('order', 'admin:new', [], 'btn-lg') }}
@stop

@section('content')

<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th width="1%">#</th>
        <th width="1%">ID</th>
        <th width="1%">編輯</th>
        <th>課程</th>
        <th>方案</th>
        <th>價格</th>
        <th width="92px">上課日</th>
        <th>報名者</th>
        <th>會員</th>
        <th>付款方式</th>
        <th>狀態</th>
        <th width="125">更改狀態</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $k => $item)
        <tr>
            <td><input type="checkbox" name="cid[]" id="cb{{{ $k }}}" /></td>
            <td>{{{ $item->id }}}</td>
            <td>
                <a class="btn btn-primary btn-sm" href="{{ $router->buildHtml('edit', ['name' => 'order', 'id' => $item->id]) }}">
                    <span class="glyphicon glyphicon-edit"></span>
                </a>
            </td>
            <td>
                <a href="{{{ $router->buildHtml('course', ['id' => $item->course_id]) }}}" target="_blank">
                    {{{ $item->course_title }}}
                </a>
                <br />
                <small>{{{ $item->stage_title }}}</small>
            </td>
            <td>{{{ $item->plan_title }}}</td>
            <td>
                @if ((int) $item->price)
                    {{{ number_format($item->price, 0) }}}
                @else
                    免費
                @endif
            </td>
            <td>{{{ \Asukademy\Helper\DateTimeHelper::format($item->stage_start, 'Y-m-d', true) }}}</td>
            <td>{{{ $item->name }}}</td>
            <td>
                <a href="{{{ $router->buildHtml('user', ['id' => $item->user_id]) }}}" target="_blank">
                    {{{ $item->user_name }}}
                </a>
            </td>
            <td>
                @if ($item->payment)
                    {{{ \Windwalker\Pay2Go\Pay2GoHelper::getPaymentTitle($item->payment) }}}
                @endif
            </td>
            <td class="text-center">
                <?php $stateTitle = \Admin\Helper\OrderHelper::getStateTitle($item->state); ?>
                @if ($item->state == \Admin\Helper\OrderHelper::STATE_PENDING)
                    <span data-toggle="tooltip" data-placement="top" title="{{{ $stateTitle }}}" class="glyphicon glyphicon-time text-warning"></span>
                @elseif ($item->state == \Admin\Helper\OrderHelper::STATE_WAIT_PAY)
                    <span data-toggle="tooltip" data-placement="top" title="{{{ $stateTitle }}}" class="glyphicon glyphicon-credit-card text-warning"></span>
                @elseif ($item->state == \Admin\Helper\OrderHelper::STATE_PAID_SUCCESS)
                    <span data-toggle="tooltip" data-placement="top" title="{{{ $stateTitle }}}" class="glyphicon glyphicon-ok text-success"></span>
                @elseif ($item->state == \Admin\Helper\OrderHelper::STATE_PROCESSING)
                    <span data-toggle="tooltip" data-placement="top" title="{{{ $stateTitle }}}" class="glyphicon glyphicon-forward text-primary"></span>
                @elseif ($item->state == \Admin\Helper\OrderHelper::STATE_END)
                    <span data-toggle="tooltip" data-placement="top" title="{{{ $stateTitle }}}" class="glyphicon glyphicon-minus"></span>
                @elseif ($item->state == \Admin\Helper\OrderHelper::STATE_CANCELED)
                    <span data-toggle="tooltip" data-placement="top" title="{{{ $stateTitle }}}" class="glyphicon glyphicon-remove text-danger"></span>
                @endif
                &nbsp;&nbsp;

                @if ($item->checked_in)
                    <span data-toggle="tooltip" data-placement="top" title="已簽到。簽到時間：{{{ $item->checked_in }}}" class="glyphicon glyphicon-check text-success"></span>
                @else
                    <span data-toggle="tooltip" data-placement="top" title="尚未簽到" class="glyphicon glyphicon-check text-muted" style="opacity: .5;"></span>
                @endif
            </td>
            <td>
                @if ($item->state == \Admin\Helper\OrderHelper::STATE_CANCELED || $item->state >= \Admin\Helper\OrderHelper::STATE_PROCESSING)
                    {{{ \Admin\Helper\OrderHelper::getStateTitle($item->state) }}}
                @else
                    <?php
                    $options = [];
                    foreach (range(\Admin\Helper\OrderHelper::STATE_CANCELED, \Admin\Helper\OrderHelper::STATE_PAID_SUCCESS) as $i)
                    {
                        $options[] = new \Windwalker\Html\Option(\Admin\Helper\OrderHelper::getStateTitle($i), $i);
                    }

                    $select = new \Windwalker\Html\Select\SelectList(
                        'state[' . $item->id . ']',
                        $options,
                        [
                            'class' => 'form-control',
                            'onchange' => sprintf(
                                'RikiForm.post(\'%s\', \'patch\')',
                                $router->buildHtml('order_state', ['id' => $item->id])
                            )
                        ],
                        $item->state
                    );
                    ?>
                    {{ $select->toString() }}
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
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@stop
