{{-- Part of asukademy project. --}}

@extends('admin._global.layout')

@section('page_title')
場地編輯@stop

@section('toolbar')
    {{ \Riki\Toolbar\Toolbar::save('admin:position', ['id' => $item->id], 'btn-lg') }}
    {{ \Riki\Toolbar\Toolbar::cancel('admin:positions', [], 'btn-lg') }}
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
@stop
