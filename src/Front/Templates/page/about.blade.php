{{-- Part of asukademy project. --}}

@extends('layouts.global.default')

@section('page_title')
歡迎來到 Asukademy 飛鳥學院@stop

@section('sub_title')
Welcome to Asukademy
@stop

@section('content')
{{ \Asukademy\Markdown\Markdown::renderFile('about.md') }}
@stop
