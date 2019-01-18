@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

@stop

@section('content')



@if($mode == 'Null')

<div class="box">
  	<div class="box-header with-border">
	    <h3 class="box-title">Aviso de Privacidad</h3>
  	</div>
  	<div class="box-body">
	  
	  		<div class="alert alert-info">
		        <i class="icon fa fa-info"></i>Lee detenidamente el aviso de privacidad de nuestra compañia, estos terminos representan la disponibilidad del uso de esta aplicación, el rechazo del mismo limita el acceso a los servicios de la compañia.
		    </div>        				      
		  	<p align="justify">
		  		{{ $privacy->description }}
		  	</p>
		  	<div class="row">
		  		<div class="col-md-6">
		  			<form action="{{asset('/privacyStatement/Aceptar')}}" method="post" id="aceptar">
		  				{{ csrf_field() }}
						<button type="submit" class="btn btn-secondary btn-block btn-flat" >Aceptar</button>
					</form>
		  		</div>
		  		<div class="col-md-6">
		  			<form action="{{asset('/privacyStatement/Rechazar')}}" method="post" id="Rechazar">
		  				{{ csrf_field() }}
						<button type="submit" class="btn btn-default btn-block btn-flat">Rechazar</button>
					</form>
		  		</div>
		  	</div>
		@endif

		@if($mode == 'Full')

<div class="box">
  	<div class="box-header with-border">
	    <h3 class="box-title">Aviso de Privacidad</h3>
  	</div>
  	<div class="box-body">		
			<div class="alert alert-success">
		        <i class="icon fa fa-check"></i>El aviso de privacidad fue aceptado <i>{{ $privacy->created_at }}</i>
		    </div>
			<p align="justify">
				{{ $privacy->description }}
			</p>
		@endif
 	</div>
</div>	  	
@stop