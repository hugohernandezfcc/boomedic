@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')
    <h1>Perfil de usuario</h1>
@stop

@section('content')
    <div class="box">
	  	<div class="box-header with-border">
		    <h3 class="box-title">Información</h3>
	    	<!-- /.box-tools -->
	  	</div>
	  	<!-- /.box-header -->
	  	<div class="box-body">
	  		@if ($status == "In Progress")
	  			<div class="callout callout-success">
	                <h4>Ya casi estamos listos {{ $firstname }} !!!</h4>

	                <p>Confirma y completa la información que esta debajo</p>
	            </div>
    		@endif

    		<form method="post">
    			{{ csrf_field() }}

    			<div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nombre</label>
                	<div class="col-sm-10">
                  		<input type="text" name="firstname" class="form-control" id="firstname" value="{{ $firstname }}">
                	</div>
              	</div>


              	<div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Apellidos</label>
                	<div class="col-sm-10">
                  		<input type="text" name="lastname" class="form-control" id="lastname" value="{{ $lastname }}">
                	</div>
              	</div>

              	<div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Corre electrónico</label>
                	<div class="col-sm-10">
                  		<input type="email" name="email" class="form-control" id="email" value="{{ $email }}">
                	</div>
              	</div>

              	<div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nombre de usuario</label>
                	<div class="col-sm-10">
                  		<input type="email" name="username" class="form-control" id="username" value="{{ $username }}">
                	</div>
              	</div>

              	<div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Edad</label>
                	<div class="col-sm-10">
                  		<input type="text" name="age" class="form-control" id="age" value="{{ $age }}">
                	</div>
              	</div>

    		</form>

	    	aquí van a ir los campos
	  	</div>
	  	<!-- /.box-body -->
	  	<div class="box-footer">
	    	aquí el botón que va a guardar los cambios.
	  	</div>
	  	<!-- box-footer -->
	</div>
	<!-- /.box -->
@stop