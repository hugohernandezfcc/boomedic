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
  #calendar {
    max-width: 900px;
    margin: 0 auto;
  }
</style>
@stop

@section('content')

<div class="box">

  	<div class="box-header with-border">
	    <h3 class="box-title">Horario de Trabajo</h3>
	    
  	</div>
  	<div class="box-body">
  		@if($mode != 'calendar')
@if(count($workboard) > 0)
<div class="alert alert-dismissible text-red"><b><i class="icon fa fa-warning"></i> Tienes un horario registrado en este lugar. Si guardas un nuevo horario se perderá el registro anterior.</b>
</div>


@endif
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
				  <input type="hidden" name="vardays" id="vardays">
				  <input type="hidden" name="type" id="type" value="false">
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
			 <input id="prom" type="number" name="prom" class="form-control" placeholder="Unidad de tiempo en minutos" required>
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
@endif

		@if($mode == 'calendar')
				<div id='calendar'></div>

				@endif
</div>
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
				   document.getElementById("type").value = 'true';
				})
       $("#fixed").click(
				function(event) {
				   document.getElementById("menu1").style.display = "block";
				   document.getElementById("menu2").style.display = "none";
				    document.getElementById("btn1").style.display = "none";
				    document.getElementById("type").value = 'false';
				}) 
       $("#btn1").click(
				function(event) {
					var json = new Array();	
					var group =  $("#sel").val();
				if (!group) {
				document.getElementById("al").style.display = "block";	
				  $('.al').append('<div class="alert alert-danger alert-dismissible" id="danger"><b><i class="icon fa fa-warning"></i> No has seleccionado ningún día </b></div>');
					$("#danger").fadeTo(2000, 500).slideUp(500, function(){
					    $("#danger").alert('close');
					});
					} 
				if (!document.getElementById('prom').value) {
				document.getElementById("al").style.display = "block";	
				  $('.al').append('<div class="alert alert-danger alert-dismissible" id="danger2"><b><i class="icon fa fa-warning"></i> No has indicado la duración de la cita</b></div>');
					$("#danger2").fadeTo(2000, 500).slideUp(500, function(){
					    $("#danger2").alert('close');
					});
					}
					else {
				document.getElementById("al").style.display = "block";	
				var selects = group.toString().split(',');
				  $('.al').append('<div class="alert alert-info alert-dismissible" id="'+ selects[0] +'"><button type="button" class="clo'+selects[0]+' close" data-dismiss="alert" aria-hidden="true">×</button><b><i class="icon fa fa-info"></i> Grupo de horario pre-agregado</b> &nbsp; Días: <span>'+ group +'</span>. Hora inicial: '+ $("#timepicker2").val() +'. Hora Final: '+ $("#timepicker1").val() +'</div>');
				
					
				for(var z=0; z < selects.length; z++){
					json.push({"day" : selects[z], "start": $("#timepicker2").val() , "end" : $("#timepicker1").val(), "prom" : $("#prom").val() });
					$("#sel").val('"+ selects[z] +"').trigger('change');
					$("#sel option[value='"+ selects[z] +"']").attr('disabled','disabled');
				}
				
				if(!document.getElementById("vardays").value){
				document.getElementById("vardays").value = JSON.stringify(json);
			
				} else {
				//json.push(document.getElementById("vardays").value);
				var jsonend = json.concat(JSON.parse(document.getElementById("vardays").value));
				document.getElementById("vardays").value = JSON.stringify(jsonend);
				console.log(document.getElementById("vardays").value);
				}
					$("#sel").val('0').trigger('change.select2');
					$(".filter-option").html("Seleccione uno o varios días");
				$(".clo"+selects[0]).click(function () {
					var valor = $('#'+selects[0]+'').children('span').text();
					var unselect =	valor.toString().split(',');
					
					var jsonfind = document.getElementById("vardays").value;
					jsonfind = JSON.parse(jsonfind);
					for(var z=0; z < unselect.length; z++){
					
					$("#sel").val('"+ unselect[z] +"').trigger('change');
					$("#sel option[value='"+ unselect[z] +"']").removeAttr("disabled");
							for (var i =0; i < jsonfind.length; i++){
						   if (jsonfind[i].day === unselect[z]) {
						      jsonfind.splice(i,1);
						   }
						}
						document.getElementById("vardays").value = JSON.stringify(jsonfind);
							console.log(JSON.stringify(jsonfind))
					 $("al").alert('close');
				}
					});
				}
			
				}) 
