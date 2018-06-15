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
        <div class="col-md-3">
          <div class="box board">
            <div class="box-header with-border">
              <h4 class="box-title">Tablero de Eventos</h4>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
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
          <!-- /. box -->
          <div class="box board">
            <div class="box-header with-border">
              <h4 class="box-title">Crear Evento</h4>
                            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>  
            </div>
            <div class="box-body">
              <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                <ul class="fc-color-picker" id="color-chooser">
                  <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-gray" href="#"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-black" href="#"><i class="fa fa-square"></i></a></li>
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
              <!-- /input-group -->
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
  	 	$('.board').addClass('collapsed-box');
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
             element.append("<div class='btn-group'><button type='button' id='btnDelete"+ event._id +"' class='btn btn-xs btn-default' style='font-size: 10px;'>Cancel</button><button type='button' id='confirm"+ event._id +"' class='btn btn-xs btn-secondary' style='font-size: 10px;'>Confirmar</button></div>" );
             element.find("#btnDelete" + event._id).click(function(){
             $('#calendar').fullCalendar('removeEvents', function(searchEvent) {
                    return searchEvent._id === event._id;
                  });
             })
             element.find("#confirm" + event._id).click(function(){
                  console.log(event._id);
                  $('#calendar').fullCalendar('removeEvents', function(searchEvent) {
                    return searchEvent._id === event._id;
                  });
             })
           }
           },
		  eventClick: function(calEvent, jsEvent, view) {
		   	if(calEvent.typ != "2" ){
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
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
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
    })
  })			
</script>
@stop