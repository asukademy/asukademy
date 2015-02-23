{{-- Part of asukademy project. --}}

@extends('admin._global.layout')

@section('page_title')
課程編輯@stop

@section('toolbar')
    {{ \Riki\Toolbar\Toolbar::save('admin:course', [], 'btn-lg') }}
    {{ \Riki\Toolbar\Toolbar::cancel('admin:courses', [], 'btn-lg') }}
@stop

@section('content')
    <div role="tabpanel">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#basic" aria-controls="home" role="tab" data-toggle="tab">課程資訊</a></li>
            <li role="presentation"><a href="#desc" aria-controls="profile" role="tab" data-toggle="tab">介紹文案</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="basic">

                <div class="row">
                    <div class="col-md-6">
                        <fieldset class="form-horizontal">
                            <legend>基礎設定</legend>
                            {{ \Admin\Form\FormRenderer::render($form->getFields('basic')) }}
                        </fieldset>
                    </div>

                    <div class="col-md-6">
                        <fieldset class="form-horizontal">
                            <legend>課程資訊</legend>
                            {{ \Admin\Form\FormRenderer::render($form->getFields('info')) }}
                        </fieldset>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <fieldset class="form-horizontal">
                            <legend>開課梯次</legend>
                            @include('edit_stages')
                        </fieldset>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="desc">
                <div class="row">
                    <div class="row">
                        <div class="col-md-10">
                            <fieldset class="form-horizontal">
                                <legend>詳細介紹</legend>
                                {{ \Admin\Form\FormRenderer::render($form->getFields('desc')) }}
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop
