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
        <th width="1%">EDIT</th>
        <th>Course</th>
        <th>Stage</th>
        <th>Plan</th>
        <th>Price</th>
        <th>Date</th>
        <th>Name</th>
        <th>User</th>
        <th width="125">State</th>
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
            <td>{{{ $item->course_title }}}</td>
            <td>{{{ $item->stage_title }}}</td>
            <td>{{{ $item->plan_title }}}</td>
            <td>{{{ number_format($item->price, 0) }}}</td>
            <td>{{{ \Asukademy\Helper\DateTimeHelper::format($item->stage_start, 'Y-m-d', true) }}}</td>
            <td>{{{ $item->name }}}</td>
            <td>{{{ $item->user_name }}}</td>
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
@stop
