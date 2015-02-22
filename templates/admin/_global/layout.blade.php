{{-- Part of asukademy project. --}}
<?php
use Riki\Asset\Asset;
use Riki\Uri\Uri;

Asset::addScript(Uri::media(true) . 'riki/js/form.js');
?>
@extends('admin._global.html')

@section('style')
{{ \Riki\Asset\Asset::renderStyles(true) }}
@stop

@section('script')
{{ \Riki\Asset\Asset::renderScripts(true) }}
@stop

@section('body')
    <div class="message-wrap">
        @foreach ((array) $flashes as $type => $typeBag)
        <div class="alert alert-{{{$type}}} alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>

            @foreach ((array) $typeBag as $msg)
            <p>{{ $msg }}</p>
            @endforeach

        </div>
        @endforeach
    </div>

    <div class="jumbotron">
        <div class="container">
            @section('header')
                <h1>@yield('page_title')</h1>
            @show
        </div>
    </div>

    <div class="container">
        <form id="adminForm" name="adminForm" method="post" enctype="multipart/form-data">
            @section('content')
                Layout Content
            @show
        </form>
    </div>
@stop
