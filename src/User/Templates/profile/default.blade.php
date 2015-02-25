{{-- Part of asukademy project. --}}

@extends('layouts.global.manager')

@section('page_title')
會員資料@stop

@section('left')
    @include('layouts.left', ['active' => 'profile'])
@stop

@section('content')
<form action="{{{ $uri['current'] }}}" method="post" id="adminForm" enctype="multipart/form-data">
    <div class="uk-form uk-form-horizontal">
        <h2>基本資料</h2>
        <hr />
        {{ \Front\Form\UikitFormRenderer::render($form->getFields('basic'), '', 'uk-width-1-1'); }}

        <h2 class=" uk-margin-large-top">報名用資料</h2>
        <hr />
        {{ \Front\Form\UikitFormRenderer::render($form->getFields('data'), '', 'uk-width-1-1'); }}

        <div class="uk-form-row register-button-bar uk-margin-large-top">
            <button class="uk-button uk-button-large uk-button-primary">
                儲存
            </button>
        </div>
    </div>

</form>
@stop
