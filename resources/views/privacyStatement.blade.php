@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

@stop

@section('content')


<div class="box">
	  	<div class="box-header with-border">
		    <h3 class="box-title">Aviso de Privacidad</h3>
	  	</div>

	  	@if($mode == 'Null')        				      
		  	<p>
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
                <h4><i class="icon fa fa-check"></i> Aceptado</h4>
                El aviso de privacidad fue aceptado <i>{{ $privacy->created_at }}</i>
            </div>
			<p>
				{{ $privacy->description }}
			</p>
  		@endif
 
</div>	  	
@stop