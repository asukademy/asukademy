{{-- Part of asukademy project. --}}
<?php
use Riki\Asset\Asset;
use Riki\Uri\Uri;

Asset::addScript(Uri::media(true) . 'riki/js/form.js');

Asset::setIndents("    ");
?>
@extends('admin._global.html')

@section('style')
{{ \Riki\Asset\Asset::renderStyles(true) }}
@stop

@section('script')
{{ \Riki\Asset\Asset::renderScripts(true) }}
@stop

@section('body')

    <div class="jumbotron">
        <div class="container">
            @section('header')
                <h1 class="pull-left">@yield('page_title')</h1>
            @show

            <div class="toolbar pull-right">
                @section('toolbar')
                @show
            </div>
        </div>
    </div>

    <div class="message-wrap container">
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

    <div class="container">
        <form id="adminForm" name="adminForm" method="post" enctype="multipart/form-data">
            @section('content')
                Layout Content
            @show
        </form>

        @if (WINDWALKER_DEBUG)
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Queries</h3>
                </div>
                <div class="panel-body">
                    <?php $profiler = \Windwalker\Ioc::getProfiler(); ?>
                    {{ $profiler->render() }}
                </div>
            </div>
        @endif
    </div>
@stop
