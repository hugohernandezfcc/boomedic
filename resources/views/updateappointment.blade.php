@extends('adminlte::page')

@section('title', 'Isco')

@section('content_header')
		    <style type="text/css">

					.custom-select {
					    -webkit-appearance: none;
					    -moz-appearance: none;
					    appearance: none;
					    height: 45px;
					    width: 500px;
					    padding: 10px 38px 10px 16px;
					    transition: border-color .1s ease-in-out,box-shadow .1s ease-in-out;
					    border: 1px solid #ddd;
					    border-radius: 15px;
					}
					.custom-select:hover {
					    border: 1px solid #999;
					    border-radius: 15px;
					}
					.custom-select:focus {
					    border: 1px solid #999;
					    border-radius: 15px;
					    box-shadow: 0 3px 5px 0 rgba(0,0,0,.2);
					    outline: none;
					}
					/* remove default arrow in IE */
					select::-ms-expand {
					    display:none;
					}
					.custom-select {
					    font-size: 16px;
					}
		    </style>
@stop

@section('content')

	<div class="box">
			  	<div class="box-header with-border">
				    <h3 class="box-title">Reagendar cita</h3>
			  	</div>
				<div class="box-body">
							<div align="center">
				@if($reschedule == false)
									    <h4>Haz indicado que no quieres volver a agendar esta cita</h4>
				@else					    
			    <h4>{!! $dr !!} ha cancelado tu cita, {!! $reason !!}  pero no te preocupes, te mostramos algunas alternativas para reagendar</h4>
			    <hr>
			    <br>   
			    @if($definitive == false)  
			    <form method="post" action="{{ url('drAppointments/editappointment') }}">
			    <input type="hidden" name="idc" value="{!! $idcite !!}">
			    <select class="custom-select" name="datenew">
			    	@if($array3)
			    <optgroup label="El resto del día de la cita">  
					       @foreach($array3 as $a3)
					       		<option value="{!! $a3 !!}">{!! \Carbon\Carbon::parse($a3)->format('d') !!} de {!! trans('adminlte::adminlte.'.\Carbon\Carbon::parse($a3)->format('F')) !!} {!! \Carbon\Carbon::parse($a3)->format('h:i A') !!}</option>
					       @endforeach
				</optgroup>
				   @endif	    	
			    <optgroup label="Próximos días después de la cita">  	
			    	@if($array)
					       @foreach($array as $a)
					       	   <option value="{!! $a !!}">{!! \Carbon\Carbon::parse($a)->format('d') !!} de {!! trans('adminlte::adminlte.'.\Carbon\Carbon::parse($a)->format('F')) !!} {!! \Carbon\Carbon::parse($a)->format('h:i A') !!}</option>
					       @endforeach
					@endif       
			     </optgroup>


			    <optgroup label="Semana siguiente mismo horario">  
			    	@if($array2)
					       @foreach($array2 as $a2) 
					       	   <option value="{!! $a2 !!}">{!! \Carbon\Carbon::parse($a2)->format('d') !!} de {!! trans('adminlte::adminlte.'.\Carbon\Carbon::parse($a2)->format('F')) !!} {!! \Carbon\Carbon::parse($a2)->format('h:i A') !!}</option>
					       @endforeach
					@endif       
				</optgroup>	       
		   
				</select>
				<hr>
			<table>
		    <tr>
		         <td>
		            <button type="submit" name="action" value="update" style="background-color: black;border-color: black;border: 2px solid black;padding: 5px;text-align: center; border-radius: 5px;display: block;color: #ffffff;font-size: 14px;">
		                 Reagendar ahora
		            </button>     
		        </td>
		        <td>
		        	<button type="submit" name="action" value="notreschedule" style="background-color: #333;border-color: #333;border: 2px solid #333;padding: 5px;text-align: center; border-radius: 5px;display: block;color: #ffffff;font-size: 14px;">
		                 No quiero reagendar
		            </button>     
		        </td>
		    </tr>
		</table>
				</form>
				@else
						Se ha cancelado definitivamente <br>
						@foreach($alldr as $all)
							{{ $all->specialty }} {{ $all->namedr }} <br>
						@endforeach
				@endif
			
		</div>
			@endif
	      </div>	  	
		</div>    


@stop