@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')
<style type="text/css">

 #calendar {
    max-width: 900px;
    margin: 0 auto;
  }
</style>
@stop

@section('content')

<div class="box">

  	<div class="box-header with-border">
	    <h3 class="box-title">Citas</h3>
	    
  	</div>
  	<div class="box-body">
		<div id='calendar'></div>
	</div>
<script type="text/javascript">
	
$(function() {

 var optionhour = @php echo $array;  @endphp;
        console.log(optionhour);
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
						    color: 'gray',   						     
						});
                 }
                if( optionhour[y].color == "black"){
                     hor.push({  
						 	title: resp2,
						    start:  resp, 
						    color: 'black',   						     
						});
                 }
                if( optionhour[y].color == "blue"){
                     hor.push({  
						 	title: resp2,
						    start:  resp, 
						    color: 'green',   						     
						});
                 }
                          
                       
		}
		console.log(hor);
/*	$('#calendar').fullCalendar( 'destroy' );*/
jQuery.noConflict(false);

	var todayDate = moment().startOf('day');
	var YM = todayDate.format('YYYY-MM');
	var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
	var TODAY = todayDate.format('YYYY-MM-DD');
	var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');
    
	$('#calendar').fullCalendar({
		
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay,listWeek'
		},
		editable: true,
		lang: 'es',
		events: hor /* [
			{
				title: 'All Day Event',
				start: YM + '-01'
			},
			{
				title: 'Long Event',
				start: YM + '-07',
				end: YM + '-10'
			},
			{
				id: 999,
				title: 'Repeating Event',
				start: YM + '-09T16:00:00'
			},
			{
				id: 999,
				title: 'Repeating Event',
				start: YM + '-16T16:00:00'
			},
			{
				title: 'Conference',
				start: YESTERDAY,
				end: TOMORROW
			},
			{
				title: 'Meeting',
				start: TODAY + 'T10:30:00',
				end: TODAY + 'T12:30:00'
			},
			{
				title: 'Lunch',
				start: TODAY + 'T12:00:00'
			},
			{
				title: 'Meeting',
				start: TODAY + 'T14:30:00'
			},
			{
				title: 'Happy Hour',
				start: TODAY + 'T17:30:00'
			},
			{
				title: 'Dinner',
				start: TODAY + 'T20:00:00'
			},
			{
				title: 'Birthday Party',
				start: TOMORROW + 'T07:00:00'
			},
			{
				title: 'Click for Google',
				url: 'http://google.com/',
				start: YM + '-28'
			}
		]*/
	});
});	 				
</script>
@stop