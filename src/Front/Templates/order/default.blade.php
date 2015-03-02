{{-- Part of asukademy project. --}}

@extends('layouts.global.manager')

@section('page_title')
報名課程: <br />{{{ $plan->course->title }}}@stop

@section('left')
    <p>
        <img src="{{{ $plan->course->image }}}" alt="Image" />
    </p>
    <h2>{{{ $plan->stage->title }}}</h2>
    <p>
        {{{ $plan->course->introtext }}}
    </p>
@stop

@section('content')
<form action="{{{ $uri['current'] }}}" method="post" id="adminForm" enctype="multipart/form-data">
<div class="uk-grid">
    <div class="uk-width-3-4">

        <div class="uk-form uk-form-horizontal">
            {{ \Front\Form\UikitFormRenderer::render($form->getFields(), '', 'uk-width-1-1'); }}

            <div class="uk-form-row">
                <label for="save-to-profile" class="uk-form-label">將這次填寫的內容儲存起來下次使用</label>

                <div class=" uk-form-controls">
                    <input id="save-to-profile" type="checkbox" name="save_to_profile" value="1">
                </div>
            </div>
        </div>
    </div>
    <div class="uk-width-1-4">
        <p>
            <button class="uk-button uk-button-large uk-button-primary uk-width-1-1">
                確定報名 <span class="uk-icon-sign-in"></span>
            </button>
        </p>
        <h3>方案名稱</h3>
        <p>{{{ $plan->title }}}</p>

        <h3>價格</h3>
        <p>
            {{{ number_format($plan->price, 0) }}}
        </p>

    </div>
</div>
</form>
@stop
