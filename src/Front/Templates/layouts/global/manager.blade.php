{{-- Part of asukademy project. --}}
@extends('layouts.global.html')

@section('banner')
    <div class="uk-container uk-container-center banner-toolbar">
        <h1 class="page-title">@yield('page_title')</h1>
    </div>
@stop

@section('body')
    <section id="manager-section" class="main-block manager-layout">
        <div class="uk-container uk-container-center">

            <div class="uk-grid">
                <div class="uk-width-medium-1-4">
                    @yield('left')
                </div>

                <div class="uk-width-medium-3-4">

                    <article class="article-content">
                        @section('content')
                            Content
                        @show
                    </article>
                </div>
            </div>

        </div>
    </section>
@stop