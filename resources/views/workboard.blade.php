@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')
<style type="text/css">
.btn span.glyphicon {    			
	opacity: 0;				
}
.btn.active span.glyphicon {				
	opacity: 1;				
}
</style>
@stop

@section('content')

<div class="box">
  	<div class="box-header with-border">
	    <h3 class="box-title">Horario de Trabajo</h3>
  	</div>
  	<div class="box-body">
  		<div class="col-sm-4">	
  		<label>Seleccione los días de la semana que va a trabajar:</label><br/>
  	    </div>
  	<div class="col-sm-8">	
  		<div class="btn-group" data-toggle="buttons">

  			<label class="btn btn-secondary">
				<input type="checkbox" value="Domingo" name="Domingo">
				<span class="glyphicon glyphicon-ok"></span>
				 <b>Domingo</b>
			</label>		
	  		<label class="btn btn-secondary">
				<input type="checkbox" value="Lunes" name="Lunes">
				<span class="glyphicon glyphicon-ok"></span>
				<b>Lunes</b>
			</label>
			<label class="btn btn-secondary">
				<input type="checkbox" value="Martes" name="Martes">
				<span class="glyphicon glyphicon-ok"></span>
				<b>Martes</b>
			</label>
			<label class="btn btn-secondary">
				<input type="checkbox" value="Miercoles" name="Miercoles">
				<span class="glyphicon glyphicon-ok"></span>
				<b>Miercoles</b>
			</label>
			<label class="btn btn-secondary">
				<input type="checkbox" value="Jueves" name="Jueves">
				<span class="glyphicon glyphicon-ok"></span>
				<b>Jueves</b>
			</label>
			<label class="btn btn-secondary">
				<input type="checkbox" value="Viernes" name="Viernes">
				<span class="glyphicon glyphicon-ok"></span>
				<b>Viernes</b>
			</label>
			<label class="btn btn-secondary">
				<input type="checkbox" value="Sábado" name="Sábado">
				<span class="glyphicon glyphicon-ok"></span>
				<b>Sábado</b>
			</label>				
		</div>
	</div><br/>
	<div class="col-sm-12">
		Rango de citas
	</div>
 	</div>
</div>	  	
@stop