{{-- Part of asukademy project. --}}

@extends('layouts.global.course')

@section('page_title')
{{{ $item->course->title }}} - {{{ $item->title }}}@stop

@section('banner')
    <div class="uk-container uk-container-center course-toolbar banner-toolbar">
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

                <h1 id="intro">課程簡介</h1>

                {{ \Asukademy\Markdown\Markdown::defaultTransform(\Front\Helper\IntroHelper::cutParagraphs($item->course->fulltext, 20)) }}

                <p class="uk-text-center">
                    <a class="uk-button uk-button-hero uk-button-primary"
                            href="{{{ $router->buildHtml('course', ['category_alias' => $item->category->alias, 'alias' => $item->course->alias]) }}}">
                        觀看更完整的課程介紹
                    </a>
                </p>

                <hr />

                @if (count($item->classes))
                    <h1 id="classes">課程規劃</h1>
                    @include('classes')
                @endif

                <h1 id="info">課程資訊</h1>
                @include('info')

                @if ($item->course->learned)
                    <h1 id="learned">在這堂課，您可以學到...</h1>
                    {{ \Asukademy\Markdown\Markdown::defaultTransform($item->course->learned) }}
                @endif

                @if ($item->course->target)
                    <h1 id="target">適合對象</h1>
                    {{ \Asukademy\Markdown\Markdown::defaultTransform($item->course->target) }}
                @endif

                @if ($item->course->note)
                    <h1 id="note">注意事項</h1>
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
