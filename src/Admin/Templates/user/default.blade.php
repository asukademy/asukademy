{{-- Part of asukademy project. --}}

@extends('admin._global.layout')

@section('page_title')
    會員編輯@stop

@section('content')
<fieldset class="form-horizontal">
    {{ \Admin\Form\FormRenderer::render($form->getFields()) }}
</fieldset>
@stop
