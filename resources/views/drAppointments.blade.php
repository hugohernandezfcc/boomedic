@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')
<style type="text/css">

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
	    <h3 class="box-title">Citas</h3>
  	</div>
  	<div class="box-body">
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
                            <div align="center"><img src="" id="userp" class="img-circle" alt="User Image" style="height: 100px;"></div><br>
                            	<ul class="nav nav-stacked">
	                  				<li><a id="namep"></a></li>
	                  				<li><a id="age"></a></li>
	                  				<li><a id="lug"></a></li>
	                  				<li><a id="start"></a></li>
	                  				<li><button id="canceled" style="display: none;" class="btn btn-default btn-flat btn-block" data-target="#reason" data-dismiss="modal" data-toggle="modal">Cancelar cita</button></li>
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
		<div id='calendar'></div>
	</div>
<script type="text/javascript">
	
$(function() {

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


/*	$('#calendar').fullCalendar( 'destroy' );*/
jQuery.noConflict(false);

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
		  eventClick: function(calEvent, jsEvent, view) {
		  	$('#userp').attr('src', calEvent.photo + '?1');
		  	$('#namep').html('<label class="text-muted">Nombre: </label> '+ calEvent.title);
		  	$('#age').html('<label class="text-muted">Edad: </label> '+ calEvent.age);
		  	$('#lug').html('<label class="text-muted">Consultorio: </label> '+ calEvent.lug);
		  	$('#start').html('<label class="text-muted">Fecha: </label> '+ moment(calEvent.start).format('DD MMM YYYY h:mm A'));
		  	if(calEvent.typ == "1" ){
		  		$('#canceled').css('display','block');
		  		$('#idcancel').val(calEvent.id);
		  		console.log('hola' + calEvent.color);
		  	}else{
		  		$('#canceled').css('display','none');	
		  	}
		  	jQuery("#modalsuccess").modal('toggle');
	
		  }
	});

});	 				
</script>
@stop