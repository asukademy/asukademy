{{-- Part of asukademy project. --}}

@extends('layouts.global.course')

@section('page_title')
{{--{{{ $pageTitle }}}--}}
@stop

@section('banner')
    <div class="uk-container uk-container-center course-toolbar">
        <h1 class="page-title">{{{ $item->title }}}</h1>
        <h2 class="sub-title">{{{ $item->subtitle }}}</h2>
    </div>
@stop

@section('content')
    <div class="uk-grid basic-layout">
        <div class="uk-width-medium-1-4">
            @include('left')
            s
        </div>

        <div class="uk-width-medium-3-4 uk-container-center">
            <article class="article-content">
                {{ \Asukademy\Markdown\Markdown::defaultTransform($item->fulltext) }}

                @if ($item->learned)
                    <h1>在這堂課，您可以學到...</h1>
                    {{ \Asukademy\Markdown\Markdown::defaultTransform($item->learned) }}
                @endif

                @if ($item->target)
                    <h1>適合對象</h1>
                    {{ \Asukademy\Markdown\Markdown::defaultTransform($item->target) }}
                @endif

                @if ($item->note)
                    <h1>注意事項</h1>
                    {{ \Asukademy\Markdown\Markdown::defaultTransform($item->note) }}
                @endif

                <h1>開課梯次</h1>
                @if (count($stages))
                    @include('stages')
                @else
                沒有開課梯次
                @endif
            </article>
        </div>
    </div>
@stop