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
    max-width: 98%;
    min-width: 98%;
    margin: 0 auto;
  }
   #calendar2 {
    max-width: 98%;
    min-width: 98%;
    margin: 0 auto;
  }
 #calendar {
    max-width: 98%;
    min-width: 98%;
    margin: 0 auto;
  }
  .fc-toolbar h2 {
    font-size: 20px;
    margin: 15px;
}
.fc-toolbar.fc-header-toolbar {
  margin-bottom: 0;
} 


</style>
@stop

@section('content')

<div class="box">

  	<div class="box-header with-border">
	    <h3 class="box-title">Horario habilitados para citas médicas</h3>
	    
  	</div>
  	<div class="box-body">
@if($mode != 'calendar')	
        <div id="div1">
			<div id="button" class="pull-right">Configurar Horarios &nbsp;<button class="btn btn-flag btn-default btn-xs"><i class="text-muted fa fa-cog" onclick="config();"></button></i></div><br/>
			<div align="center"><h4>Horario actual</h4></div>
          <!-- Custom Tabs -->

              	@if(count($workboard) > 0)
                   <div id='calendar2'></div>
                   @else
                   <div class="alert alert-dismissible text-red"><b><i class="icon fa fa-warning"></i> No tienes horario agregado</b>
					</div>
				@endif


              </div>
                <div id="config1"  style="display: none">
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
			  	    <form action="{{ url('/workboardDr/create') }}/{{ $work }}" method="post" class="form-horizontal" id="formwork">
			  	    	{{ csrf_field() }}
				<div class="form-group col-sm-12" id="menu1">

			  		

			  	    	<div class="col-sm-4"><label>Seleccione los días de la semana que dará consulta con una jornada fija</label></div>
			  	<div class="col-sm-8">	
			  		<div data-toggle="buttons" class="btn-group">

			  			<label for="Dom" class="btn btn-default">
							<input type="checkbox" value="Dom" name="day[]" id="Dom" autocomplete="off">
							<span class="glyphicon glyphicon-ok"></span>
							 <b>Domingo</b>
						</label>		
				  		<label for="Lun" class="btn btn-default">
							<input type="checkbox" value="Lun" name="day[]" id="Lun" autocomplete="off">
							<span class="glyphicon glyphicon-ok"></span>
							<b>Lunes</b>
						</label>
						<label for="Mar" class="btn btn-default">
							<input type="checkbox" value="Mar" name="day[]" id="Mar" autocomplete="off">
							<span class="glyphicon glyphicon-ok"></span>
							<b>Martes</b>
						</label>
						<label for="Mie"  class="btn btn-default">
							<input type="checkbox" value="Mie" name="day[]" id="Mier" autocomplete="off">
							<span class="glyphicon glyphicon-ok"></span>
							<b>Miercoles</b>
						</label>
						<label for="Jue" class="btn btn-default">
							<input type="checkbox" value="Jue" name="day[]" id="Jue" autocomplete="off">
							<span class="glyphicon glyphicon-ok"></span>
							<b>Jueves</b>
						</label>
						<label for="Vie" class="btn btn-default">
							<input type="checkbox" value="Vie" name="day[]" id="Vie" autocomplete="off">
							<span class="glyphicon glyphicon-ok"></span>
							<b>Viernes</b>
						</label>
						<label for="Sab" class="btn btn-default">
							<input type="checkbox" value="Sab" name="day[]" id="Sab" autocomplete="off">
							<span class="glyphicon glyphicon-ok"></span>
							<b>Sábado</b>
						</label>				
					</div>
				</div>
			</div>
			<div class="form-group col-sm-12" id="menu1mob" style="display: none;" align="center">
				<a data-target="#modalmobile" data-toggle="modal" class="btn btn-default btn-block">Seleccione los días que dará consulta</a>

			<!-- Modal button mobile-->
                 <div class="modal fade" role="dialog" id="modalmobile">
                    <div class="modal-dialog" style="width: 50% !important">
                      <div class="modal-content">
                        <div class="modal-header" style="padding-bottom: 0 !important;">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                            <div class="modal-body">
			                         <div data-toggle="buttons" class="btn-group-vertical" align="center" style="display: inline !important;">

						  			<label for="Dom" class="btn btn-default btn-block">
										<input type="checkbox" value="Dom" name="day[]" id="Dom" autocomplete="off">
										<span class="glyphicon glyphicon-ok"></span>
										 <b>Domingo</b>
									</label>		
							  		<label for="Lun" class="btn btn-default btn-block">
										<input type="checkbox" value="Lun" name="day[]" id="Lun" autocomplete="off">
										<span class="glyphicon glyphicon-ok"></span>
										<b>Lunes</b>
									</label>
									<label for="Mar" class="btn btn-default btn-block">
										<input type="checkbox" value="Mar" name="day[]" id="Mar" autocomplete="off">
										<span class="glyphicon glyphicon-ok"></span>
										<b>Martes</b>
									</label>
									<label for="Mie"  class="btn btn-default btn-block">
										<input type="checkbox" value="Mie" name="day[]" id="Mier" autocomplete="off">
										<span class="glyphicon glyphicon-ok"></span>
										<b>Miercoles</b>
									</label>
									<label for="Jue" class="btn btn-default btn-block">
										<input type="checkbox" value="Jue" name="day[]" id="Jue" autocomplete="off">
										<span class="glyphicon glyphicon-ok"></span>
										<b>Jueves</b>
									</label>
									<label for="Vie" class="btn btn-default btn-block">
										<input type="checkbox" value="Vie" name="day[]" id="Vie" autocomplete="off">
										<span class="glyphicon glyphicon-ok"></span>
										<b>Viernes</b>
									</label>
									<label for="Sab" class="btn btn-default btn-block">
										<input type="checkbox" value="Sab" name="day[]" id="Sab" autocomplete="off">
										<span class="glyphicon glyphicon-ok"></span>
										<b>Sábado</b>
									</label>				
								</div>
                            </div>
                        </div>
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
          <!-- nav-tabs-custom -->

				</div>
              </div>
			@endif
  		

		@if($mode == 'calendar')
				<div id='calendar'></div>

		</div>
		</div>
		@endif
