{{-- Part of asukademy project. --}}
@extends('layouts.global.html')

@section('banner')
    <div class="uk-container uk-container-center course-toolbar">
        <h1 class="page-title">{{{ $currentCategory->isNull() ? '課程資訊' : $currentCategory->title  }}}</h1>
        <h2 class="sub-title">@yield('sub_title')</h2>

        <div class="search-bar">
            <form class="uk-form" action="{{{ $uri['current'] }}}" method="get">

                <input type="text" name="q" class="uk-form-large uk-form-width-large uk-text-center"
                        value="{{{ $state['list.search'] }}}" placeholder="搜尋課程名稱" />

            </form>
        </div>

        <div class="categories-bar">
            <a class="banner-cat-button {{ $currentCategory->isNull() ? 'active' : '' }}"
                    href="{{{ $router->buildHtml('courses') }}}">
                全部課程
            </a>
            @foreach ($cats as $cat)
            <a class="banner-cat-button {{ $currentCategory->id == $cat->id ? 'active' : '' }}"
                href="{{{ $router->buildHtml('category_courses', ['category_alias' => $cat->alias]) }}}">
                {{{ $cat->title }}}
            </a>
            @endforeach
        </div>
    </div>
@stop

@section('body')
    <section id="basic-section" class="main-block courses-layout">
        <div class="uk-container uk-container-center">

            @section('left')@show

            <div class="uk-width-medium-1-1 uk-container-center">
                <article class="article-content">
                    @section('content')
                        Content
                    @show

                    @if (WINDWALKER_DEBUG)
                        <div class="uk-panel uk-panel-box">
                            <h3 class="uk-panel-title">Debug</h3>
                            <?php $profiler = \Windwalker\Ioc::getProfiler(); ?>
                            {{ $profiler->render() }}
                        </div>
                    @endif
                </article>
            </div>

            @section('right')@show

        </div>
    </section>
@stop