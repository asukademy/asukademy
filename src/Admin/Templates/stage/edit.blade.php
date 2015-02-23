{{-- Part of asukademy project. --}}

@extends('admin._global.layout')

@section('page_title')
開課編輯@stop

@section('toolbar')
    {{ \Riki\Toolbar\Toolbar::save('admin:stage', ['course_id' => $course_id], 'btn-lg') }}

    <a class="btn btn-default btn-lg" href="{{{ $router->buildHtml('course', ['id' => $course_id]) }}}">
        <span class="glyphicon glyphicon-remove"></span> 回到課程編輯
    </a>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <fieldset class="form-horizontal">
                {{ \Admin\Form\FormRenderer::render($form->getFields()) }}
            </fieldset>
        </div>

        <div class="col-md-4">
            <fieldset>

                @include('stage.submenu', ['active' => 'stage'])
            </fieldset>
        </div>
    </div>

    <script>
        RikiEdit.confirmOnPageExit(jQuery('#adminForm'));
    </script>
@stop
