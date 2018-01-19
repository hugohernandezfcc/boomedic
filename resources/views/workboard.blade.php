@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

<!-- Include Required Prerequisites -->
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap.timepicker/0.2.6/css/bootstrap-timepicker.min.css"/>
<script src="https://cdn.jsdelivr.net/bootstrap.timepicker/0.2.6/js/bootstrap-timepicker.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.0-alpha/css/bootstrap-select.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.0-alpha/js/bootstrap-select.js"></script>
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
  		<div id="al" class="al form-group col-sm-12" style="display: none;">
  		</div>
	<div class="form-group col-sm-12">		
	<label class="col-sm-4 control-label">Tipo de Horario: </label>

  	<div class="col-sm-8">
				<label>Fijo </label>
			    <input name="fixed" type="radio" id="fixed" checked value="fixed"> &nbsp;&nbsp;
			    <label>Variable </label>
			     <input name="fixed" type="radio" id="var" value="var">
	</div>
	</div>

	<div class="form-group col-sm-12" id="menu1">

  		
  	    <form action="{{ url('/workboardDr/create') }}/{{ $work }}" method="post" class="form-horizontal" id="formwork">
  	    	<div class="col-sm-4"><label>Seleccione los días de la semana que dará consulta con una jornada fija</label></div>
  	<div class="col-sm-8">	
  		<div data-toggle="buttons" class="btn-group">

  			<label for="Dom" class="btn btn-secondary">
				<input type="checkbox" value="Dom" name="day[]" id="Dom" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
				 <b>Dom</b>
			</label>		
	  		<label for="Lun" class="btn btn-default">
				<input type="checkbox" value="Lun" name="day[]" id="Lun" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
				<b>Lun</b>
			</label>
			<label for="Mar" class="btn btn-default">
				<input type="checkbox" value="Mar" name="day[]" id="Mar" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
				<b>Mar</b>
			</label>
			<label for="Mie"  class="btn btn-default">
				<input type="checkbox" value="Mie" name="day[]" id="Mier" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
				<b>Mier</b>
			</label>
			<label for="Jue" class="btn btn-default">
				<input type="checkbox" value="Jue" name="day[]" id="Jue" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
				<b>Jue</b>
			</label>
			<label for="Vie" class="btn btn-default">
				<input type="checkbox" value="Vie" name="day[]" id="Vie" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
				<b>Vier</b>
			</label>
			<label for="Sab" class="btn btn-default">
				<input type="checkbox" value="Sab" name="day[]" id="Sab" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
				<b>Sáb</b>
			</label>				
		</div>
	</div>
</div>



	<div class="form-group col-sm-12" style="display: none;" id="menu2">
		<div class="col-sm-12" >
			<label> Agrupe los días que tengan un mismo horario</label>
				<select id="sel" name="sel" class="selectpicker col-sm-12 form-control" data-style="btn-secondary" multiple title="Seleccione uno o varios días">

				  </select>
		</div>
	</div>

	<div class="form-group col-sm-12">
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
			 <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
		  <input id="timepicker1" type="text" class="form-control" name="end">
		</div>
	</div>
</div><br/>	
	<div class="form-group col-sm-12">
		
		<label class="col-sm-2 control-label">Promedio de duración por cita:</label>
		<div class="col-sm-10">
			 <input id="prom" type="number" name="prom" class="form-control" placeholder="Unidad de tiempo en minutos" required="required">
	 	</div>
	</div>
	<div id="btn1" class="col-sm-12" align="left" style="display: none;">
 		<button type="button" class="btn btn-secondary btn">Agregar grupo de horario</button>
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
     minuteStep: 5,
     defaultTime: '18:00'
  });
    $('#timepicker2').timepicker({
    showInputs: false,
     showMeridian:false,
     minuteStep: 5,
     defaultTime: '8:00'
  })
    $("#var").click(
				function(event) {
				   document.getElementById("menu2").style.display = "block";
				    document.getElementById("btn1").style.display = "block";
				   document.getElementById("menu1").style.display = "none";
				})
       $("#fixed").click(
				function(event) {
				   document.getElementById("menu1").style.display = "block";
				   document.getElementById("menu2").style.display = "none";
				    document.getElementById("btn1").style.display = "none";
				}) 
       $("#btn1").click(
				function(event) {

					var group =  $("#sel").val();
				if (group == "") {
				document.getElementById("al").style.display = "block";	
				  $('.al').append('<div class="alert alert-danger alert-dismissible" id="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><b><i class="icon fa fa-check"></i> No has seleccionado ningún día </b></div>');
					} else {
				document.getElementById("al").style.display = "block";	
					
				  $('.al').append('<div class="alert alert-success alert-dismissible" id="alert"><b><i class="icon fa fa-check"></i> Grupo de horario agregado</b><br/>Días: '+ group +'. Hora inicial: '+ $("#timepicker2").val() +'. Hora Final: '+ $("#timepicker1").val() +'</div>');
				}
			
				}) 



</script>
<script type="text/javascript">
			 $(' input[type=checkbox]').each(function(event) {
						$("#sel").append('<option value="'+ $(this).val() +'">'+ $(this).val() +'</option>').trigger('change.select2');
		        })
			 				

</script>
@stop