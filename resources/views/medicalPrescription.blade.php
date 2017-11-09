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
            	<form id="FOO" method="POST" action="PDFGenerator" target="_blank">
            		<div class="row">
	                  	<label class="col-sm-2 control-label">Centro Médico</label>
		 					<div class="col-sm-10">
		                  		<input type="text" name="clinic" class="form-control" id="clinic">
		                	</div>
	                  	</div><br/>
               		<div class="row">
	                  	     	<label class="col-sm-2 control-label">Especialidad</label>
	                  	
		 					<div class="col-sm-4">
		                  		<input type="text" name="Especialidad" class="form-control" id="Especialidad">
		                	</div>
		                	 	<label class="col-sm-1 control-label">Nro Licencia</label>
	                  	
		 					<div class="col-sm-5">
		                  		<input type="text" name="Licencia" class="form-control" id="Licencia">
		                	</div>
	                  	</div>
						<br/><br/>
	                  	<hr align="center" width="80%" style="background-color: #979797; height: 3px; border:none;"/>
	                  	<div class="row">
	                  	<label class="col-sm-2 control-label">Paciente</label>
		 					<div class="col-sm-8">
		                  		<input type="text" name="Paciente" class="form-control" id="Paciente">
		                	</div>
		                	<label class="col-sm-1 control-label">Edad</label>
		 					<div class="col-sm-1">
		                  		<input type="text" name="age" class="form-control" id="age">
		                	</div>
	                  	</div><br/>
	                  	<div class="row">
	                  	     	<label class="col-sm-1 control-label">Peso</label>
		 					<div class="col-sm-1">
		                  		<input type="text" name="peso" class="form-control" id="peso">
		                	</div>
		                	 	<label class="col-sm-1 control-label">Estatura</label>
		 					<div class="col-sm-1">
		                  		<input type="text" name="est" class="form-control" id="est">
		                	</div>
		                	 	<label class="col-sm-1 control-label">Teléfono</label>
	                  	
		 					<div class="col-sm-2">
		                  		<input type="text" name="mobileP" class="form-control" id="mobileP">
		                	</div>
		                	<label class="col-sm-1 control-label">Email</label>
	                  	
		 					<div class="col-sm-2">
		                  		<input type="text" name="email" class="form-control" id="email">
		                	</div>
		                	<label class="col-sm-1 control-label">Alergias</label>
		                	<div class="col-sm-1">
		                  		<select name="alergias" class="form-control select1">
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        		</select>
		                	</div>
	                  	</div>
	                  	<br/><hr align="center" width="80%" style="background-color: #979797; height: 3px; border:none;"/>
	                  	<div class="form-group" align="center"> <!-- Submit Button -->
					      <button type="submit"  class="btn btn-primary" style="background-color: #3E3D3D;">Generar</button>
					    </div>

                </form>

            @endif

        </div>	  	
	</div>
@stop