{{-- Part of asukademy project. --}}

@extends('admin._global.layout')

@section('page_title')
簽到管理@stop

@section('sub_title')
{{{ $course->title }}} - {{{ $stage->title }}}@stop

@section('toolbar')
    <a class="btn btn-default btn-lg" href="{{{ $router->buildHtml('course', ['id' => $course_id, 'stage_id' => $stage_id]) }}}">
        <span class="glyphicon glyphicon-remove"></span> 回到課程編輯
    </a>
@stop

@section('content')
    <script>
        Invoice.init();
    </script>

    <div class="row">
        <div class="col-md-10">

            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>方案</th>
                    <th>報名者</th>
                    <th>會員</th>
                    <th>電話</th>
                    <th>組織單位</th>
                    <th>職稱</th>
                    <th>發票</th>
                    <th>簽到</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($items as $item)
                <tr>
                    <td>{{{ $item->id }}}</td>
                    <td>{{{ $item->plan_title }}}</td>
                    <td>{{{ $item->name }}}</td>
                    <td>{{{ $item->user_name }}}</td>
                    <td>
                        <div>{{{ $item->mobile }}}</div>
                        <div>{{{ $item->phone }}}</div>
                    </td>
                    <td>
                        {{{ $item->organization }}}
                    </td>
                    <td>
                        {{{ $item->title }}}
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-default btn-sm {{ $item->invoice ? 'btn-success' : '' }}" data-toggle="modal" data-target="#invoiceModal"
                            @if ($item->invoice)
                            rel="tooltip" data-placement="top" title="{{{ $item->invoice }}}"
                            @endif
                            onclick="Invoice.prepare('{{{ $item->invoice }}}', '{{{ $router->buildHtml('checkin', ['course_id' => $course_id, 'stage_id' => $stage_id, 'id' => $item->id, 'task' => 'invoice']) }}}')">
                            <span class="glyphicon glyphicon-file"></span>
                        </button>
                    </td>
                    <td class="text-center">
                        @if ($item->checked_in)
                            <span rel="tooltip" data-placement="top" title="已簽到。簽到時間：{{{ $item->checked_in }}}" class="glyphicon glyphicon-check text-success"></span>
                        @else
                            <a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="RikiForm.post('{{{ $router->buildHtml('checkin', ['course_id' => $course_id, 'stage_id' => $stage_id, 'id' => $item->id]) }}}');">
                                <span rel="tooltip" data-placement="top" title="按此簽到" class="glyphicon glyphicon-ok text-muted"></span>
                            </a>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>

        </div>

        <div class="col-md-2">
            <fieldset>
                @include('stage.submenu', ['active' => 'checkin'])
            </fieldset>
        </div>
    </div>

    {{ \Asukademy\Session\CSRFToken::input()}}

    <script>
        RikiEdit.confirmOnPageExit(jQuery('#adminForm'));

        $(function () {
            $('[rel="tooltip"]').tooltip()
        })
    </script>

    <div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">輸入發票編號</h4>
                </div>
                <div class="modal-body">
                    <input id="invoice-input" class="form-control" type="text" name="invoice" value="" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="RikiForm.post(Invoice.url);">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@stop
