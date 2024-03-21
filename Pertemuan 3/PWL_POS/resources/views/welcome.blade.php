@extends('layout.app')

{{--Customize layout sections--}}

@section('subtitle','Welcome')
@section('content_header_title','Home')
@section('content_header_subtitle','Welcome')

{{--Content body: main page content --}}
@section('content_body')
<p>Welcome to this beatiful admin panel</p>
@stop

{{--push extra CSS--}}

@push('css')
    {{--add here extra stylesheets--}}   
    {{--<link rel="stylesheet" href="/css/admin_custom.css">--}}
@endpush


{{-- Push extra scripts --}}

@push('js')
<script>console.log("Hi, I'm using the Laravel-AdminLTE package!")</script>   
@endpush