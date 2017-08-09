@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')
    <h1>{{$KEY}}</h1>
@stop

@section('content')
    <p>The current UNIX timestamp is {{ time() }}.</p>
    UserId: {{ $userId }}

    <div id="app"></div>

	<script src="{{ asset('react/app-dist.js') }}"></script>
@stop