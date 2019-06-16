@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')
    <!-- <h1>Perfil de usuario</h1> -->
    <style type="text/css">
.accordion-toggle {
  position: relative;
}
.accordion-toggle::before,
.accordion-toggle::after {
  content: '';
  display: block;
  position: absolute;
  top: 50%;
  left: -18px;
  width: 12px;
  height: 4px;
  margin-top: -2px;
  background-color: #585858;
  -webkit-transform-origin: 50% 50%;
  -ms-transform-origin: 50% 50%;
  transform-origin: 50% 50%;
  -webkit-transition: all 0.25s;
  transition: all 0.25s;
}
.accordion-toggle::before {
  -webkit-transform: rotate(-90deg);
  -ms-transform: rotate(-90deg);
  transform: rotate(-90deg);
  opacity: 0;
}
.accordion-toggle.collapsed::before {
  -webkit-transform: rotate(0deg);
  -ms-transform: rotate(0deg);
  transform: rotate(0deg);
  opacity: 1;
}
.accordion-toggle.collapsed::after {
  -webkit-transform: rotate(-90deg);
  -ms-transform: rotate(-90deg);
  transform: rotate(-90deg);
}
			.dropzone  {
			     min-height: 10px !important; 
			    border-style: dotted  !important;
			    /* background: white; */
			    padding: 5px !important;
			}
			.dropzone .gen .dz-message {
			    margin: 1em 0 !important;
			}


			.modal-content-2 {
			    position: relative;
			    background-color: transparent;
			    -webkit-background-clip: padding-box;
			    background-clip: padding-box;
			    color: white;
			    margin-top: 50%;
			    width: 100%;
			}
      #mapAddressUser{
        position: relative;
        width: 95%;
        z-index: 30;
      }
		.cut{
		  text-overflow:ellipsis;
		  white-space:nowrap; 
		  overflow:hidden; 
		}
		.container {
		  position: relative;
		  width: 90%;
		}

		/* Make the image responsive */
		.container img {
		  width: 80%;
		  height: auto;
		}

		/* Style the button and place it in the middle of the container/image */
		.container .btn {
		  position: absolute;
		  top: -5%;
		  left: 78%;
		}
		.btn-circle {
		  width: 40px;
		  height: 40px;
		  text-align: center;
		  padding: 6px 0;
		  font-size: 16px;
		  line-height: 1.428571429;
		  border-radius: 19px;
		}


    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
	<script type="text/javascript">
			Dropzone.options.myAwesomeDropzone = { 
			 
			 // set following configuration
			 	paramName: "file",
			    maxFiles: 1,
			    acceptedFiles: "image/*",
			    addRemoveLinks: true,
			    dictRemoveFile: "Eliminar",
			    dictCancelUpload: "Cancel",
			    dictDefaultMessage: "Arraste y suelte una nueva foto de perfil...",
			     success: function(file, response){
				        //alert(response);
				 $('#loadingmodal').modal({backdrop: 'static', keyboard: false})
				  setTimeout(function(){ 
				  	$('#loadingmodal').modal('toggle');
				  	window.location.reload(true);
				  },21000);
				     	}
			    //autoProcessQueue : false 
			 };
			Dropzone.options.myDropzone = { 
			 
			 // set following configuration
			 	paramName: "file",
			    maxFiles: 1,
			    acceptedFiles: "image/*",
			    addRemoveLinks: true,
			    dictRemoveFile: "Eliminar",
			    dictCancelUpload: "Cancel",
			    dictDefaultMessage: "",
			     success: function(file, response){
				        //alert(response);
				 $('#loadingmodal').modal({backdrop: 'static', keyboard: false})
				  setTimeout(function(){ 
				  	$('#loadingmodal').modal('toggle');
				  	window.location.reload(true);
				  },21000);
				     	}
			    //autoProcessQueue : false 
			 };
			 var val = "@php echo session()->get('val'); @endphp";
			 		if(val == "true"){
			 		setTimeout(function() {
			 			$('#modal').modal({backdrop: 'static', keyboard: false})
					}, 1000);	
				}
				    
	</script>
	  	<div id="loadingmodal" class="modal fade" role="dialog" style="background: rgba(0, 0, 0, 0.8);">
		    <div class="modal-dialog">
		        <div class="modal-content-2">
		        	<div align="center">
						<h1><i class="fa fa-refresh fa-spin"></i><br/>Cargando...</h1><br/><h4>(Esto podría tardar unos segundos)</h4>
		          	</div>
		        </div>
		    </div>
	 	</div>

	  	<!-- /.box-header -->
	
	  		@if( !empty($status) )
  			 	<div class="box box-body">	

					<div id="modal" class="modal fade" role="dialog">
					              <div class="modal-dialog">
					                <!-- Modal content-->
					                <div class="modal-content" >
					                  <div class="modal-header">   
					                    <label for="recorte">Recorte de imagen:</label>
					                  </div>
					                  <div class="modal-body" >

					                        <div align="center">
											<img src="{{ $photo }}?{{ \Carbon\Carbon::now()->format('h:i') }}" id="target">	
					                    
					                           <form enctype="multipart/form-data" action="/user/cropProfile/{{$userId}}" method="post" onsubmit="return checkCoords();">
					                           	{{ csrf_field() }}
					                           	<input type="hidden" id="x" name="x">
												<input type="hidden" id="y" name="y">
												<input type="hidden" id="w" name="w">
												<input type="hidden" id="h" name="h"><br/>
						                        <span class="input-group-btn">
						                        <input type="submit" class="btn btn-secondary btn-block btn-flat" value="Guardar"></span>
					                          </form>
					                       </div>
					                     <!--<input id="submit" type="button" value="Buscar" class="map-marker text-muted">-->
					                  </div>
					                </div>
					              </div>
					 </div>

		  		@if ($status == "In Progress")
		  			<div class="callout callout-success">
		                <h4>Ya casi estamos listos {{ $firstname }} !!!</h4>

		                <p>Confirma y completa la información que esta debajo</p>
		            </div>
	    		@endif
          <label class="col-sm-2 control-label" style="text-align: right;">Foto de perfil</label><br>

          @if($agent->isMobile())
	    		<div class="row" align="center">
	    		
	    		<div class="col-sm-3" align="center">
	    			@if($photo == '')
			    	 	@if($gender == 'male') 
			    	 		<div class="container"><img class="profile-user-img img-responsive img-circle" src="{{ asset('profile-42914_640.png') }}" alt="User Image"  style="width:150px; height: 150px;"><form enctype="multipart/form-data" action="/user/updateProfile/{{$userId}}"  method="post" class="dropzone btn btn-default btn-circle" id="myDropzone" >{{ csrf_field() }}<span class="fa fa-pencil" ></span></form>
			    	 		</div>
			    	 	@endif
			    	 	@if($gender == 'female') 
			    	 		<div class="container"><img class="profile-user-img img-responsive img-circle" src="{{ asset('profile-female.png') }}" alt="User Image"  style="width:150px; height: 150px;"><form enctype="multipart/form-data" action="/user/updateProfile/{{$userId}}"  method="post" class="dropzone btn btn-default btn-circle" id="myDropzone" >{{ csrf_field() }}<span class="fa fa-pencil" ></span></form>
			    	 		</div>
			    	 	@endif
			    	 	 @if($gender == 'other' || $gender == '') 
			    	 		<div class="container"><img class="profile-user-img img-responsive img-circle" src="{{ asset('profile-other.png') }}" alt="User Image"  style="width:150px; height: 150px;"><form enctype="multipart/form-data" action="/user/updateProfile/{{$userId}}"  method="post" class="dropzone btn btn-default btn-circle" id="myDropzone" >{{ csrf_field() }}<span class="fa fa-pencil" ></span></form>
			    	 		</div>
		    	 	@endif
					@else
					@php 
					  $imagen = getimagesize($photo);    //Sacamos la información
			          $width = $imagen[0];              //Ancho
			          $height = $imagen[1];  
			          if($height > '500' || $width > '500'){
			            $height = $height / 2.8;
			            $width = $width / 2.8;
			        }
			        if($height > '800' || $width > '800'){
			            $height = $height / 4;
			            $width = $width / 4;
			        }
			      if($height > '800' || $width > '1200'){
			            $height = $height / 6;
			            $width = $width / 6;
			        }
			          if($height < '400' || $width < '400'){
			            $height = $height / 1.6;
			            $width = $width / 1.6;
			        }
					@endphp
					
						<div class="container"><img src="{{ $photo }}?{{ \Carbon\Carbon::now()->format('h:i') }}" style="width:{{ $width }}px; height: {{ $height }}px;" ><form enctype="multipart/form-data" action="/user/updateProfile/{{$userId}}"  method="post" class="dropzone btn btn-default btn-circle" id="myDropzone" >{{ csrf_field() }}<span class="fa fa-pencil" ></span></form>

			    	 	</div>
			    			
			    	@endif 
	    			
	    		</div>
	    	</div>
          @else
	    		<div class="row" align="center">
	    		
	    		<div class="col-sm-3" align="center">
	    			@if($photo == '')
			    	 	@if($gender == 'male') 
			    	 		<img class="profile-user-img img-responsive img-circle" src="{{ asset('profile-42914_640.png') }}" alt="User Image"  style="width:150px; height: 150px;">
			    	 	@endif
			    	 	@if($gender == 'female') 
			    	 		<img class="profile-user-img img-responsive img-circle" src="{{ asset('profile-female.png') }}" alt="User Image"  style="width:150px; height: 150px;">
			    	 	@endif
			    	 	 @if($gender == 'other' || $gender == '') 
			    	 		<img class="profile-user-img img-responsive img-circle" src="{{ asset('profile-other.png') }}" alt="User Image"  style="width:150px; height: 150px;">
		    	 	@endif
					@else
					@php 
					  $imagen = getimagesize($photo);    //Sacamos la información
			          $width = $imagen[0];              //Ancho
			          $height = $imagen[1];  
			          if($height > '500' || $width > '500'){
			            $height = $height / 2.8;
			            $width = $width / 2.8;
			        }
			        if($height > '800' || $width > '800'){
			            $height = $height / 4;
			            $width = $width / 4;
			        }
			      if($height > '800' || $width > '1200'){
			            $height = $height / 6;
			            $width = $width / 6;
			        }
			          if($height < '400' || $width < '400'){
			            $height = $height / 1.6;
			            $width = $width / 1.6;
			        }
					@endphp
						<img src="{{ $photo }}?{{ \Carbon\Carbon::now()->format('h:i') }}" style="width:{{ $width }}px; height: {{ $height }}px;" >			
			    	@endif 
	    			
	    		</div>
	    		<div class="col-sm-2" align="center" style="width: 240px;"><form enctype="multipart/form-data" action="/user/updateProfile/{{$userId}}" method="post" class="dropzone gen" id="myAwesomeDropzone">{{ csrf_field() }}</form></div>
	    	</div>
	    	@endif 
	    	<br/>
	    		<form enctype="multipart/form-data" action="/user/update/{{$userId}}" method="post" class="form-horizontal">
	    			{{ csrf_field() }}

	    			<div class="form-group has-feedback {{ $errors->has('firstname') ? 'has-error' : '' }}">
	                    <label for="firstname" class="col-sm-2 control-label">Nombre</label>
	                	<div class="col-sm-10">
	                  		<input type="text" name="firstname" class="form-control" id="firstname" value="{{ $firstname }}">
	                	</div>
	              	</div>

	              	<div class="form-group has-feedback {{ $errors->has('lastname') ? 'has-error' : '' }}">
	                    <label for="lastname" class="col-sm-2 control-label">Apellidos</label>
	                	<div class="col-sm-10">
	                  		<input type="text" name="lastname" class="form-control" id="lastname" value="{{ $lastname }}">
	                	</div>
	              	</div>

	              	<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
	                    <label for="email" class="col-sm-2 control-label">Correo electrónico</label>
	                	<div class="col-sm-10">
	                  		<input type="email" name="email" class="form-control" id="email" value="{{ $email }}">
	                	</div>
	              	</div>

	              	<div class="form-group has-feedback {{ $errors->has('username') ? 'has-error' : '' }}">
	                    <label for="username" class="col-sm-2 control-label">Nombre de usuario</label>
	                	<div class="col-sm-10">
	                  		<input type="email" name="username" class="form-control" id="username" value="{{ $username }}">
	                	</div>
	              	</div>

	              	<div class="form-group has-feedback {{ $errors->has('age') ? 'has-error' : '' }}">
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
		                    <option value="female" {{ ($gender == 'female') ? 'selected' : '' }}>Femenino</option>
		                    <option value="male"   {{ ($gender == 'male')   ? 'selected' : '' }}>Masculino</option>
		                    <option value="other"   {{ ($gender == 'other')   ? 'selected' : '' }}>Otro</option>
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
		                    <option value="single"  {{ ($maritalstatus == 'single') ? 'selected' : '' }}>Soltero</option>
		                    <option value="married" {{ ($maritalstatus == 'married') ? 'selected' : '' }}>Casado</option>
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

	              	<div class="callout callout-default" align="right">
		                <b>Dirección</b>
		            </div>
		            <div class="form-group">
		            	<div class="col-sm-2" align="right">
		            		&nbsp;
		            	</div>
		            	<div id="locationField" class="col-sm-10" align="right">
					      	<input id="autocomplete" class="form-control" placeholder="Ingresa tu dirección" onFocus="geolocate()" type="text"/>
					    </div>
		            </div>

		            <div align="right">
		            	<div class="row" style="width: 90%;" >
			            	<div class="col-sm-6">
			            		<input type="text" value="{{ $street }}" class="form-control" name="street" id="street_number"  placeholder="Número de calle" {{ ( empty( $street ) ) ? 'disabled="true"' : '' }}/>
			            	</div>
			            	<div class="col-sm-6">
			            		<input type="text" value="{{ $colony }}" class="form-control" name="colony" id="route" {{ ( empty( $colony ) ) ? 'disabled="true"' : '' }}/>
			            	</div>
			            </div>
						<br />              	
		              	<div class="row" style="width: 90%;" >
			            	<div class="col-sm-6">
			            		<input type="text" value="{{ $delegation }}" class="form-control" name="delegation" id="locality" {{ ( empty( $delegation ) ) ? 'disabled="true"' : '' }} placeholder="Ciudad"/>
			            	</div>
			            	<div class="col-sm-6">
			            		<input type="text" value="{{ $state }}" class="form-control" name="state" id="administrative_area_level_1" placeholder="Estado" {{ ( empty( $state ) ) ? 'disabled="true"' : '' }}/>
			            	</div>
			            </div>
						<br />
			            <div class="row" style="width: 90%;" >
			            	<div class="col-sm-6">
			            		<input type="text" value="{{ $postalcode }}" class="form-control" name="postalcode" id="postal_code" {{ ( empty( $postalcode ) ) ? 'disabled="true"' : '' }} placeholder="Código postal"/>
			            	</div>
			            	<div class="col-sm-6">
			            		<input type="text" value="{{ $country }}" class="form-control" name="country" id="country" placeholder="País" {{ ( empty( $country ) ) ? 'disabled="true"' : '' }}/>
			            	</div>
			            </div>
		            </div>

		            <input type="text" style="visibility: hidden;" name="latitude" id="latitudeFend" />
		            <input type="text" style="visibility: hidden;" name="longitude" id="longitudeFend" />
		            <br/>
		            <!-- /.box-body -->
				  	<div class="box-footer">
				    	<div class="row">

				    		@if ($status == "In Progress")
					    		<div class="col-sm-4">
					            	&nbsp;
					            </div>
					    		<div class="col-sm-4">
						    		<button type="submit" class="btn btn-secondary btn-block btn-flat">
						                Guardar
						            </button>
					            </div>
					            <div class="col-sm-4">
					            	&nbsp;
					            </div>
					       	@else 
					       		<div class="col-sm-4">
					            	&nbsp;
					            </div>
					       		<div class="col-sm-4">
						    		<button type="submit" class="btn btn-secondary btn-block btn-flat">
						                Guardar
						            </button>
					            </div>
					    		<div class="col-sm-4">
					    			<a href="{{ url()->previous() }}" class="btn btn-default btn-block btn-flat">
						                Cancelar
						            </a>
					            </div>
					            <div class="col-sm-4">
					            	&nbsp;
					            </div>
							@endif
							
				    	</div>
				  	</div>
				  	<!-- box-footer -->
			</form>
	    	</div>	

	    	@else

						<!-- Charge Alert whether payment was processed or not -->
							@if(session()->has('message'))

								@if(session()->has('success'))
							    <div class="alert alert-success alert-dismissable fade in" role="alert" id="alertMessageAfterSaveAction">
							    	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									    <span aria-hidden="true">&times;</span>
									</button>
									<strong>¡Familiar Agregado!</strong><br/><br/>		
							        {{ session()->get('message') }}
							    </div>
							   
								@elseif(session()->has('error'))
								 <div class="alert alert-danger alert-dismissable fade in" role="alert" id="alertMessageAfterSaveAction">
								 	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									    <span aria-hidden="true">&times;</span>
									</button>
									<strong>¡Hubo un error al agregar tu familiar!</strong><br/><br/>		
							 		<!-- Error codes are defined within the adminlte -->
							          {{ session()->get('message') }}
							    </div>
							   @endif

							@endif
						<!-- Here ends the code for the alert -->

    <section class="content">

      	<div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-default">
            <div class="box-body box-profile">

            	@if($photo == '')
            	    @if($gender == 'male') 
		    	 		<img class="profile-user-img img-responsive img-circle" src="{{ asset('profile-42914_640.png') }}" alt="User Image"  style="width:150px; height: 150px;">
		    	 	@endif
		    	 	@if($gender == 'female') 
		    	 		<img class="profile-user-img img-responsive img-circle" src="{{ asset('profile-female.png') }}" alt="User Image"  style="width:150px; height: 150px;">
		    	 	@endif
		    	 	 @if($gender == 'other' || $gender == '') 
		    	 		<img class="profile-user-img img-responsive img-circle" src="{{ asset('profile-other.png') }}" alt="User Image"  style="width:150px; height: 150px;">
		    	 	@endif
		    	 		
					@else
						@php 
						  $imagen = getimagesize($photo);    //Sacamos la información
				          $width = $imagen[0];              //Ancho
				          $height = $imagen[1];  

				          if($height > '500' || $width > '500'){
				            $height = $height / 2.8;
				            $width = $width / 2.8;
				        }
				        if($height > '800' || $width > '800'){
				            $height = $height / 4;
				            $width = $width / 4;
				        }
				      if($height > '800' || $width > '1200'){
				            $height = $height / 6;
				            $width = $width / 6;
				        }


				          if($height < '400' || $width < '400'){
				            $height = $height / 1.6;
				            $width = $width / 1.6;
				        }

						@endphp
						<img class="profile-user-img img-responsive img-circle" src="{{ $photo }}?{{ \Carbon\Carbon::now()->format('h:i') }}" style="width:{{ $width }}px; height: {{ $height }}px;" >			
			    	@endif 

              	

              	<h3 class="profile-username text-center">{{ $firstname }}</h3>

              	@if($gender == "female")
              		<p class="text-muted text-center">{{ trans('adminlte::adminlte.female') }}</p>
	            @endif
	            @if($gender == "male")
	            	<p class="text-muted text-center">{{ trans('adminlte::adminlte.male') }}</p>
	            @endif
	            @if($gender == "other")
	            	<p class="text-muted text-center">{{ trans('adminlte::adminlte.other') }}</p>
	            @endif

              

	            <ul class="list-group list-group-unbordered">
	                <li class="list-group-item">
	                 	<b>Familiares</b> <a class="pull-right">{{ $countfamily }}</a>
	                </li>
	                <li class="list-group-item">
	                  	<b>No. de citas</b> <a class="pull-right">{{ $countappo }}</a>
	                </li>
	                <li class="list-group-item">
	                  	<b>No. métodos de pago</b> <a class="pull-right">{{ $countpayments }}</a>
	                </li>
	            </ul>

			    <form action="/user/edit/complete" method="get" id="form_profile">
			    	{{ csrf_field() }}
					<input type="hidden" name="id" value="{{ $userId }}">
              		<button type="submit" class="btn btn-secondary btn-block btn-flat">Editar perfil</button>
				</form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Información adicional</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i>Educación / Ocupación</strong>

              <p class="text-muted">
              	@if(empty($scholarship) && empty($occupation))
                	<a href="#">Agregar información</a>
                @elseif(empty($scholarship) && !empty($occupation))
                	<a href="#">Agregar Escolaridad</a> / {{ $occupation }}
                @elseif(!empty($scholarship) && empty($occupation))
                	{{ $scholarship }} / <a href="#">Agregar ocupación</a>
                @elseif(!empty($scholarship) && !empty($occupation))
                	{{ $scholarship }} / {{ $occupation }}
                @endif
              </p>

              <hr style="margin-top: 10px !important; margin-bottom: 10px !important;">


              <strong><i class="fa fa-pencil margin-r-5"></i> Prescripción médica actual</strong>

              <p>
                <span class="label label-info">{{$current_prescription}}</span>
              </p>

              <hr style="margin-top: 10px !important; margin-bottom: 10px !important;">

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Miembro desde</strong>
              <p>{{$created_at}}</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        	<div class="col-md-9">
    			@include('tabs.tabshorizontal', [
        			'usedOnUserType' => "patient", 
        			'latitude'		 => $latitude,
					'longitude'		 => $longitude,
					'nodes'			 => $nodes,
					'username2' 	 =>	$username,
					'email2' 		 =>	$email,
					'age' 			 =>	$age,
					'mobile' 		 =>	$mobile,
					'updated_at' 	 =>	$updated_at,
					'gender' 		 =>	$gender,
					'maritalstatus'  =>	$maritalstatus
        			]
        		)
        	</div>
    	</div>
    </section>
