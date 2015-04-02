{{-- Part of asukademy project. --}}

@extends('admin._global.layout')

@section('page_title')
課程內容@stop

@section('toolbar')
    {{ \Riki\Toolbar\Toolbar::save('admin:classes', ['course_id' => $course_id, 'stage_id' => $stage_id], 'btn-lg') }}

    <a class="btn btn-default btn-lg" href="{{{ $router->buildHtml('course', ['id' => $course_id, 'stage_id' => $stage_id]) }}}">
        <span class="glyphicon glyphicon-remove"></span> 回到課程編輯
    </a>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            <fieldset class="form-horizontal">
                @foreach(range(1, 20) as $i)
                    <?php $item = $items[$i - 1]; ?>
                    <?php $item = $item ? : new \Windwalker\Data\Data; ?>
                    <?php $classes = 'classes-' . $i; ?>
                    <?php $name    = 'classes[' . $i . ']'; ?>

                    <div class="well">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="{{ $classes }}-title" class="col-sm-2 control-label">課程名稱</label>
                                <div class="col-sm-7">
                                    <input type="text" name="{{ $name }}[title]" class="form-control" id="{{ $classes }}-title"
                                            placeholder="課程名稱" value="{{{ $item->title }}}">
                                </div>

                                <div class="col-md-3">
                                    # {{{ $stage_id . '-' . $i }}} @ {{{ $item->id }}}
                                </div>
                            </div>
                        </div>

                        <div class="form-horizontal">

                            <div class="form-group">
                                <label for="{{ $classes }}-date" class="col-sm-2 control-label">日期</label>
                                <div class="col-sm-4">
                                    <div class="input-group date-picker">
                                        <input type="text" name="{{ $name }}[date]" class="form-control" id="{{ $classes }}-date"
                                                placeholder="日期" value="{{{ $item->date }}}">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                </div>

                                {{-- 時段設定 --}}
                                <label for="{{ $classes }}-end" class="col-sm-2 control-label">時段</label>
                                <div class="col-sm-4">
                                    <?php
                                    $select = function ($name)
                                    {
                                        $options = [new \Windwalker\Html\Option('---', '')];

                                        foreach (range(0, 24) as $i)
                                        {
                                            $hr = sprintf('%02d', $i);

                                            $options[] = new \Windwalker\Html\Option($hr . ':00', $i);
                                            $options[] = new \Windwalker\Html\Option($hr . ':30', $i + 0.5);
                                        }

                                        return new \Windwalker\Html\Select\SelectList($name, $options, ['class' => 'form-control']);
                                    }
                                    ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            {{ $select($name . '[start]')->setSelected($item->start)->toString() }}
                                        </div>
                                        <div class="col-md-6">
                                            {{ $select($name . '[end]')->setSelected($item->end)->toString() }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="{{ $classes }}-hours" class="col-sm-2 control-label">時數</label>
                                <div class="col-sm-2">
                                    <input type="text" name="{{ $name }}[hours]" class="form-control" id="{{ $classes }}-hours"
                                            placeholder="時數" value="{{{ $item->hours }}}">
                                </div>
                                <label for="{{ $classes }}-ordering" class="col-sm-2 control-label">排序</label>
                                <div class="col-sm-2">
                                    <input type="text" name="{{ $name }}[ordering]" class="form-control" id="{{ $classes }}-ordering"
                                            placeholder="排序" value="{{{ $item->ordering }}}">
                                </div>
                                <label for="{{ $classes }}-enabled" class="col-sm-2 control-label">啟用</label>
                                <div class="col-sm-2">
                                    <input type="checkbox" name="{{ $name }}[enabled]" class="form-control" id="{{ $classes }}-enabled"
                                            value="1" {{{ $item->state ? 'checked="checked"' : '' }}}>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="{{ $classes }}-intro" class="col-sm-2 control-label">簡述</label>
                                <div class="col-sm-10">
                                    <input type="text" name="{{ $name }}[intro]" class="form-control" id="{{ $classes }}-intro"
                                            placeholder="簡述" value="{{{ $item->intro }}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="{{ $classes }}-description" class="col-sm-2 control-label">完整說明</label>
                                <div class="col-sm-10">
                                    <textarea type="text" name="{{ $name }}[description]" class="form-control" rows="7" id="{{ $classes }}-description"
                                            placeholder="完整說明" >{{{ $item->description }}}</textarea>
                                </div>
                            </div>

                            {{--<input name="{{ $name }}[id]" type="hidden" value="{{{ $item->id }}}" />/--}}

                        </div>

                    </div>
                @endforeach
            </fieldset>
        </div>

        <div class="col-md-2">
            <fieldset>
                @include('stage.submenu', ['active' => 'classes'])
            </fieldset>
        </div>
    </div>

    {{ \Asukademy\Session\CSRFToken::input()}}

    <script>
        RikiEdit.confirmOnPageExit(jQuery('#adminForm'));
    </script>
@stop
