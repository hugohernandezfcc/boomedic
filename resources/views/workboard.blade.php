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
  		<div class="btn-group" data-toggle="buttons" style="font-size: 12px">

  			<label class="btn btn-secondary">
				<input type="checkbox" value="Domingo" name="Domingo">
				<span class="glyphicon glyphicon-ok"></span>
				 <b>Dom</b>
			</label>		
	  		<label class="btn btn-default">
				<input type="checkbox" value="Lunes" name="Lunes">
				<span class="glyphicon glyphicon-ok"></span>
				<b>Lun</b>
			</label>
			<label class="btn btn-default">
				<input type="checkbox" value="Martes" name="Martes">
				<span class="glyphicon glyphicon-ok"></span>
				<b>Mar</b>
			</label>
			<label class="btn btn-default">
				<input type="checkbox" value="Miercoles" name="Miercoles">
				<span class="glyphicon glyphicon-ok"></span>
				<b>Mier</b>
			</label>
			<label class="btn btn-default">
				<input type="checkbox" value="Jueves" name="Jueves">
				<span class="glyphicon glyphicon-ok"></span>
				<b>Jue</b>
			</label>
			<label class="btn btn-default">
				<input type="checkbox" value="Viernes" name="Viernes">
				<span class="glyphicon glyphicon-ok"></span>
				<b>Vier</b>
			</label>
			<label class="btn btn-default">
				<input type="checkbox" value="Sábado" name="Sábado">
				<span class="glyphicon glyphicon-ok"></span>
				<b>Sáb</b>
			</label>				
		</div>
	</div><br/>
	<div class="col-sm-4">
		<label>Rango de citas: </label>
	</div>
	<!--Radio group-->
	<div class="col-sm-8">
			<div class="form-group ">
			    <input name="group100" type="radio" id="radio100">
			    <label for="radio100">Option 1</label>
			</div>

			<div class="form-group">
			    <input name="group100" type="radio" id="radio101" checked>
			    <label for="radio101">Option 2</label>
			</div>

	</div>		
			<!--Radio group-->
 	</div>
</div>	  	
@stop