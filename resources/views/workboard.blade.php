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
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />
 
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
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
		<!--Radio group-->
	<div class="col-sm-12">
				<div class="form-group">
				<label>Horario Variable: </label>
			    <input name="group100" type="radio" id="radio100">
			</div>
	</div>

	<div class="col-sm-12">

			<div class="form-group">
				<label>Horario Fijo: </label>
			    <input name="group100" type="radio" id="radio101" checked>
			</div>

	</div>
	<div class="col-sm-12">

		<div class="form-group">
		<label>Rango: Hora de inicio y fin</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="reservationtime" name="reservationtime">

                </div>
                <!-- /.input group -->
              </div>
	</div>		
			<!--Radio group-->
 	</div>

<script type="text/javascript">
$(function() {
    $('input[name="reservationtime"]').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
            format: 'h:mm A'
        }
    });
});
</script>

</div>

@stop