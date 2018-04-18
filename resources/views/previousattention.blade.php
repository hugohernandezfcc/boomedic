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
	                	<img class="img-circle" src="https://s3.amazonaws.com/abiliasf/3.jpg?10:37" alt="User Avatar">
	              	</div>
	              
	              	<h3 class="widget-user-username">Nombre de paciente</h3>
	              	<h5 class="widget-user-desc">Fecha de nacimiento</h5>
	            </div>
            	<div class="box-footer no-padding">
              		<ul class="nav nav-stacked">
                		<li><a href="#">Información personal </a></li>
                		<li><a href="#">Expediente médico </a></li>
                		<li><a href="#">Historia clínica </a></li>
                		<li><a href="#">Hábitos	 </a></li>
              		</ul>
            	</div>
          	</div>
    	</div>
    	<div class="col-sm-9">
    		<div class="box">
			  	<div class="box-header with-border">
				    <h3 class="box-title">Solicitudes de información</h3>
			  	</div>
			  	<div class="box-body">
			  		<p align="justify">
			  			El presente apartado pretende que puedas enriquecer la información que deseas ver al momento de atender al paciente.
			  		</p>
				</div>
			</div>	
    	</div>
    </div>
@stop