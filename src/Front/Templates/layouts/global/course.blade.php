{{-- Part of asukademy project. --}}
@extends('layouts.global.html')

@section('body')
    <aside class="middle-toolbar uk-container uk-container-center">
        <div class="middle-toolbar-inner">
            @yield('middle_toolbar')
        </div>
    </aside>

    <section id="course-section" class="main-block courses-layout">
        <div class="uk-container uk-container-center">

            @section('content')
                Content
            @show

        </div>
    </section>
@stop