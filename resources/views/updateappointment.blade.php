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
			    <h2>{!! $dr !!} ha cancelado tu cita, {!! $reason !!}  pero no te preocupes, te mostramos algunas alternativas para reagendar</h2>
			    <hr>
			      {!! $definitive !!}  <br>   
			    @if($definitive == false)  
			    <form method="post" action="{{ url('drAppointments/editappointment') }}">
			    <input type="hidden" name="idc" value="{!! $idcite !!}">
			    <select class="custom-select" name="datenew">
			    	@if($array3)
			    <optgroup label="El resto del día de la cita">  
					       @foreach($array3 as $a3)
					       		<option value="{!! $a3 !!}">{!! $a3 !!} </option>
					       @endforeach
				</optgroup>
				   @endif	    	
			    <optgroup label="Próximos días después de la cita">  	
			    	@if($array)
					       @foreach($array as $a)
					       	   <option value="{!! $a !!}"> {!! $a !!} </option>
					       @endforeach
					@endif       
			     </optgroup>


			    <optgroup label="Semana siguiente mismo horario">  
			    	@if($array2)
					       @foreach($array2 as $a2) 
					       	   <option value="{!! $a2 !!}"> {!! $a2 !!} </option>
					       @endforeach
					@endif       
				</optgroup>	       
		   
				</select>
				<hr>
			<table>
		    <tr>
		         <td>
		            <button type="submit" style="background-color: black;border-color: black;border: 2px solid black;padding: 5px;text-align: center; border-radius: 5px;display: block;color: #ffffff;font-size: 14px;">
		                 Reagendar ahora
		            </button>     
		        </td>
		        <td style="background-color: #333;border-color: #333;border: 2px solid #333;padding: 5px;text-align: center; border-radius: 5px;">
		            <a style="display: block;color: #ffffff;font-size: 14px;text-decoration: none;"  href="{{ url('') }}">
		                 No quiero reagendar
		            </a>
		        </td>
		    </tr>
		</table>
				</form>
				@else
						Se ha cancelado definitivamente
				@endif
			
		</div>
	      </div>	  	
		</div>    


@stop