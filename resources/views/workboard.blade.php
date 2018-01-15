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
<!-- Include Required Prerequisites -->


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
			     <input name="group100" type="radio" id="radio100">
			</div>

	</div>
	<div class="col-sm-6">
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap.timepicker/0.2.6/css/bootstrap-timepicker.min.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script src="https://cdn.jsdelivr.net/bootstrap.timepicker/0.2.6/js/bootstrap-timepicker.min.js"></script>
		<label>Hora de inicio:</label>
		<div class="bootstrap-timepicker">
			<div class="bootstrap-timepicker-widget dropdown-menu">
				<table><tbody><tr><td><a href="#" data-action="incrementHour">
					<i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td><a href="#" data-action="incrementMinute">
						<i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td class="meridian-column"><a href="#" data-action="toggleMeridian">
							<i class="glyphicon glyphicon-chevron-up"></i></a></td></tr>
							<tr><td><span class="bootstrap-timepicker-hour">05</span></td> <td class="separator">:</td><td><span class="bootstrap-timepicker-minute">15</span></td> <td class="separator">&nbsp;</td><td><span class="bootstrap-timepicker-meridian">PM</span></td></tr><tr><td><a href="#" data-action="decrementHour"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator"></td><td><a href="#" data-action="decrementMinute"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator">&nbsp;</td><td><a href="#" data-action="toggleMeridian"><i class="glyphicon glyphicon-chevron-down"></i></a></td></tr></tbody></table></div>
                <div class="form-group">
                  <div class="input-group">
                  <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                    <input type="text" class="form-control timepicker">
  
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>

	</div>	
		<div class="col-sm-6">

		<label>Hora Final:</label>
		<div class="input-group bootstrap-timepicker timepicker">
		  <input id="timepicker1" type="text" class="form-control input-small">
		  <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
		</div>
	</div>	
	
 	</div>



</div>
<script type="text/javascript">
  $('#timepicker1').timepicker({
    showInputs: false
  });
</script>
@stop