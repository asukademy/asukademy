{{-- Part of asukademy project. --}}

@extends('layouts.global.default')

@section('page_title')
常見問題@stop

@section('sub_title')
FAQ
@stop

@section('content')
{{ \Asukademy\Markdown\Markdown::renderFile('faq.md') }}
@stop
