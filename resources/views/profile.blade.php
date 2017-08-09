@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')
    <h1>Perfil de usuario</h1>
@stop

@section('content')
    <div class="box">
	  	<div class="box-header with-border">
		    <h3 class="box-title">Información</h3>
	    	<!-- /.box-tools -->
	  	</div>
	  	<!-- /.box-header -->
	  	<div class="box-body">
	  		@if ($status == "In Progress")
	  			<div class="callout callout-success">
	                <h4>Ya casi estamos listos!!!</h4>

	                <p>Confirma y completa la información que esta debajo</p>
	            </div>
    		@endif

    		
    		
	    	aquí van a ir los campos
	  	</div>
	  	<!-- /.box-body -->
	  	<div class="box-footer">
	    	aquí el botón que va a guardar los cambios.
	  	</div>
	  	<!-- box-footer -->
	</div>
	<!-- /.box -->
@stop