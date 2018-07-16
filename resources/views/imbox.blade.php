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
                <h4>Asunto: {{ $f->subject_email }}</h4>
                <p>From: {{ $f->email }}
                <br>Fecha: {{  $f->date_email }}<br><a href="{{ $f->url }}" class="btn btn-secondary btn-sm">{{ $f->details }}</a> 
                
                @php
					         echo $f->text_email;
                @endphp
                </p>
      </div>
	  		@endforeach

	</div>  
</div>	
  		
@stop