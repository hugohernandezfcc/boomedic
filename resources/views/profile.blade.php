@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')
    <h1>Perfil de usuario</h1>
@stop

@section('content')
    <div class="box">
	  	<div class="box-header with-border">
		    <h3 class="box-title">Información: {{$status}}</h3>
		    <div class="box-tools pull-right">
		      	<!-- Buttons, labels, and many other things can be placed here! -->
		      	<!-- Here is a label for example -->
		      	<span class="label label-primary">Label</span>
		    </div>
	    	<!-- /.box-tools -->
	  	</div>
	  	<!-- /.box-header -->
	  	<div class="box-body">
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