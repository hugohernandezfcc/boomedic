@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

@stop

@section('content')
	<div class="box">
	  	<div class="box-header with-border">
		    <h3 class="box-title">Atención previa</h3>
	  	</div>
	  	<div class="box-body">
	  		<p align="justify">
	  			El presente apartado pretende que puedas enriquecer la información que deseas ver al momento de atender al paciente.
	  		</p>
		</div>
	</div>	

	<div class="row" >
    	<div class="col-sm-3">
    		<div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
	            <div class="widget-user-header bg-teal">

	              	<div class="widget-user-image">
	                	<img class="img-circle" src="https://s3.amazonaws.com/abiliasf/profile-42914_640.png" alt="User Avatar">
	              	</div>
	              
	              	<h3 class="widget-user-username">Nombre de paciente</h3>
	              	<h5 class="widget-user-desc">Fecha de nacimiento</h5>
	            </div>
            	<div class="box-footer no-padding">
              		<ul class="nav nav-stacked">
                		<li id="itemPersonalInformation"><a >Información personal </a></li>
                		<li id="itemmedicalRecord"><a >Expediente médico </a></li>
                		<li id="itemclinicHistory"><a >Historia clínica </a></li>
                		<li id="itemPersonalInformation"><a >Historia clínica por familiar </a></li>
                		<li id="itemPersonalInformation"><a >Hábitos	 </a></li>
              		</ul>
            	</div>
          	</div>
    	</div> 
    	<div class="col-sm-9">

    		@foreach ($keys as $information)

    			@if($loop->first)
		    		<div class="box" id="{{$information}}" style="display: block;">
					  	<div class="box-header with-border">
						    <h3 class="box-title">
						    	<div class="input-group input-group-sm" style="width: 150%;">
					                <input class="form-control" type="text">
				                    <span class="input-group-btn">
				                      	<button type="button" class="btn btn-info btn-default">Agregar</button>
				                    </span>
					            </div>
						    </h3>
					  	</div>
					  	<div class="box-body">
					  		<ul class="nav nav-stacked">
						  		@for ($i = 0; $i < count($info[$information]); $i++)
									<li><a >{{ $info[$information][$i] }} </a></li>
								@endfor  
							</ul>
						</div>
					</div>
				@else
					<div class="box" id="{{$information}}" style="display: block;">
					  	<div class="box-header with-border">
						    <h3 class="box-title">Solicitudes de información</h3>
					  	</div>
					  	<div class="box-body">
					  		<ul class="nav nav-stacked">
						  		@for ($i = 0; $i < count($info[$information]); $i++)
									<li><a >{{ $info[$information][$i] }} </a></li>
								@endfor  
							</ul>
						</div>
					</div>
				@endif
			@endforeach

    	</div>
    </div>
@stop