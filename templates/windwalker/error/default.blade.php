@extends('layouts.global.html')

@section('banner')
    <style>
        #banner {
            padding: 5% 0;
        }
        #banner .error-code {
            font-size: 250px;
            margin-bottom: 30px;
            text-shadow: none;
        }
        #banner h2 {
            font-size: 50px;
        }

        #main-body {
            display: none;
        }

        #footer {
            margin-top: 0;
        }

        @media (max-width: 767px) {
            #banner .error-code {
                font-size: 150px;
            }
        }
    </style>
    <div class="uk-container uk-container-center">
        <section id="error-section" class="main-block">
            <h1 class="error-code uk-text-center">
                {{{ $exception->getCode() }}}
            </h1>
            <h2 class="uk-text-center">
                {{{ $exception->getMessage() }}}
            </h2>
        </section>
    </div>
@stop
