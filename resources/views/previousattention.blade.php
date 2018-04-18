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
    		<div class="box">
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
		                  	<ul class="list-group list-group-unbordered">
		                  		<li class="list-group-item"><b>Alergias</b></li>
		                  		<li class="list-group-item"><b>Antecedentes familiares</b></li>
		                  		<li class="list-group-item"><b>Antecedentes mórbidos</b></li>
		                  		<li class="list-group-item"><b>Habitos</b></li>
		                  	</ul>
		                </li>
	              	</ul>

				</div>
			</div>	
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