<script type="text/javascript">

	function config(){
		$('#config1').show();
		$('#div1').hide();
	}

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
    $("#var").click(function(event) {
				   document.getElementById("menu2").style.display = "block";
				    document.getElementById("btn1").style.display = "block";
				   document.getElementById("menu1").style.display = "none";
				   document.getElementById("menu1mob").style.display = "none";
				   document.getElementById("type").value = 'true';
				})
       $("#fixed").click(
				function(event) {
				if("@php echo $agent->isMobile(); @endphp"){
				   document.getElementById("menu1mob").style.display = "block";
					}else{
					document.getElementById("menu1").style.display = "block";
					}
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
					 $("al").alert('close');
				}
					});
				}
			
				}) 
</script>

<script type="text/javascript">
			 $('#menu1 input[type=checkbox]').each(function(event) {
						$("#sel").append('<option value="'+ $(this).val() +'">'+ $(this).val() +'</option>').trigger('change.select2');
		        });
	
$(function() {

        var optionhour = @php echo $workboard2;  @endphp;
          var hor = Array();
          var resp = Array();
          var resp2 = Array();
         for(var y = 0; y < optionhour.length; y++){ 
                     resp = optionhour[y].split(":",2); 
                     resp2 = JSON.parse(optionhour[y].slice(4));
					 if(resp[0] == 'Dom'){
						for(var d = 0; d < resp2.length; d++){
						var da = '[0]';	
						if(resp2[d].slice(0,-3) != 'asueto '){	
						 hor.push({  
						 	title: 'Espacio disponible para cita',
						    start:  resp2[d].slice(0,-3),  
						    dow: da // Repetir Lunes y Jueves

						});
                          } else {
                          	hor.push({  
						 	title: 'Asueto',
						    start:  '00:00', 
						    end: '00:'+ resp2[d].slice(8),
						    color: 'green',   						     
						    dow: da // Repetir Lunes y Jueves
						});
                          }
                     	 }
                        }
                        if(resp[0] == 'Lun'){
						for(var d = 0; d < resp2.length; d++){
							var da = '[1]';		
						if(resp2[d].slice(0,-3) != 'asueto '){	
						 hor.push({  
						 	title: 'Espacio disponible para cita',
						    start:  resp2[d].slice(0,-3),  
						    dow: da // Repetir Lunes y Jueves
						});
                          } else {
                          	hor.push({  
						 	title: 'Asueto',
						    start:  '00:00',
						    end: '00:'+ resp2[d].slice(8),
						    color: 'green',   						      
						    dow: da // Repetir Lunes y Jueves
						});
                          }
                          }
                        }
                        if(resp[0] == 'Mar'){
						     for(var d = 0; d < resp2.length; d++){
						     	var da = '[2]';		
						 if(resp2[d].slice(0,-3) != 'asueto '){	
						 hor.push({  
						 	title: 'Espacio disponible para cita',
						    start:  resp2[d].slice(0,-3),  
						    dow: da // Repetir Lunes y Jueves
						});
                          } else {
                          	hor.push({  
						 	title: 'Asueto',
						    start:  '00:00', 
						    end: '00:'+ resp2[d].slice(8), 
						    color: 'green',  					     
						    dow: da // Repetir Lunes y Jueves
						});
                          }
                          }
                        }
                        if(resp[0] == 'Mie'){
						     for(var d = 0; d < resp2.length; d++){
						     	var da = '[3]';		
						 if(resp2[d].slice(0,-3) != 'asueto '){	
						 hor.push({  
						 	title: 'Espacio disponible para cita',
						    start:  resp2[d].slice(0,-3),  
						    dow: da // Repetir Lunes y Jueves
						});
                          } else {
                          	hor.push({  
						 	title: 'Asueto',
						    start:  '00:00', 
						    end: '00:'+ resp2[d].slice(8), 
						    color: 'green',  						     
						    dow: da // Repetir Lunes y Jueves
						});
                          }
                          }
                        }
                        if(resp[0] == 'Jue'){
						     for(var d = 0; d < resp2.length; d++){
						     	var da = '[4]';		
						if(resp2[d].slice(0,-3) != 'asueto '){	
						 hor.push({  
						 	title: 'Espacio disponible para cita',
						    start:  resp2[d].slice(0,-3),  
						    dow: da // Repetir Lunes y Jueves
						});
                          } else {
                          	hor.push({  
						 	title: 'Asueto',
						    start:  '00:00',  
						    end: '00:'+ resp2[d].slice(8), 
						    color: 'green',  
						    dow: da // Repetir Lunes y Jueves
						});
                          }
                          }
                        }
                        if(resp[0] == 'Vie'){
						     for(var d = 0; d < resp2.length; d++){
						     	var da = '[5]';		
						 if(resp2[d].slice(0,-3) != 'asueto '){	
						 hor.push({  
						 	title: 'Espacio disponible para cita',
						    start:  resp2[d].slice(0,-3), 
						    dow: da // Repetir Lunes y Jueves
						});
                          } else {
                          	hor.push({  
						 	title: 'Asueto',
						    start:  '00:00',
						    end: '00:'+ resp2[d].slice(8),
						    color: 'green', 
						    dow: da // Repetir Lunes y Jueves
						});
                          }
                          }
                        }
                        if(resp[0] == 'Sab'){
						     for(var d = 0; d < resp2.length; d++){
						     	var da = '[6]';		
						if(resp2[d].slice(0,-3) != 'asueto '){	
						 hor.push({  
						 	title: 'Espacio disponible para cita',
						    start:  resp2[d].slice(0,-3), 
						    dow: da // Repetir Lunes y Jueves
						});
                          } else {
                          	hor.push({  
						 	title: 'Asueto',
						    start:  '00:00',
						    end: '00:'+ resp2[d].slice(8),
						    color: 'green',
						    dow: da // Repetir Lunes y Jueves
						});
                          }
                          }
                        }
		}

/*	$('#calendar').fullCalendar( 'destroy' );*/
jQuery.noConflict(false);


	$('#calendar').fullCalendar({
		
		header: {
			left: 'prev,next',
			center: 'title',
			right: 'month,basicWeek,listWeek'
		},
		contentHeight: 'auto',
		defaultView: 'basicWeek',
		editable: false,
		lang: 'es',
		events: hor	
	});
		$('#calendar2').fullCalendar({
		
		header: {
			left: 'prev,next',
			center: 'title',
			right: 'month,basicWeek,listWeek'
		},
		contentHeight: 'auto',
		defaultView: 'basicWeek',
		editable: false,
		lang: 'es',
		events: hor	
	});

		 if("@php echo $agent->isMobile(); @endphp"){
		  $("#menu1mob").css("display", "block");
          $("#menu1").css("display", "none");
		 }else{
		  $("#menu1").css("display", "block");
          $("#menu1mob").css("display", "none");
		 }
})

</script>

@stop