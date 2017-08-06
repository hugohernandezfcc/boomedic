@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>{{$KEY}}</h1>
@stop

@section('content')
    <p>The current UNIX timestamp is {{ time() }}.</p>
@stop