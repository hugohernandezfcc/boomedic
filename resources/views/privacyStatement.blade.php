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
	  	
		          				      
	  <div style="margin-left: 100px; margin-top: 50px; margin-right: 100px; text-align: justify;margin-bottom: 5%">
	  		{{ $privacy->description }}
	  </div>
	  <div style="margin-bottom: 10%;margin-right: 100px;">
	  	<table align="right"><tr><td>
	  <form action="Aceptar" method="post" id="aceptar"><button type="submit" class="btn btn-secondary btn-block btn-flat" >Aceptar</button></form></td>
	  <td><form action="Rechazar" method="post" id="Rechazar">
	  <button type="submit" class="btn btn-secondary btn-block btn-flat">Rechazar</button></form></td></tr></table>
	  </div><br/>
	

		@endif

		@if($mode == 'Full')

	
			  <div style="margin-left: 100px; margin-top: 50px; margin-right: 100px; text-align: justify; margin-bottom: 10%;">
	  		{{ $privacy->description }}
	  </div><br/>
  			@endif
 
</div>	  	
@stop