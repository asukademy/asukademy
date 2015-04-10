{{-- Part of asukademy project. --}}

@extends('layouts.global.course')

@section('page_title')
{{{ $item->title }}} - 課程資訊@stop

@section('banner')
    <div class="uk-container uk-container-center course-toolbar banner-toolbar">
        <h1 class="page-title">{{{ $item->title }}}</h1>
        <h2 class="sub-title">{{{ $item->subtitle }}}</h2>
    </div>
@stop

@section('content')
    <div class="uk-grid basic-layout">
        <div class="uk-width-medium-1-4">
            @include('left')
        </div>

        <div class="uk-width-medium-3-4 uk-container-center">
            <article class="article-content">

                <p class="uk-text-center">
                    <img class="uk-border-rounded work-img" src="{{{ $item->image }}}" alt="Cover" />
                </p>

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

                <h1 id="stages">開課梯次</h1>
                @if (count($stages))
                    @include('stages')
                @else
                沒有開課梯次
                @endif

                <p class="uk-text-center uk-margin-large-top">
                    <a href="{{{ $router->buildHtml('page', ['paths' => 'contact']) }}}">
                        訂閱我們
                    </a> 以隨時接收最新的開課資訊
                </p>
            </article>

            <aside class="comments uk-margin-large-top">
                <h1>留言</h1>
                {{--<div class="fb-comments" data-href="{{{ \Riki\Uri\Uri::current() }}}" data-width="100%" data-numposts="20" data-colorscheme="light"></div>--}}
                {{ \Front\Helper\DisqusHelper::render() }}
            </aside>
        </div>
    </div>
@stop