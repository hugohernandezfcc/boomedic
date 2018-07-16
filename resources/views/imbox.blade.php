@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')
	<style type="text/css">
		.callout-gray{
			background-color: #fff !important;
			border-color: #777;		
		}
		.callout a{
			text-decoration: none !important;
		}
	</style>
@stop

@section('content')
<div class="box">
  	<div class="box-header with-border">
	    <h3 class="box-title">Imbox</h3>
  	</div>
  	<div class="box-body">
  		<b>Adjuntos recibidos #{{ $count }}</b><br><br>
  			@foreach($files as $f)
			 <div class="callout callout-gray">
                <h4>Asunto: {{ $f['subject'] }}</h4>
                <p>From: {{ $f['from'] }}
                <br>Fecha: {{  $f['date'] }} 
                <br> <a href="{{ $f['path'] }}" class="btn btn-secondary">{{ $f['filename'] }}</a></p>
                <!-- <p>{{ $f['message'] }}</p> -->
                @php
					         echo $f['message'];
                @endphp
              </div>
	  		@endforeach

	  
  	</div>	
  		
@stop