{{-- Part of asukademy project. --}}

@extends('admin._global.layout')

@section('page_title')
票價方案@stop

@section('toolbar')
    {{ \Riki\Toolbar\Toolbar::save('admin:plans', ['course_id' => $course_id, 'stage_id' => $stage_id], 'btn-lg') }}

    <a class="btn btn-default btn-lg" href="{{{ $router->buildHtml('course', ['id' => $course_id, 'stage_id' => $stage_id]) }}}">
        <span class="glyphicon glyphicon-remove"></span> 回到課程編輯
    </a>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            <fieldset class="form-horizontal">
            @foreach(range(1, 10) as $i)
                <?php $item = $items[$i - 1]; ?>
                <?php $item = $item ? : new \Windwalker\Data\Data; ?>
                <?php $plan = 'plan-' . $i; ?>
                <?php $name = 'plan[' . $i . ']'; ?>

                <div class="well">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="{{ $plan }}-title" class="col-sm-2 control-label">方案名稱</label>
                            <div class="col-sm-7">
                                <input type="text" name="{{ $name }}[title]" class="form-control" id="{{ $plan }}-title"
                                        placeholder="方案名稱" value="{{{ $item->title }}}">
                            </div>

                            <div class="col-md-3">
                                # {{{ $stage_id . '-' . $i }}} @ {{{ $item->id }}}
                            </div>
                        </div>
                    </div>

                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="{{ $plan }}-price" class="col-sm-2 control-label">價格</label>
                            <div class="col-sm-4">
                                <input type="text" name="{{ $name }}[price]" class="form-control" id="{{ $plan }}-price"
                                        placeholder="價格" value="{{{ $item->price }}}">
                            </div>
                            <label for="{{ $plan }}-origin_price" class="col-md-2 control-label">原價</label>
                            <div class="col-sm-4">
                                <input type="text" name="{{ $name }}[origin_price]" class="form-control" id="{{ $plan }}-origin_price"
                                        placeholder="原價" value="{{{ $item->origin_price }}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="{{ $plan }}-start" class="col-sm-2 control-label">開始售票</label>
                            <div class="col-sm-4">
                                <div class="input-group date calendar">
                                    <input type="text" name="{{ $name }}[start]" class="form-control" id="{{ $plan }}-start"
                                            placeholder="開始售票" value="{{{ $item->start }}}">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>

                            <label for="{{ $plan }}-end" class="col-sm-2 control-label">結束售票</label>
                            <div class="col-sm-4">
                                <div class="input-group date calendar">
                                    <input type="text" name="{{ $name }}[end]" class="form-control" id="{{ $plan }}-end"
                                            placeholder="結束售票" value="{{{ $item->end }}}">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="{{ $plan }}-quota" class="col-sm-2 control-label">人數</label>
                            <div class="col-sm-4">
                                <input type="text" name="{{ $name }}[quota]" class="form-control" id="{{ $plan }}-quota"
                                        placeholder="人數" value="{{{ $item->quota }}}">
                            </div>

                            <label for="{{ $plan }}-enabled" class="col-sm-1 control-label">啟用</label>
                            <div class="col-sm-2">
                                <input type="checkbox" name="{{ $name }}[enabled]" class="form-control" id="{{ $plan }}-enabled"
                                        value="1" {{{ $item->state ? 'checked="checked"' : '' }}}>
                            </div>

                            <label for="{{ $plan }}-require-validate" class="col-sm-1 control-label">需要審核</label>
                            <div class="col-sm-2">
                                <input type="checkbox" name="{{ $name }}[require_validate]" class="form-control" id="{{ $plan }}-require-validate"
                                        value="1" {{{ $item->require_validate ? 'checked="checked"' : '' }}}>
                            </div>
                        </div>

                        <input name="{{ $name }}[id]" type="hidden" value="{{{ $item->id }}}" />

                    </div>

                </div>
            @endforeach
            </fieldset>
        </div>

        <div class="col-md-2">
            <fieldset>

                @include('stage.submenu', ['active' => 'plans'])
            </fieldset>
        </div>
    </div>

    {{ \Asukademy\Session\CSRFToken::input()}}

    <script>
        RikiEdit.confirmOnPageExit(jQuery('#adminForm'));

        $(function() {
            $('.calendar').datetimepicker({
                format: 'YYYY-MM-DD hh:mm:ss',
                sideBySide: true,
                calendarWeeks: true
            });
        });
    </script>
@stop
