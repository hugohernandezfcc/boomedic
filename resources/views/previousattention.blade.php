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
	            <div class="widget-user-header bg-yellow">
	              	<div class="widget-user-image">
	                	<img class="img-circle" src="https://s3.amazonaws.com/abiliasf/3.jpg?10:37" alt="User Avatar">
	              	</div>
	              
	              	<h3 class="widget-user-username">Nadia Carmichael</h3>
	              	<h5 class="widget-user-desc">Lead Developer</h5>
	            </div>
            	<div class="box-footer no-padding">
              		<ul class="nav nav-stacked">
                		<li><a href="#">Projects <span class="pull-right badge bg-blue">31</span></a></li>
                		<li><a href="#">Tasks <span class="pull-right badge bg-aqua">5</span></a></li>
                		<li><a href="#">Completed Projects <span class="pull-right badge bg-green">12</span></a></li>
                		<li><a href="#">Followers <span class="pull-right badge bg-red">842</span></a></li>
              		</ul>
            	</div>
          	</div>



    		<!-- <div class="box">
			  	<div class="box-header with-border">
				    <h3 class="box-title">Paciente</h3>
			  	</div>
			  	<div class="box-body">

			  		<img class="profile-user-img img-responsive img-circle" src="https://s3.amazonaws.com/abiliasf/3.jpg?10:37" alt="User profile picture">

			  		<p class="text-muted text-center">De cada paciente podras ver:</p>
			  		<ul class="list-group list-group-unbordered">
		                <li class="list-group-item">
		                  	<b>Información personal</b> 
		                </li>
		                <li class="list-group-item">
		                  	<b>Expediente médico</b> 
		                </li>
		                <li class="list-group-item">
		                  	<b>Historia clínica</b>
		                </li>
	              	</ul>

				</div>
			</div> -->	
    	</div>
    	<div class="col-sm-9">
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
    	</div>
    </div>
@stop