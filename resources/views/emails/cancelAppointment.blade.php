<!DOCTYPE html>
<html lang="es">
	<head>
	    <meta charset="utf-8">
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
					.btn-group, .btn-group-vertical {
					    position: relative;
					    display: inline-block;
					    vertical-align: middle;
					}
					.btn-secondary {
					    color: #ffffff;
					    background-color: #000000;
					    border-color: #555;
					}
					.btn-group-vertical>.btn, .btn-group-vertical>.btn-group, .btn-group-vertical>.btn-group>.btn {
					    display: block;
					    float: none;
					    width: 100%;
					    max-width: 100%;
					}
					.btn-group-vertical>.btn, .btn-group>.btn {
					    position: relative;
					}
					.btn-group-vertical>.btn:first-child:not(:last-child) {
					    border-top-left-radius: 4px;
					    border-top-right-radius: 4px;
					    border-bottom-right-radius: 0;
					    border-bottom-left-radius: 0;
					}
					.btn {
					    display: inline-block;
					    padding: 6px 12px;
					    margin-bottom: 0;
					    font-size: 14px;
					    font-weight: 400;
					    line-height: 1.42857143;
					    text-align: center;
					    white-space: nowrap;
					    vertical-align: middle;
					    -ms-touch-action: manipulation;
					    touch-action: manipulation;
					    cursor: pointer;
					    -webkit-user-select: none;
					    -moz-user-select: none;
					    -ms-user-select: none;
					    user-select: none;
					    background-image: none;
					    border: 1px solid transparent;
					    border-radius: 4px;
					}
					a {
						    background-color: transparent;
						    text-decoration: none;
						}
		    </style>
	</head>
	<body>
	<div align="center">

	    <hr><br>   
	    @if($definitive == false)  
	    	    <h2>{!! $dr !!} ha cancelado tu cita, {!! $reason !!}  pero no te preocupes, te mostramos algunas alternativas para reagendar</h2>
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
				   @if($alldr)
				<div class="box-header with-border">
				    <h3 class="box-title">{!! $dr !!} ha cancelado tu cita {!! $reason !!} de forma definitiva, te mostramos otros doctores de la misma especialidad cercanos a tu cita para que puedas reagendar</h3>
			  	</div>
			  	<div class="box-body">
					<div align="left">
						<div class="btn-group-vertical">
						@foreach($alldr as $all)
						<a href="{{ url('medicalconsultations') }}" class="btn btn-secondary" style="text-align: left;"><i class="fa fa-user-md"></i>&nbsp; {{ $all['name'] }} a {{ $all['distance'] }} km(s)</a>
						@endforeach
					</div>
				   @else 
						<div class="box-header with-border">
						    <h3 class="box-title">{!! $dr !!} ha cancelado tu cita {!! $reason !!} de forma definitiva. Buscamos otros doctores con la misma especialidad en la zona pero no tuvimos éxito, te recomendamos ir a la página y agendar con otro doctor buscando en diferentes zonas</h3>
					  	</div><br>
					  	<a href="{{ url('medicalconsultations') }}" class="btn btn-secondary" style="text-align: left;"><i class="fa fa-user-md"></i>Ir a Isco</a>
				   @endif 		
				@endif
	
</div>
	</body>
</html>