{{-- Part of asukademy project. --}}

@extends('layouts.global.course')

@section('page_title')
{{{ $item->title }}}
@stop

@section('banner')
    <div class="uk-container uk-container-center course-toolbar">
        <h1 class="page-title">{{{ $item->course->title }}}</h1>
        <h2 class="sub-title">開課梯次資訊: {{{ $item->title }}}</h2>
    </div>
@stop

@section('content')
    <div class="uk-grid basic-layout">
        <div class="uk-width-medium-1-4">
            @include('left')
        </div>

        <div class="uk-width-medium-3-4 uk-container-center">
            <article class="article-content">
                <h1>課程規劃</h1>
                @include('classes')

                {{ \Asukademy\Markdown\Markdown::defaultTransform($item->course->fulltext) }}

                @if ($item->course->learned)
                    <h1>在這堂課，您可以學到...</h1>
                    {{ \Asukademy\Markdown\Markdown::defaultTransform($item->course->learned) }}
                @endif

                @if ($item->course->target)
                    <h1>適合對象</h1>
                    {{ \Asukademy\Markdown\Markdown::defaultTransform($item->course->target) }}
                @endif

                @if ($item->course->note)
                    <h1>注意事項</h1>
                    {{ \Asukademy\Markdown\Markdown::defaultTransform($item->course->note) }}
                @endif

                <h1 id="attend">立即報名</h1>
                @if (count($plans))
                    @include('plans')
                @else
                    沒有報名方案可選
                @endif
            </article>
        </div>
    </div>
@stop
