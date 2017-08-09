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

    		<form method="post" class="form-horizontal">
    			{{ csrf_field() }}

    			<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="firstname" class="col-sm-2 control-label">Nombre</label>
                	<div class="col-sm-10">
                  		<input type="text" name="firstname" class="form-control" id="firstname" value="{{ $firstname }}">
                	</div>
              	</div>


              	<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="lastname" class="col-sm-2 control-label">Apellidos</label>
                	<div class="col-sm-10">
                  		<input type="text" name="lastname" class="form-control" id="lastname" value="{{ $lastname }}">
                	</div>
              	</div>

              	<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email" class="col-sm-2 control-label">Corre electrónico</label>
                	<div class="col-sm-10">
                  		<input type="email" name="email" class="form-control" id="email" value="{{ $email }}">
                	</div>
              	</div>

              	<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="username" class="col-sm-2 control-label">Nombre de usuario</label>
                	<div class="col-sm-10">
                  		<input type="email" name="username" class="form-control" id="username" value="{{ $username }}">
                	</div>
              	</div>

              	<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="age" class="col-sm-2 control-label">Edad</label>
                	<div class="col-sm-10">
                  		<input type="text" name="age" class="form-control" id="age" value="{{ $age }}">
                	</div>
              	</div>

              	<div class="callout callout-default" align="right">
	                <b>Información personal</b>
	            </div>

	            <div class="form-group has-feedback {{ $errors->has('occupation') ? 'has-error' : '' }}">
                    <label for="occupation" class="col-sm-2 control-label">Ocupación</label>
                	<div class="col-sm-10">
                  		<input type="text" name="occupation" class="form-control" id="occupation" value="{{ $occupation }}">
                	</div>
              	</div>
              	
              	<div class="form-group has-feedback {{ $errors->has('gender') ? 'has-error' : '' }}">
                  <label for="gender" class="col-sm-2 control-label">Genero</label>
                  <div class="col-sm-10">
	                  <select class="form-control" name="gender">
	                    <option value="female">Femenino</option>
	                    <option value="male">Masculino</option>
	                  </select>
                  </div>
                </div>

                <div class="form-group has-feedback {{ $errors->has('scholarship') ? 'has-error' : '' }}">
                    <label for="scholarship" class="col-sm-2 control-label">Escolaridad</label>
                	<div class="col-sm-10">
                  		<input type="text" name="scholarship" class="form-control" id="scholarship" value="{{ $scholarship }}">
                	</div>
              	</div>

              	<div class="form-group has-feedback {{ $errors->has('maritalstatus') ? 'has-error' : '' }}">
                  <label for="maritalstatus" class="col-sm-2 control-label">Estado civil</label>
                  <div class="col-sm-10">
	                  <select class="form-control" name="maritalstatus">
	                    <option value="female">Soltero</option>
	                    <option value="male">Casado</option>
	                  </select>
                  </div>
                </div>

                <div class="form-group">
                	<label for="mobile" class="col-sm-2 control-label"># Móvil</label>
                	<div class="col-sm-10">
	                  	<input type="text" name="mobile" id="mobile" value="{{ $mobile }}" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                	</div>
                	<!-- /.input group -->
              	</div>

              	<div class="callout callout-default">
	                <b>Dirrección</b>
	            </div>
              	

    		</form>

	  	</div>
	  	<!-- /.box-body -->
	  	<div class="box-footer">
	    	aquí el botón que va a guardar los cambios.
	  	</div>
	  	<!-- box-footer -->
	</div>
	<!-- /.box -->
@stop