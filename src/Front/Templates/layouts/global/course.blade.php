{{-- Part of asukademy project. --}}
@extends('layouts.global.html')

@section('banner')
    <div class="uk-container uk-container-center course-toolbar">
        <h1 class="page-title">@yield('page_title')</h1>
        <h2 class="sub-title">@yield('sub_title')</h2>

        <div class="search-bar">
            <form class="uk-form" action="{{{ $uri['current'] }}}">

                <input type="text" class="uk-form-large uk-form-width-large uk-text-center" value="" placeholder="搜尋課程名稱" />

            </form>
        </div>

        <div class="categories-bar">
            @foreach ($cats as $cat)
            <a class="banner-cat-button" href="{{{ $router->buildHtml('courses', ['category_id' => $cat->id]) }}}">
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
                </article>
            </div>

            @section('right')@show

        </div>
    </section>
@stop