</script>
<script type="text/javascript">
			 $(' input[type=checkbox]').each(function(event) {
						$("#sel").append('<option value="'+ $(this).val() +'">'+ $(this).val() +'</option>').trigger('change.select2');
		        })
	
	 $(function () {
        var optionhour = @php echo $workboard;  @endphp;
        console.log(optionhour);
        var hor = [];
          var resp = Array();
          var resp2 = Array();
         for(var y = 0; y < optionhour.length; y++){ 
                     resp = optionhour[y].split(":",2); 
                     resp2 = JSON.parse(optionhour[y].slice(4));
					 if(resp[0] == 'Dom'){
						for(var d = 0; d < resp2.length; d++){
						 hor.push({  
						 	title: 'Cita',
						    start:  resp2[d].slice(0,-3),
						    end:  resp2[d].slice(0,-3),        
						    dow: [7] // Repetir Lunes y Jueves
						});
                          }
                        }
                        if(resp[0] == 'Lun'){
						for(var d = 0; d < resp2.length; d++){
						 hor.push({  
						 	title: 'Cita',
						    start:  resp2[d].slice(0,-3),
						    end:  resp2[d].slice(0,-3),      
						    dow: [1] // Repetir Lunes y Jueves
						});
                          }
                        }
                        if(resp[0] == 'Mar'){
						     for(var d = 0; d < resp2.length; d++){
						 hor.push({  
						 	title: 'Cita',
						    start:  resp2[d].slice(0,-3),
						    end:  resp2[d].slice(0,-3),     
						    dow: [2] // Repetir Lunes y Jueves
						});
                          }
                        }
                        if(resp[0] == 'Mie'){
						     for(var d = 0; d < resp2.length; d++){
						 hor.push({  
						 	title: 'Cita',
						    start:  resp2[d].slice(0,-3),
						    end:  resp2[d].slice(0,-3),   
						    dow: [3] // Repetir Lunes y Jueves
						});
                          }
                        }
                        if(resp[0] == 'Jue'){
						     for(var d = 0; d < resp2.length; d++){
						 hor.push({  
						 	title: 'Cita',
						    start:  resp2[d].slice(0,-3),
						    end:  resp2[d].slice(0,-3),      
						    dow: [4] // Repetir Lunes y Jueves
						});
                          }
                        }
                        if(resp[0] == 'Vie'){
						     for(var d = 0; d < resp2.length; d++){
						 hor.push({  
						 	title: 'Cita',
						    start:  resp2[d].slice(0,-3),
						    end:  resp2[d].slice(0,-3),          
						    dow: [5] // Repetir Lunes y Jueves
						});
                          }
                        }
                        if(resp[0] == 'Sab'){
						     for(var d = 0; d < resp2.length; d++){
						 hor.push({  
						 	title: 'Cita',
						    start:  resp2[d].slice(0,-3),
						    end:  resp2[d].slice(0,-3),      
						    dow: [6] // Repetir Lunes y Jueves
						});
                          }
                        }
		}
		console.log(hor);

    $('#calendar').fullCalendar({
      lang: 'es',
      defaultView: 'agendaWeek',
      header: {
      	left:   '',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      defaultDate: '2018-02-19',
      navLinks: true, // can click day/week names to navigate views
      editable: true, // allow "more" link when too many events
      events: hor,
       eventColor: '#393838'
    });
});		 				
</script>

@stop