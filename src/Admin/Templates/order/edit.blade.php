{{-- Part of asukademy project. --}}

@extends('admin._global.layout')

@section('page_title')
報名資料編輯@stop

@section('toolbar')
    {{ \Riki\Toolbar\Toolbar::save('admin:order', ['id' => $item->id], 'btn-lg') }}
    {{ \Riki\Toolbar\Toolbar::cancel('admin:orders', [], 'btn-lg') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <fieldset class="form-horizontal">
                <legend>基礎資料</legend>
                {{ \Admin\Form\FormRenderer::render($form->getFields()) }}
            </fieldset>
        </div>

        <div class="col-md-6">
            <fieldset class="form-horizontal">
                <legend>報名狀態</legend>
                @if ($item->state == \Admin\Helper\OrderHelper::STATE_CANCELED || $item->state >= \Admin\Helper\OrderHelper::STATE_PROCESSING)
                    {{{ \Admin\Helper\OrderHelper::getStateTitle($item->state) }}}
                @else
                    <?php
                    $options = [];
                    foreach (range(\Admin\Helper\OrderHelper::STATE_CANCELED, \Admin\Helper\OrderHelper::STATE_PAID_SUCCESS) as $i)
                    {
                        $options[] = new \Windwalker\Html\Option(\Admin\Helper\OrderHelper::getStateTitle($i), $i);
                    }

                    $select = new \Windwalker\Html\Select\SelectList('order[state]', $options, ['class' => 'form-control',], $item->state);
                    ?>
                    {{ $select->toString() }}
                @endif

                <br /><br /><br />
            </fieldset>

            <fieldset>
                <legend>付款狀態</legend>

                @if ($item->payment && $item->state == \Admin\Helper\OrderHelper::STATE_WAIT_PAY)
                    {{ $feedback->render() }}
                @elseif ($item->payment && $item->state >= \Admin\Helper\OrderHelper::STATE_PAID_SUCCESS)
                    {{ $receiver->render() }}
                @else
                    沒有付款資料
                @endif
            </fieldset>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            @if ($item->attachment)
                <h2>附件</h2>
                <img src="{{{ $item->attachment }}}" alt="Attachment" style="max-width: 100%;" />
            @endif
        </div>
    </div>
@stop
