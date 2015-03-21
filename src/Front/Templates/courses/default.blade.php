{{-- Part of asukademy project. --}}

@extends('layouts.global.course')

@section('page_title')
{{{ $pageTitle }}}@stop

@section('banner')
    <div class="uk-container uk-container-center course-toolbar banner-toolbar">
        <h1 class="page-title">{{{ $currentCategory->isNull() ? '課程資訊' : $currentCategory->title  }}}</h1>
        <h2 class="sub-title">@yield('sub_title')</h2>

        <div class="search-bar">
            <form class="uk-form" action="{{{ $router->buildHtml('courses') }}}" method="get">

                <input type="text" name="q" class="uk-form-large uk-form-width-large uk-text-center"
                        value="{{{ $state['list.search'] }}}" placeholder="搜尋課程" />

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

@section('content')

    <div class="uk-width-medium-1-1 uk-container-center">
        <article class="article-content">
            @forelse ($categories as $category)
                <div class="category-container">
                    <div class="category-title">
                        <h1 class="page-title">{{{ $category['data']->title }}}</h1>
                        <h2 class="sub-title">{{{ $category['data']->eng_title }}}</h2>
                    </div>

                    @include('category', ['items' => $category['items']])
                </div>
            @empty
                <p class="uk-text-center">
                    沒有結果
                </p>
            @endforelse

            <p class="uk-text-center">
                共 {{ ceil($total / $state['list.limit']) }} 頁
            </p>

            <div class="uk-margin-large-top">
                <?php
                $pagin = $pagination->render(function($queries) use ($state)
                {
                    $queries['q'] = $state['list.search'];

                    return \Windwalker\Core\Router\Router::buildHtml('front:courses', $queries);
                }, 'widget.pagination');
                ?>
                {{ $pagin }}
            </div>
        </article>
    </div>

@stop
