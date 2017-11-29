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
		  	<div style="margin-bottom: 10%;margin-right: 100px;">
		  		<table align="center">
		  			<tr>
		  				<td>
		  					<form action="{{asset('/privacyStatement/Aceptar')}}" method="post" id="aceptar">
		  						<button type="submit" class="btn btn-secondary btn-block btn-flat" >Aceptar</button>
		  					</form>
		  				</td>
		  				<td>
		  					<form action="{{asset('/privacyStatement/Rechazar')}}" method="post" id="Rechazar">
		  						<button type="submit" class="btn btn-default btn-block btn-flat">Rechazar</button>
		  					</form>
		  				</td>
		  			</tr>
		  		</table>
		  	</div>
		  	<br/>
		@endif

		@if($mode == 'Full')
			<p>
				{{ $privacy->description }}
			</p>
  		@endif
 
</div>	  	
@stop