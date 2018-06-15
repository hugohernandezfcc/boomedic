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
                            <div align="center"><img src="" id="userp" class="img-circle" alt="User Image" style="height: 100px;"></img></div><br/>
                            <form enctype="multipart/form-data" action="{{ url('drAppointments/cancelAppointments') }}" method="post">
                            	<ul class="nav nav-stacked">
	                  				<li><a id="namep"></a></li>
	                  				<li><a id="age"></a></li>
	                  				<li><a id="lug"></a></li>
	                  				<li><a id="start"></a></li>
	                  				<li><button type="submit" id="canceled" style="display: none;" class="btn btn-secondary btn-flat btn-block">Cancelar cita</button></li>
	                			</ul>
	                		</form>	
	            				 <br/>
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
						    editable: false            						     
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
						    typ: '1'        						     
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
						    typ: '1'       						     
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