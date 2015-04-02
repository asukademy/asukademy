{{-- Part of asukademy project. --}}

@extends('admin._global.layout')

@section('page_title')
簽到管理@stop

@section('content')
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
                        @if ($item->checked_in)
                            <span data-toggle="tooltip" data-placement="top" title="已簽到。簽到時間：{{{ $item->checked_in }}}" class="glyphicon glyphicon-check text-success"></span>
                        @else
                            <a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="RikiForm.post('{{{ $router->buildHtml('checkin', ['course_id' => $course_id, 'stage_id' => $stage_id, 'id' => $item->id]) }}}');">
                                <span data-toggle="tooltip" data-placement="top" title="按此簽到" class="glyphicon glyphicon-ok text-muted"></span>
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
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@stop
