@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')
<style type="text/css">

 #calendar {

    margin: 0 auto;
  }
  .fc-toolbar h2 {
    font-size: 20px;
    margin: 15px;
}
.fc-toolbar.fc-header-toolbar {
  margin-bottom: 0;
} 
.text-black{
	color: black !important;
}
.text-gray{
	color: #777 !important;
}
</style>

@stop

@section('content')
	<div class="box box-solid">
		<div class="box-header with-border">
		    <h3 class="box-title">Citas</h3>
		</div>
		<div class="box-body" style="overflow: auto;">


  		    <div class="modal fade" role="dialog" id="modalsuccess">
                    <div class="modal-dialog modal-sm">

                      <div class="modal-content">

                        <div class="modal-header" >
                          <!-- Tachecito para cerrar -->
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <div align="left"><label>Información general de la cita</label></div>
                        </div>
                            <div class="modal-body">
                            	<ul class="nav nav-stacked" id="normal">
                            		<div align="center"><img src="" id="userp" class="img-circle" alt="User Image" style="height: 100px;"></div><br>
	                  				<li><a id="namep"></a></li>
	                  				<li><a id="age"></a></li>
	                  				<li><a id="lug"></a></li>
	                  				<li><a id="start"></a></li>
	                  				<li><button id="canceled" style="display: none;" class="btn btn-default btn-flat btn-block" data-target="#reason" data-dismiss="modal" data-toggle="modal">Cancelar cita</button></li>
	                			</ul>	
	                			<ul class="nav nav-stacked" id="doc" style="display: none;">
	                				<li><a id="start2"></a></li>
	                				<li><a id="end"></a></li>
	                			</ul>
	            				 <br>
                            </div>
                        </div>
                      </div> 
            </div>
        <div class="modal fade" role="dialog" id="reason">
                    <div class="modal-dialog modal-sm">

                      <div class="modal-content">

                        <div class="modal-header" >
                          <!-- Tachecito para cerrar -->
                         <button type="button" class="close" data-target="#modalsuccess" data-dismiss="modal" data-toggle="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <div align="left"><label>Razones para cancelar la cita</label></div>
                        </div>
                            <div class="modal-body">

                            <form enctype="multipart/form-data" action="{{ url('drAppointments/cancelAppointment') }}" method="post">
                            	<input type="hidden" name="idcancel" id="idcancel">
                            	<ul class="nav nav-stacked">
                            		<li><div class="form-check">
										  <input class="form-check-input" type="radio" name="radioreason" id="radioreason" value="option1" checked>
										  <label class="form-check-label" for="radioreason">
										    Por compromiso profesional
										  </label>
										</div></li>
                            		<li><div class="form-check">
										  <input class="form-check-input" type="radio" name="radioreason" id="radioreason2" value="option2">
										  <label class="form-check-label" for="radioreason2">
										    Por motivo personal
										  </label>
										</div></li><br>
								    <li><button type="submit" class="btn btn-secondary btn-flat btn-block">Aceptar</button></li>		
                            	</ul>		
	                  			

	                		</form>	
	            				 <br>
                            </div>
                        </div>
                      </div> 
            </div>
            <!--Event Doc information and edit :) -->
            <div class="modal fade" role="dialog" id="eventDoc">
                    <div class="modal-dialog modal-sm">

                      <div class="modal-content">

                        <div class="modal-header" >
                          <!-- Tachecito para cerrar -->
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <div align="left"><i class="fa fa-edit"></i><label> Editar evento</label></div>
                        </div>
                            <div class="modal-body">
                             <form enctype="multipart/form-data" action="{{ url('drAppointments/editTimeBlocker') }}" method="post">
                              <ul class="nav nav-stacked">
                                <input type="hidden" name="idEdit" id="idEdit">
                                <li>Título <input type="text" class="form-control" name="titleEdit" id="titleEdit"></li>
                                <li>Inicio <input type="text" class="form-control" name="startEdit" id="startEdit"></li>
                                <li>Fin <input type="text" class="form-control" name="endEdit" id="endEdit"></li>
                                <br>
                                <li><div align="right"><button type="submit" class="btn btn-secondary btn-flat">Guardar edición</button><a id="deleteT" class="btn btn-default btn-flat" onclick ="return confirm('¿Seguro desea eliminarlo?')" style="display: inline !important">
                                <i class="fa fa-trash text-muted"></i> Eliminar evento</a></div></li>
                            </ul>
                            </form>
                            </div>
                        </div>
                      </div> 
            </div>
            <!--Event Doc information and edit -->
                  <div class="modal fade" role="dialog" id="confirm">
                    <div class="modal-dialog modal-sm">

                      <div class="modal-content">

                        <div class="modal-header" >
                          <!-- Tachecito para cerrar -->
                         <button type="button" class="close" data-dismiss="modal"  aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <div align="left"><i class="fa fa-edit"></i><label> Crear evento</label></div>
                        </div>
                            <div class="modal-body" style="padding-top: 0px !important">
                            <form enctype="multipart/form-data" action="{{ url('drAppointments/confirmTimeBlocker') }}" method="post" id="event1">
                              <input type="hidden" name="title" id="title">
                              <input type="hidden" name="color" id="color1">
                              <input type="hidden" name="t" id="t" value="1">
                              <ul class="nav nav-stacked">
                                <li>Inicio: <input type="text" name="start" id="startTime" class="form-control"></li>
                                <li>Final: <input type="text" name="end" id="endTime"  class="form-control"></li>
                                <li>Razones para apartar ese horario: <br><div class="form-check">
                                <input class="form-check-input" type="radio" name="radio" id="radio" value="professional commitment" checked>
                                <label class="form-check-label" for="radio">
                                 Compromiso profesional
                                </label>
                                </div></li>
                                <li><div class="form-check">
                                <input class="form-check-input" type="radio" name="radio" id="radio2" value="Isnt possible attended">
                                <label class="form-check-label" for="radio2">
                                  Es imposible atender
                                </label>
                              </div></li><br>
                              <li><button type="submit" class="btn btn-secondary btn-flat btn-block">Aceptar</button></li>    
                              </ul>   
                          </form> 
                            <form enctype="multipart/form-data" action="{{ url('drAppointments/confirmTimeBlocker') }}" method="post" id="event2" style="display: none;">
                              <input type="hidden" name="t" id="t" value="2">
                              <input type="hidden" name="title" id="title2">
                              <input type="hidden" name="color" id="color2">
                              <ul class="nav nav-stacked">
                                <li>Fecha: <input type="date" name="date" id="date" class="form-control"></li>
                                <li>Hora inicio: <input type="time" name="start" id="startTime" class="form-control"></li>
                                <li>Hora final: <input type="time" name="end" id="endTime"  class="form-control"></li>
                                <li>Razones para apartar ese horario: <br><div class="form-check">
                                <input class="form-check-input" type="radio" name="radio" id="radio" value="professional commitment" checked>
                                <label class="form-check-label" for="radio">
                                 Compromiso profesional
                                </label>
                                </div></li>
                                <li><div class="form-check">
                                <input class="form-check-input" type="radio" name="radio" id="radio2" value="Isnt possible attended">
                                <label class="form-check-label" for="radio2">
                                  Es imposible atender
                                </label>
                              </div></li><br>
                              <li><button type="submit" class="btn btn-secondary btn-flat btn-block">Aceptar</button></li>    
                              </ul>   
                          </form> 
                       <br>
                            </div>
                        </div>
                      </div> 
                  </div>  
        <div class="col-md-3">
          <!-- /. box -->
          <div class="box">
            <div class="box-header with-border">
              <h4 class="box-title">Crear Evento</h4>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool board" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>  
            </div>
            <div class="box-body">
              <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                <ul class="fc-color-picker" id="color-chooser">
                  <li><a style="color: #0073b7 !important"><i class="fa fa-square"></i></a></li>
                  <li><a style="color: #778899 !important"><i class="fa fa-square"></i></a></li>
                  <li><a style="color: #90EE90 !important"><i class="fa fa-square"></i></a></li>
                  <li><a style="color: #9ACD32 !important"><i class="fa fa-square"></i></a></li>
                  <li><a style="color: #B22222 !important"><i class="fa fa-square"></i></a></li>
                  <li><a style="color: #9370DB !important"><i class="fa fa-square"></i></a></li>
                  <li><a style="color: #E9967A !important"><i class="fa fa-square"></i></a></li>
                  <li><a style="color: #2F4F4F !important"><i class="fa fa-square"></i></a></li>
                </ul>
              </div>
              <!-- /btn-group -->
              <div class="input-group">
                <input id="new-event" type="text" class="form-control" placeholder="Título de evento">

                <div class="input-group-btn">
                  <button id="add-new-event" type="button" class="btn btn-primary btn-flat">Agregar</button>
                </div>
                <!-- /btn-group -->
              </div>
              <label class="text-red" style="font-size: 11px;">*Estos eventos apartaran tiempo en que no podrá dar citas</label>
              <!-- /input-group -->
            </div>
            <!--box table -->
            <div class="box ev">
            <div class="box-header with-border">
              <h4 class="box-title">Tablero de Eventos</h4>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool board" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>  
            </div>
            <div class="box-body">
              <!-- the events -->
              <div id="external-events">
                <div class="checkbox">
                  <label for="drop-remove">
                    <input type="checkbox" id="drop-remove">
                   Remover despues de mover
                  </label>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>

          </div>
        </div>
       <div class="col-md-9">
       	<div class="box box-solid">
       		 <div class="box-body">
				<div id='calendar'></div>
			</div>	
	    </div>
	   </div>
