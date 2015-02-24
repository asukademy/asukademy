{{-- Part of asukademy project. --}}

@extends('layouts.global.course')

@section('page_title')
課程資訊@stop

@section('content')

    @foreach ($categories as $category)
        <div class="category-container">
            <div class="category-title">
                <h1 class="page-title">{{{ $category['data']->title }}}</h1>
                <h2 class="sub-title">{{{ $category['data']->eng_title }}}</h2>
            </div>

            @include('category', ['items' => $category['items']])
        </div>
    @endforeach

    <div class="uk-margin-large-top">
        {{ $pagination->render('front:courses', 'widget.pagination') }}
    </div>

@stop
