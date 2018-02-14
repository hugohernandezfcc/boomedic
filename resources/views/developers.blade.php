@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

@stop

@section('content')


<div class="box">
  	<div class="box-header with-border">
	    <h3 class="box-title">Desarrolladores</h3>
  	</div>
  	<div class="box-body">
	  
	  	<div class="alert alert-info">
		    <i class="icon fa fa-info"></i>Aqui puedes crear tus Applicaciones para poder utilizar nuestra API mediante su Id de cliente y cliente secreto que se proporcionan a continuación. Recuerde consultar nuestra documentación para poder realizar su integración.
		</div><br/><br/>

		<table id="ClientsApi" class="table table-bordered table-striped" cellspacing="0" width="100%">
	                <thead>
	                    <tr>
	                    	<th>Nombre</th>
	                        <th>Id de Cliente </th>
	                        <th>Cliente Secreto </th>
	                        <th>Url de Redireccionamiento</th>
	                        <th> - </th>
	                    </tr>
	                </thead>
	                
	                
	            </table><br/><br/>        				      
	</div>  	
@stop