</div>
</div>	   
<script type="text/javascript">

  $(function () {
  	 if("@php echo $agent->isMobile(); @endphp"){
      $('.ev').css('display','none');
  	 	$('.board').click();
      $('#event1').css('display','none');
      $('#event2').css('display','block');
  	 }

 var optionhour = @php echo $array;  @endphp;
          var hor = Array();
          var resp = Array();
          var resp2 = Array();
          var resp3 = Array();
         for(var y = 0; y < optionhour.length; y++){ 
                     resp = optionhour[y].start;
                     resp2 = optionhour[y].user;
                     resp3 = optionhour[y].color;

          if(optionhour[y].type == "1"){
                if( optionhour[y].color == "gray"){
          
                hor.push({  
						 	  title: resp2,
						    start:  resp,
						    end:    optionhour[y].end['date'], 
						    color: '#bfbfbf',
						    photo: optionhour[y].photo,
						    age:  optionhour[y].age,
						    lug: optionhour[y].lug,
						    editable: false ,
                 typ: '4',
						    id: optionhour[y].id            						     
						});
                 }
                if( optionhour[y].color == "black"){
                hor.push({  
						 	  title: resp2,
						    start:  resp, 
						    end:    optionhour[y].end['date'], 
						    color: '#5ad6f5',   
						    photo: optionhour[y].photo,
						    age:  optionhour[y].age,
						    lug: optionhour[y].lug,
						    editable: false,
						    typ: '1',
						    id: optionhour[y].id           						     
						});
                 }
                if( optionhour[y].color == "blue"){
                hor.push({  
						 	  title: resp2,
						    start:  resp, 
						    end:    optionhour[y].end['date'], 
						    color: 'green',   
						    photo: optionhour[y].photo,
						    age:  optionhour[y].age,
						    lug: optionhour[y].lug,
						    editable: false,
						    typ: '1',
						    id: optionhour[y].id          						     
						});
                   }
                 }else{
                hor.push({  
                title:  optionhour[y].title,
                start:  resp, 
                end:    optionhour[y].end, 
                color:  optionhour[y].color,   
                editable: false,
                typ: '3',
                id: optionhour[y].id                           
            });

                 }
                          
                       
		}
		jQuery.noConflict(false);
    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()),
          typ: '2',
          // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0,  //  original position after the drag
          containment: 'document'
        })


      })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)


	$('#calendar').fullCalendar({
		
		header: {
			left: 'prev,next',
			center: 'title',
			right: 'month,basicWeek,agendaDay'
		},
		defaultView: 'agendaDay',
		editable: true,
		lang: 'es',
		contentHeight: 'auto',
		events: hor, 

      eventRender: function(event, element) { 
        if(event.typ == "2" ){
             element.find(".fc-bg").css("pointer-events","none");
             element.append("<div class='btn-group'><button type='button' id='btnDelete"+ event._id +"' class='btn btn-xs btn-default' style='font-size: 10px;'>Cancelar</button><button type='button' id='confirm"+ event._id +"' class='btn btn-xs btn-secondary' style='font-size: 10px;'>Confirmar</button></div>" );
             element.find("#btnDelete" + event._id).click(function(){
             $('#calendar').fullCalendar('removeEvents', function(searchEvent) {
                    return searchEvent._id === event._id;
                  });
             })
             element.find("#confirm" + event._id).click(function(){
                  console.log(event._id);
                  $('#startTime').val(moment(event.start).format('MM/DD/YYYY HH:mm'));
                   $('#title').val(event.title);
                   $('#color').val(event.color);
                  if(event.end){
                   $('#endTime').val(moment(event.end).format('MM/DD/YYYY HH:mm'));  
                  }else{
                   $('#endTime').val(''); 
                  }
                  jQuery("#confirm").modal('toggle');
             })
           }
           },
		  eventClick: function(calEvent, jsEvent, view) {
		   	if(calEvent.typ != "3"  && calEvent.typ != "2"){
		   	$('#userp').css('display','block');	
		  	$('#userp').attr('src', calEvent.photo + '?1');
		  	$('#namep').html('<label class="text-muted">Nombre: </label> '+ calEvent.title);
		  	$('#age').html('<label class="text-muted">Edad: </label> '+ calEvent.age);
		  	$('#lug').html('<label class="text-muted">Consultorio: </label> '+ calEvent.lug);
		  	$('#start').html('<label class="text-muted">Fecha: </label> '+ moment(calEvent.start).format('DD MMM YYYY h:mm A'));
		  	if(calEvent.typ == "1" ){
		  		$('#normal').css('display','block');
		  		$('#canceled').css('display','block');
		  		$('#doc').css('display','none');
		  		$('#idcancel').val(calEvent.id);
		  		console.log('hola' + calEvent.color);
		  	}else{
		  		$('#normal').css('display','block');
				$('#doc').css('display','none');		  		
		  		$('#canceled').css('display','none');	
		  	}
		  
		  	jQuery("#modalsuccess").modal('toggle');
      }if(calEvent.typ == "3"){
        $('#idEdit').val(calEvent.id);
        $('#titleEdit').val(calEvent.title);
        $('#deleteT').attr("href","{{ url('drAppointments/deleteBlocker') }}/" + calEvent.id);
        $('#startEdit').val(moment(calEvent.start).format('MM/DD/YYYY HH:mm'));
        $('#endEdit').val(moment(calEvent.end).format('MM/DD/YYYY HH:mm'));
         jQuery("#eventDoc").modal('toggle');
      }

	
		  },

      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject')

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject)

        // assign it the date that was reported
        copiedEventObject.start           = date
        copiedEventObject.end          =  moment(date).add(2, 'hours')
        copiedEventObject.allDay          = allDay
        copiedEventObject.backgroundColor = $(this).css('background-color')
        copiedEventObject.borderColor     = $(this).css('border-color')

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove()
        }

      }
    })

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
     if("@php echo $agent->isMobile(); @endphp"){
          jQuery("#confirm").modal('toggle');
          var val = $('#new-event').val();
          $('#title2').val(val);
          $('#color2').val(currColor);
         }else{
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      $('#color1').val(currColor);
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Add draggable funtionality
      init_events(event)

      //Remove event from text input
      $('#new-event').val('')
    }
    })
  })			
</script>
@stop