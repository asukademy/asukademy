{{-- Part of asukademy project. --}}

@extends('admin._global.layout')

@section('page_title')
講師編輯@stop

@section('toolbar')
    {{ \Riki\Toolbar\Toolbar::save('admin:tutor', ['id' => $item->id], 'btn-lg') }}
    {{ \Riki\Toolbar\Toolbar::cancel('admin:tutors', [], 'btn-lg') }}
@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        <fieldset class="form-horizontal">
            {{ \Admin\Form\FormRenderer::render($form->getFields()) }}
        </fieldset>
    </div>

    <div class="col-md-6">
        <fieldset class="form-horizontal">
            @if ($item->image)
                <img width="100%" src="{{{ $item->image }}}" alt="Image" />
            @endif
        </fieldset>
    </div>
</div>

{{ \Asukademy\Session\CSRFToken::input()}}
@stop
