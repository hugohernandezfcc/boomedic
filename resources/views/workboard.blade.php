@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

<!-- Include Required Prerequisites -->
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap.timepicker/0.2.6/css/bootstrap-timepicker.min.css"/>
<script src="https://cdn.jsdelivr.net/bootstrap.timepicker/0.2.6/js/bootstrap-timepicker.min.js"></script>
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
  		<label>Seleccione los días de la semana que dará consultas:</label><br/>
  	    </div>
  	    <form action="{{ url('/workboardDr/create') }}/{{ $work }}" method="post" class="form-horizontal">
  	<div class="col-sm-8">	
  		<div data-toggle="buttons">

  			<label class="btn btn-secondary">
				<input type="checkbox" value="Dom" name="day[]" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
				 <b>Dom</b>
			</label>		
	  		<label class="btn btn-default active">
				<input type="checkbox" value="Lun" name="day[]" autocomplete="off" checked>
				<span class="glyphicon glyphicon-ok"></span>
				<b>Lun</b>
			</label>
			<label class="btn btn-default">
				<input type="checkbox" value="Mar" name="day[]" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
				<b>Mar</b>
			</label>
			<label class="btn btn-default">
				<input type="checkbox" value="Mie" name="day[]" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
				<b>Mier</b>
			</label>
			<label class="btn btn-default">
				<input type="checkbox" value="Jue" name="day[]" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
				<b>Jue</b>
			</label>
			<label class="btn btn-default">
				<input type="checkbox" value="Vie" name="day[]" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
				<b>Vier</b>
			</label>
			<label class="btn btn-default">
				<input type="checkbox" value="Sab" name="day[]" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
				<b>Sáb</b>
			</label>				
		</div>
	</div><br/><br/><br/>
		<!--Radio group-->
	<div class="col-sm-4">
				<div class="form-group">
				<label>Tipo de Horario: </label>
			   
			</div>
	</div>

	<div class="col-sm-8">

			<div class="form-group">
				<label>Fijo </label>
			    <input name="fixed" type="radio" id="fixed" checked value="fixed"> &nbsp;&nbsp;
			    <label>Variable </label>
			     <input name="fixed" type="radio" id="vard" disabled="disabled" value="var">
			</div>

	</div>
	<div class="form-group">
		<div class="col-sm-12">
			  <select class="selectpicker" multiple data-selected-text-format="count>3">
			     <option>Mustard</option>
			      <option>Ketchup</option>
			      <option>Relish</option>
			      <option>Onions</option>
			  </select>
		</div>
	</div>

	<div class="form-group">
	<div class="col-sm-6">

		<label>Hora de inicio:</label>
		<div class="input-group bootstrap-timepicker timepicker">
		<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
		  <input id="timepicker2" type="text" class="form-control" name="start">
		</div>

	</div>	
		<div class="col-sm-6">

		<label>Hora Final:</label>
		<div class="input-group bootstrap-timepicker timepicker">
		  <input id="timepicker1" type="text" class="form-control" name="end">
		  <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
		</div>
	</div>
</div>	
	<div class="form-group">
		
		<label class="col-sm-2 control-label">Promedio de duración por cita:</label>
		<div class="col-sm-10">
			 <input id="prom" type="number" name="prom" class="form-control" placeholder="Unidad de tiempo en minutos" required="required">
	 	</div>
	</div>
 	<div class="col-sm-12" align="right">
 		<button type="submit" class="btn btn-secondary">Guardar</button>
 		<a href="{{ url()->previous() }}" class="btn btn-default">
						                Cancelar
 </a>
 	</div>

</form>
</div>
<script type="text/javascript">
  $('#timepicker1').timepicker({
    showInputs: false,
     showMeridian:false,
     minuteStep: 5
  });
    $('#timepicker2').timepicker({
    showInputs: false,
     showMeridian:false,
     minuteStep: 5
  });
    $('.selectpicker').selectpicker({
      style: 'btn-info',
      size: 4
  });

</script>
@stop