@endif
    <script type="text/javascript">
			
		$(document).ready(function(){

			$("#nameFamily").on("keyup", function(e) {
				$("#alertMessageAfterSaveAction").fadeTo(3000, 500).fadeOut(500, function(){
				    $("#alertMessageAfterSaveAction").fadeOut(500);
				});
						
				if(e.which == 32) {
					$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
					var nameFamily = document.getElementById('nameFamily').value;
                    $.ajax({     
                        type: "POST",                 
                        url: "{{ url('user/userSearch') }}",  
                        data: { "search" : nameFamily}, 
                        dataType: 'json',                
                        success: function(data){

	                             if(data.length == 0){
	                             	document.getElementById("resp").innerHTML = "No existe usuario registrado...";
	                             	
									}else {

										document.getElementById("resp").innerHTML = "Coincidencias: ";
										for(var i= 0; i < data.length; i++){
		                     				if(data[i]['profile_photo'] == null){
		                     						if(data[i]['gender'] == 'female')
		                     							var photo =  "{{ asset('profile-female.png') }}";
		                     						if(data[i]['gender'] == 'male')
		                     							var photo =  "{{ asset('profile-42914_640.png') }}";
		                     						if(data[i]['gender'] == 'other')
		                     							var photo =  "{{ asset('profile-other.png') }}";				                     						

		                     				}
		                     				$('#resp').append('<div style="margin-left:5%;"><img src="'+ photo +'" class="img-circle" style="width:25px; height:25px;"><a data-id="'+ data[i]['id'] +'" data-value="'+ data[i]['name'] +'" onclick="fun(this);" class="btn text-muted" style="text-align: left;white-space: normal;">'+ data[i]['name'] +'</a></div>');
	                     				}
	                             	} 
									}
	                            
	                         });
		            } else{
		        	 var value = $(this).val().toLowerCase();
			   		 $("#resp div").filter(function() {
					    	  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
					    });
		            }
						  });

					                   
					});

			window.onload = function(){

				        if("@php echo $agent->isMobile(); @endphp"){
				            height = window.screen.availHeight;
				                       // alert("Altura: "+height);
				                        //Para Android Puro
				            if(height >= 1000 && height <= 1300){
				                var h = height*0.30;
				                height = Math.floor(h);
				            }else if(height >=1800){ //para android con capa personalizada
				              height -= 1600;
				            }else
				            {
				              height -=315; //android avierto desde chrome
				            }
				        }else{
				          height = window.screen.availHeight-315;
				        }
				       @if(!empty($latitude) && !empty($longitude))
				        document.getElementById('mapAddressUser').setAttribute("style","height:" + height + "px");
				        @endif


					@if(!empty($status))
    				initAutocomplete();
    				@endif
    				@if(empty($status) && !empty($latitude))
    					initMapAddressUser();
					@endif
    			};
		      // This example displays an address form, using the autocomplete feature
		      // of the Google Places API to help users fill in the information.

		      // This example requires the Places library. Include the libraries=places
		      // parameter when you first load the API. For example:
		      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

		      var placeSearch, autocomplete;
		      var componentForm = {
		        street_number: 'short_name',
		        route: 'long_name',
		        locality: 'long_name',
		        administrative_area_level_1: 'short_name',
		        country: 'long_name',
		        postal_code: 'short_name'
		      };

		      function initAutocomplete() {
		        // Create the autocomplete object, restricting the search to geographical
		        // location types.
		        autocomplete = new google.maps.places.Autocomplete(
		         (document.getElementById('autocomplete')),
		            {types: ['geocode']});

								        // When the user selects an address from the dropdown, populate the address
		        // fields in the form.
		        autocomplete.addListener('place_changed', fillInAddress);

		      }

		      function fillInAddress() {
		        // Get the place details from the autocomplete object.
		        var place = autocomplete.getPlace();

		        for (var component in componentForm) {
		          document.getElementById(component).value = '';
		          document.getElementById(component).disabled = false;
		        }
		            document.getElementById('latitudeFend').value = place.geometry.location.lat();
		            document.getElementById('longitudeFend').value = place.geometry.location.lng();
		        // Get each component of the address from the place details
		        // and fill the corresponding field on the form.
		        for (var i = 0; i < place.address_components.length; i++) {
		          var addressType = place.address_components[i].types[0];
		          if (componentForm[addressType]) {
		            var val = place.address_components[i][componentForm[addressType]];
		            document.getElementById(addressType).value = val;
		          }
		        }
		      }

		      // Bias the autocomplete object to the user's geographical location,
		      // as supplied by the browser's 'navigator.geolocation' object.
		      function geolocate() {

		        if (navigator.geolocation) {
		          navigator.geolocation.getCurrentPosition(function(position) {
		            var geolocation = {
		              lat: position.coords.latitude,
		              lng: position.coords.longitude
		            };
		            document.getElementById('latitudeFend').value = geolocation.lat; 
		            document.getElementById('longitudeFend').value = geolocation.lng;
		            var circle = new google.maps.Circle({
		              center: geolocation,
		              radius: position.coords.accuracy
		            });
		            autocomplete.setBounds(circle.getBounds());
		          });
		        }
		      }	

		    </script>

	    @if( empty($status) )

	    	<script type="text/javascript">
	    	

	    		var counter = -1;
		      	function initMapAddressUser() {	
			      	if(!counter > 0){
			      		var map = new google.maps.Map(document.getElementById('mapAddressUser'), {
				          zoom: 14,
				          center: {lat: {{ $latitude }}  , lng: {{ $longitude }} }
				        });


				        var image = "https://s3.amazonaws.com/abiliasf/markerCasa.png";
				        
				        var beachMarker = new google.maps.Marker({
				          position: {lat: {{ $latitude }}  , lng: {{ $longitude }} },
				          map: map,
				          icon: image
				        });
				    }
			        counter++;
		      	
		      }
	    	</script>
		@endif

		<link rel="stylesheet" href="{{ asset('css/jquery.Jcrop.css') }}" type="text/css" />
		<script type="text/javascript" src="{{ asset('js/jquery.color.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/jquery.Jcrop.js') }}"></script>
		<script type="text/javascript">


					$('#target').Jcrop({
						    aspectRatio: 1,  
					        boxWidth: 300,
					        boxHeight: 300,
					        setSelect: [0,0,300,300],
					        bgOpacity: .9,
					         bgColor:     'black',
					        onSelect: updateCoords,
					        onChange: updateCoords
					    }, function(){
					        CropAPI = this;
					    });

			     function updateCoords(c){
			      $('#x').val(c.x);
			      $('#y').val(c.y);
			      $('#w').val(c.w);
			      $('#h').val(c.h);
			     };
			     function checkCoords()
			    {
			      if (parseInt($('#w').val())>0) return true;
			      alert('Seleccione una coordenada para subir');
			      return false;
			    };

	    </script>



@stop

