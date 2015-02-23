{{-- Part of asukademy project. --}}

@extends('admin._global.layout')

@section('page_title')
    會員編輯@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <fieldset class="form-horizontal">
                {{ \Admin\Form\FormRenderer::render($form->getFields()) }}
            </fieldset>

            <hr />

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Save</button>

                    <a class="btn btn-default" href="{{{ $router->buildHtml('users') }}}">Cancel</a>
                </div>
            </div>
        </div>
    </div>
@stop
