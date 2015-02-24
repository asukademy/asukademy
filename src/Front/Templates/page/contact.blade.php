{{-- Part of asukademy project. --}}

@extends('layouts.global.default')

@section('page_title')
聯絡與諮詢@stop

@section('sub_title')
Contact Us
@stop

@section('content')
{{ \Asukademy\Markdown\Markdown::renderFile('contact.md') }}
@include('widget.like-box')
@stop
