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
	  		@if($reschedule == false)
	  			<h3 class="box-title">Haz indicado que no quieres volver a agendar esta cita</h3>
	  		@else	
	  		@if($definitive != false)  
		    <h3 class="box-title">Cancelación definitiva</h3>
		    @else
		    <h3 class="box-title">Cancelación con fechas alternativas</h3>
		    @endif
		    @endif
	  	</div>
		<div class="box-body">

					    <div style="font-size: 12px; font-style: oblique;">Fecha de Cita: {{ $date }} </div> <br/>
			                	<div class="col-xs-12 col-md-8">
			                			<div class="col-sm-4"><b>Dr(a):</b></div>
			                			<div class="col-sm-8" align="left">{!! $dr !!}</div>
			                	</div>
			                <br/>
			                <div class="col-xs-12 col-md-8">
			                			<div class="col-sm-4"><b>Motivo de cancelación:</b></div>
			                			<div class="col-sm-8" align="left">{!! $reason !!}</div>
			                </div>
			                <br/>
			                <div class="col-xs-12 col-md-8">
			                			<div class="col-sm-4"><b>Especialidad:</b></div>
			                			<div class="col-sm-8" align="left">{!! $specialty !!}</div>
			                </div>
		</div>	  	
	</div>
@if($reschedule != false)	
	<div class="box">						    
			    @if($definitive == false)  
			    <div class="box-body">
							<div align="center">
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
				
			  	<div class="box-body">
				<div class="box-header with-border">
				    <h3 class="box-title">Médicos disponibles en la misma zona</h3>
			  	</div>
			  	   @if(count($alldr) > 0)
			            	<table id="paymentmethodtable" class="display responsive nowrap table" cellspacing="0" width="100%">
				                <thead>
				                    <tr>
				                    	 <th></th>
				                        <th class="all">Médico</th>
				                        <th class="desktop">Distancia apróx</th>
				                        <th class="desktop">Dirección</th>
				                    </tr>
				                </thead>

				                <tbody>
					     	@foreach($alldr as $all)
								     <tr>
								     	<td></td>
						             	<td><a href="{{ url('reSchedule') }}/{{ $all['idli'] }}-{{ $idcite}}" style="text-align: left;">{{ $all['name'] }}</a><br/></td>
						             	<td>{{ $all['distance'] }} km(s)<br/></td>
						             	<td>{{ $all['direction'] }}</td>
						             </tr>
			             	@endforeach
								<tbody>
				    	 </table>
				   @else 
						<div class="box-header with-border">
						    Lo sentimos, buscamos otros doctores con la misma especialidad en la zona pero no tuvimos éxito, te recomendamos ir a la página y agendar con otro doctor buscando en diferentes lugares...
					  	</div>
					  	<div align="right"><a href="{{ url('medicalconsultations') }}" class="btn btn-secondary" style="text-align: left;">Volver al Inicio</a></div>
				   @endif 		
				@endif
			
				</div>  	
		</div>    
			@endif

@stop