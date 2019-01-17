@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

@stop

@section('content')
<div class="box">
  	<div class="box-header with-border">
	    <h3 class="box-title">¿Qué es esto?</h3>
  	</div>
  	<div class="box-body">		
				<a href='https://site-boomedic.herokuapp.com?user={{ $userId }}' class="btn btn-default" target="_blank">Más información</a>	
 	</div>
</div>	  	
@stop