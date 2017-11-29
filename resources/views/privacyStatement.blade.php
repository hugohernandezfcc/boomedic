@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

@stop

@section('content')

<div class="lockscreen-item" style="margin: 10px 0 30px auto;">
 <!-- lockscreen image -->
	   <div class="lockscreen-image">
		    	@if($photo == '')
		    	 	<img src="https://s3.amazonaws.com/abiliasf/profile-42914_640.png">
				@else
					<img src="{{ $photo }}">			
		    	@endif 

		    </div>
	    <!-- /.lockscreen-image -->

	    <!-- lockscreen credentials (contains the form) -->
	    <form class="lockscreen-credentials" action="create" method="get">
	    	{{ csrf_field() }}
	      	<div class="input-group">
	        	<div class="form-control">{{ $username }}</div>
	        	<input type="hidden" name="id" value="{{ $userId }}">
	      	</div>
	    </form>
	    <!-- /.lockscreen credentials -->
	</div>

<div class="box">
  	<div class="box-header with-border">
	    <h3 class="box-title">Aviso de Privacidad</h3>
  	</div>
  	<div class="box-body">
	  	@if($mode == 'Null')
	  		<div class="alert alert-info">
		        <i class="icon fa fa-info"></i>Lee detenidamente el aviso de privacidad de nuestra compañia, estos terminos representan la disponibilidad del uso de esta aplicación, el rechazo del mismo limita el acceso a los servicios de la compañia.
		    </div>        				      
		  	<p align="justify">
		  		{{ $privacy->description }}
		  	</p>
		  	<div class="row">
		  		<div class="col-md-6">
		  			<form action="{{asset('/privacyStatement/Aceptar')}}" method="post" id="aceptar">
						<button type="submit" class="btn btn-secondary btn-block btn-flat" >Aceptar</button>
					</form>
		  		</div>
		  		<div class="col-md-6">
		  			<form action="{{asset('/privacyStatement/Rechazar')}}" method="post" id="Rechazar">
						<button type="submit" class="btn btn-default btn-block btn-flat">Rechazar</button>
					</form>
		  		</div>
		  	</div>
		@endif

		@if($mode == 'Full')
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