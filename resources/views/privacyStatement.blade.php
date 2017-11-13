@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

@stop

@section('content')


<div class="box">
	  	<div class="box-header with-border">
		    <h3 class="box-title">Aviso de Privacidad</h3>
	  	</div>
	  <div style="margin-left: 100px; margin-top: 50px; margin-right: 100px; text-align: justify;">
	  		{{ $privacy->description }}
	  </div>
</div>	  	

 

@stop