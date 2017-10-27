@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

@stop

@section('content')
    
    <br/>


	<div class="lockscreen-item" style="margin: 10px 0 30px auto;">
	    <!-- lockscreen image -->
	    <div class="lockscreen-image">
	      <img src="https://adminlte.io/themes/AdminLTE/dist/img/user1-128x128.jpg" alt="User Image">
	    </div>
	    <!-- /.lockscreen-image -->

	    <!-- lockscreen credentials (contains the form) -->
	    <form class="lockscreen-credentials" action="create" method="get">
	    	{{ csrf_field() }}
	      	<div class="input-group">
	        	<div class="form-control">{{ $username }}</div>
	        	<input type="hidden" name="id" value="{{ $userId }}">

	      	</div>
	    </form>
	    <!-- /.lockscreen credentials -->
	</div>

	<div class="box">
	  	<div class="box-header with-border">
		    <h3 class="box-title">Generador de Receta Médica</h3>
	  	</div>
		<div class="box-body">

            
            @if($mode == 'Index')
            	<form id="FOO" method="POST" action="PDFGenerator">
            		<div class="row">
	                  	<label class="col-sm-2 control-label">Centro Médico</label>
		 					<div class="col-sm-10">
		                  		<input type="text" name="Centromedico" class="form-control" id="Centromedico">
		                	</div>
	                  	</div><br/>
               		<div class="row">
	                  	<label class="col-sm-2 control-label">Médico</label>
		 					<div class="col-sm-4">
		                  		<input type="text" name="medico" class="form-control" id="medico">
		                	</div>
	                  	     	<label class="col-sm-1 control-label">Especialidad</label>
	                  	
		 					<div class="col-sm-2">
		                  		<input type="text" name="Especialidad" class="form-control" id="Especialidad">
		                	</div>
		                	 	<label class="col-sm-1 control-label">Nro Licencia</label>
	                  	
		 					<div class="col-sm-2">
		                  		<input type="text" name="Licencia" class="form-control" id="Licencia">
		                	</div>
	                  	</div><hr/>
	                  	<div class="col-sm-12" style="background-color:#C4C4C4;"></div><hr/>
	                  	<div class="row">
	                  	<label class="col-sm-2 control-label">Paciente</label>
		 					<div class="col-sm-10">
		                  		<input type="text" name="Paciente" class="form-control" id="Paciente">
		                	</div>
	                  	</div><br/>
	                  	<div class="form-group"> <!-- Submit Button -->
					      <button type="submit" class="btn btn-primary">Generar</button>
					    </div>
                </form>
            @endif

        </div>	  	
	</div>
@stop