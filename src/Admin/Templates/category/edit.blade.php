{{-- Part of asukademy project. --}}

@extends('admin._global.layout')

@section('page_title')
分類編輯@stop

@section('toolbar')
    {{ \Riki\Toolbar\Toolbar::save('admin:category', ['id' => $item->id], 'btn-lg') }}
    {{ \Riki\Toolbar\Toolbar::cancel('admin:categories', [], 'btn-lg') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <fieldset class="form-horizontal">
                {{ \Admin\Form\FormRenderer::render($form->getFields()) }}
            </fieldset>
        </div>
    </div>
@stop

