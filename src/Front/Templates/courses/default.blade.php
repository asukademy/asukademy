{{-- Part of asukademy project. --}}

@extends('layouts.global.course')

@section('page_title')
{{{ $pageTitle }}}@stop

@section('content')

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

    <div class="uk-margin-large-top">
        {{ $pagination->render('front:courses', 'widget.pagination') }}
    </div>

@stop
