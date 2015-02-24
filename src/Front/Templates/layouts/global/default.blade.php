{{-- Part of asukademy project. --}}
@extends('layouts.global.html')

@section('body')
    <section id="basic-section" class="main-block basic-layout">
        <div class="uk-container uk-container-center">

            @section('left')@show

            <div class="uk-width-medium-4-6 uk-container-center">
                <h1 class="page-title">@yield('page_title')</h1>
                <h2 class="sub-title">@yield('sub_title')</h2>

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
