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
  		<label>Seleccione los días de la semana que va a trabajar:</label><br/>
  	    </div>
  	    <form>
  	<div class="col-sm-8">	
  		<div data-toggle="buttons">

  			<label class="btn btn-secondary">
				<input type="checkbox" value="Dom" name="Dom"  autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
				 <b>Dom</b>
			</label>		
	  		<label class="btn btn-default">
				<input type="checkbox" value="Lun" name="Lun" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
				<b>Lun</b>
			</label>
			<label class="btn btn-default">
				<input type="checkbox" value="Mar" name="Mar" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
				<b>Mar</b>
			</label>
			<label class="btn btn-default">
				<input type="checkbox" value="Mie" name="Mie" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
				<b>Mier</b>
			</label>
			<label class="btn btn-default">
				<input type="checkbox" value="Jue" name="Jue" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
				<b>Jue</b>
			</label>
			<label class="btn btn-default">
				<input type="checkbox" value="Vie" name="Vie" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
				<b>Vier</b>
			</label>
			<label class="btn btn-default">
				<input type="checkbox" value="Sáb" name="Sab" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
				<b>Sáb</b>
			</label>				
		</div>
	</div><br/><br/>
		<!--Radio group-->
	<div class="col-sm-4">
				<div class="form-group">
				<label>Tipo de Horario: </label>
			   
			</div>
	</div>

	<div class="col-sm-8">

			<div class="form-group">
				<label>Fijo </label>
			    <input name="group100" type="radio" id="radio101" checked> &nbsp;&nbsp;
			    <label>Variable </label>
			     <input name="group100" type="radio" id="radio100" disabled="disabled">
			</div>

	</div>
	<div class="col-sm-6">

		<label>Hora de inicio:</label>
		<div class="input-group bootstrap-timepicker timepicker">
		<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
		  <input id="timepicker2" type="text" class="form-control">
		</div>

	</div>	
		<div class="col-sm-6">

		<label>Hora Final:</label>
		<div class="input-group bootstrap-timepicker timepicker">
		  <input id="timepicker1" type="text" class="form-control">
		  <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
		</div>
	</div>	
	
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
</script>
@stop