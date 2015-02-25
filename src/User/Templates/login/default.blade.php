{{-- Part of asukademy project. --}}

@extends('layouts.global.default')

@section('page_title')
登入@stop

@section('sub_title')
Login
@stop

@section('content')
    <style>
        .uk-form-row.register-button-bar {
            margin-top: 70px;
            text-align: center;
        }

        .register-button-bar .uk-button-primary {
            width: 50%;
        }
    </style>
    <div class="uk-width-medium-3-4 uk-container-center">
        <form action="{{{ $uri['current'] }}}" method="post" id="adminForm" enctype="multipart/form-data">
            <div class="uk-form uk-form-horizontal">
                {{ \Front\Form\UikitFormRenderer::render($form->getFields(), '', 'uk-width-1-1'); }}


                <div class="uk-form-row register-button-bar">
                    <button class="uk-button uk-button-large uk-button-primary">
                        註冊
                    </button>
                </div>
            </div>
            <input name="return" type="hidden" value="{{{ $return }}}" />
        </form>
    </div>
@stop