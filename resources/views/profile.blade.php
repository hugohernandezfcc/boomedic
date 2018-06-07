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
			.dropzone {
			     min-height: 10px !important; 
			    border-style: dotted  !important;
			    /* background: white; */
			     padding: 0 !important;
			}
			.dropzone .dz-message {
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
			 var val = "@php echo session()->get('val'); @endphp";
			 		if(val == "true"){

			 		setTimeout(function() {
			 			$('#modal').modal({backdrop: 'static', keyboard: false})
					}, 1000);	
				}

				    
	</script>

	@if( empty($status) )

    @include('headerprofile')
    <script type="text/javascript">
      //O si no lleva botón hacer el div "div_profile" invisible
      document.getElementById('labeltext').innerHTML = 'Editar';
      var elemento = document.getElementById("i_button");
      elemento.className = "fa fa-pencil text-muted";
      document.forms.form_profile.action = "/user/edit/complete";
    </script>

	@endif


 

    <div class="box">
	  	<div class="box-header with-border">
		    <h3 class="box-title">Información de usuario</h3>
	    	<!-- /.box-tools -->
	  	</div>
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
	  	<div class="box-body">
	  		@if( !empty($status) )


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
          <label class="col-sm-2 control-label" style="text-align: right;">Foto de perfil</label>
	    		<div class="row" align="center">
	    		
	    		<div class="col-sm-3" align="center">
	    			@if($photo == '')
		    	 		<img src="https://s3.amazonaws.com/abiliasf/profile-42914_640.png" alt="User Image"  style="width:150px; height: 150px;">
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
	    		<div class="col-sm-2" align="center" style="width: 240px;"><form enctype="multipart/form-data" action="/user/updateProfile/{{$userId}}" method="post" class="dropzone" id="myAwesomeDropzone"></form></div>
	    	</div><br/>
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

		            <input type="text" style="display: none;" name="latitude" id="latitudeFend" />
		            <input type="text" style="display: none;" name="longitude" id="longitudeFend" />
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
	    		

	    	@else

						<!-- Charge Alert whether payment was processed or not -->
							@if(session()->has('message'))

								@if(session()->has('success'))
							    <div class="alert alert-success alert-dismissable fade in" role="alert" id="alertf">
							    	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									    <span aria-hidden="true">&times;</span>
									</button>
									<strong>¡Familiar Agregado!</strong><br/><br/>		
							        {{ session()->get('message') }}
							    </div>
							   
								@elseif(session()->has('error'))
								 <div class="alert alert-danger alert-dismissable fade in" role="alert" id="alertf">
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
      <div class="row">
        <div class="col-md-12">
          <div class="box box-solid">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
             
                <div class="panel box box-default" style="border-top-color: black;">
                
                 <div class="box-header with-border"> 
                 	<h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" class="accordion-toggle text-black" style="display:block; height:100%; width:100%;font-size: 17px;">
                        Información personal
                  </a>
              </h4>
                  	</div>
                   
                  <div id="collapseOne" class="panel-collapse collapse in" aria-expanded="true">

                    <div class="box-body">
                      <br/>

                      
                        <div class="col-xs-12">
                          
                            <div class="col-sm-2" align="left"><b>Correo:</b></div>
                            <div class="col-sm-10 cut" align="left">{{ $email }}</div>
                         
                        </div>
                        <div class="col-xs-12">
                          
                            <div class="col-sm-2" align="left"><b>Nombre de usuario:</b></div>
                            <div class="col-sm-10 cut" align="left">{{ $username }}</div>
                         
                        </div>
                        <div class="col-xs-12">
                          
                            <div class="col-sm-2" align="left"><b>Edad:</b></div>
                            <div class="col-sm-10" align="left">{{ $age }}</div>
                         
                        </div>
                        <div class="col-xs-12">
                         
                            <div class="col-sm-2" align="left"><b>Ocupación:</b></div>
                            <div class="col-sm-10 cut" align="left">{{ $occupation }}</div>
                         
                        </div>
                        <div class="col-xs-12">
                        
                            <div class="col-sm-2" align="left"><b>Genero:</b></div>
                            @if($gender == "female")
                            <div class="col-sm-10" align="left">{{ trans('adminlte::adminlte.female') }}</div>
                            @endif
                            @if($gender == "male")
                            <div class="col-sm-10" align="left">{{ trans('adminlte::adminlte.male') }}</div>
                            @endif
                      
                        </div>
                        <div class="col-xs-12">
                         
                            <div class="col-sm-2" align="left"><b>Escolaridad:</b></div>
                            <div class="col-sm-10 cut" align="left">{{ $scholarship }}</div>
                    
                        </div>
                        <div class="col-xs-12">
                         
                            <div class="col-sm-2" align="left"><b>Estado civil:</b></div>
                              @if($maritalstatus == "single")
                            <div class="col-sm-10" align="left">{{ trans('adminlte::adminlte.single') }}</div>
                             @endif
                            @if($maritalstatus == "married")
                            <div class="col-sm-10" align="left">{{ trans('adminlte::adminlte.married') }}</div>
                             @endif	
                      
                        </div>
                        <div class="col-xs-12">
                        
                            <div class="col-sm-2" align="left"><b># Móvil:</b></div>
                            <div class="col-sm-10 cut" align="left">{{ $mobile }}</div>
                       
                        </div>
                        <div class="col-xs-12">
                        
                            <div class="col-sm-2" align="left"><b>Ultima modificación:</b></div>
                            <div class="col-sm-10 cut" align="left">{{ $updated_at }}</div>
                        
                        </div>
                    </div>
                  </div>
                </div>
                <br/>
                <div class="panel box box-default" style="border-top-color: black;">
               <div class="box-header with-border">
               	<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" class="accordion-toggle collapsed text-black" id="two" style="display:block; height:100%; width:100%;font-size: 17px;">
                        Familia
                </a>
            </h4>
                </div>
                  <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false">
                  	<div class="box-body">
                  			<div class="lockscreen-item pull-right" style="width: 210px !important;">
							      	<div class="input-group">
							        	<div class="form-control" align="center"><label id="labeltext">Agregar Familiar</label></div>
							        	<div class="input-group-btn">
								          	<a class="btn btn-default" data-toggle="modal" data-target="#modalfamily">
								          		<i class="fa fa-plus text-muted"></i>
								          	</a>
							        	</div>
							      	</div>
							</div>

                    <div id="demo"></div>
                    </div>
                  <!--Other modal -->
                  <div class="modal fade" role="dialog" id="modalfamily2">
                    <div class="modal-dialog modal-sm">

                      <div class="modal-content">

                        <div class="modal-header" >
                          <!-- Tachecito para cerrar -->
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <div align="left"><label>Información del Familiar</label></div>
                        </div>
                            <div class="modal-body">
                            <div align="center"><img src="" id="userp" class="img-circle" alt="User Image" style="height: 100px;"></img><br><br><b><div id="namep"></div></b></div><br>
                            <form id="init1" style="display: none;" action="{{ url('/user/loginSon') }}" method="post">
                            	<input type="hidden" name="id" id="idpa">
	                  				<button type="submit" id="init" class="btn btn-secondary btn-flat btn-block" style="display: none;">Iniciar Sesión</button>
	                  		</form>
                            </div>
                        </div>
                      </div> 
                    </div>

                    <!--Other modal -->
                   <div class="modal fade" role="dialog" id="modalfamily">
                    <div class="modal-dialog">

                      <div class="modal-content">


                        <div class="modal-header" style="padding-bottom: 1px !important;">
                            
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <div align="left"><label>Información de Familiar</label></div>
                        </div>
                             <div class="register-box-body">
					                 <div align="form-group" style="margin-bottom: 6px;">
 										<a class="btn btn-default btn-flat btn-block" id="inac">No es un usuario de la App</a>
 									</div><div align="form-group">
 										<a class="btn btn-default btn-flat btn-block" id="inac2">Si es un usuario activo de la App</a>
 									</div>
                             <form action="{{ url('/user/saveFamily') }}" id="formulatio" method="post" style="display: none;">

                             	<input type="hidden" name="val" id="val" value="false">
                                <div class="form-group has-feedback">	
 								<input type="text" name="name" id="sea" class="form-control" placeholder="Nombre Completo" required>
 								<span class="glyphicon glyphicon-user form-control-feedback"></span>
 							   </div>
 							    <input type="hidden" name="idfam" id="idfam" required>
 								<div id="resp" class="form-group text-muted"></div>
 								 <div class="form-group has-feedback">	
 								<select class="form-control select2" id="relationship" name="relationship" size="1">
 									<option value="0" default>--Seleccione parentesco--</option>
 									<option value="father">Padre</option>
 									<option value="mother">Madre</option>
 									<option value="son">Hijo(a)</option>
 									<option value="siblings">Hermano(a)</option>
 									<option value="grandparents">Abuelo(a)</option>
 									<option value="uncles">Tío(a)</option>
 									<option value="wife">Esposa</option>
 									<option value="husband">Esposo</option>
 								</select>
 								</div>
 								<div id="reg" style="display: none;">
					                <div class="form-group has-feedback">
					                    <input type="email" name="email" class="form-control" placeholder="{{ trans('adminlte::adminlte.email') }}">
					                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					                </div>

					                <div class="form-group has-feedback">
					                    <input type="date" name="birthdate" class="form-control" placeholder="{{ trans('adminlte::adminlte.birthdate') }}">
					                    <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
					                </div>

					                <div class="form-group has-feedback">
					                  <select class="form-control select2" name="gender" size="1">
					                  	<option value="female">Femenino</option>
					                  	<option value="male">Masculino</option>
					                  </select>
					                </div>
 								</div>	
 								<div align="right">
 								<button  type="button" class="btn btn-default btn-flat" id="back"><i class="fa fa-arrow-left text-muted"></i>&nbsp; Regresar</button>
 								<button  type="submit" class="btn btn-default btn-flat" id="sav"><i class="fa fa-plus text-muted"></i>&nbsp; Agregar Familiar</button>
 								</div>
 							</form>
 						</div>
                      </div> 
                    </div>
                </div>
				<script type="text/javascript">
				$('#modalfamily [data-dismiss=modal]').on('click', function (e) {
						document.getElementById('formulatio').style.display = "none";
						document.getElementById('inac2').style.display = "block";
						document.getElementById('inac').style.display = "block";

				})
				$('#back').on('click', function(e) {
						document.getElementById('formulatio').style.display = "none";
						document.getElementById('inac2').style.display = "block";
						document.getElementById('inac').style.display = "block";

				})
				$('#inac').on('click', function(e) {
       				 e.preventDefault();
       				    document.getElementById('formulatio').style.display = "block";
       				 	document.getElementById('reg').style.display = "block";
       				 	document.getElementById('inac2').style.display = "none";
       				 	document.getElementById('inac').style.display = "none";
       				 	document.getElementById("formulatio").reset();
       				 	$("#sav").removeAttr("disabled");
       				 	document.getElementById("val").value ="true";
       				 	document.getElementById('resp').style.display = "none";

       				});
				$('#inac2').on('click', function(e) {
       				 e.preventDefault();
       				 document.getElementById('formulatio').style.display = "block";
       				 	document.getElementById('reg').style.display = "none";
       				 	document.getElementById('inac').style.display = "none";
       				 	document.getElementById('inac2').style.display = "none";
       				 	document.getElementById("formulatio").reset();
       				 	$("#sav").attr("disabled", "disabled");
       				 	document.getElementById("val").value ="false";
       				 	document.getElementById('resp').style.display = "inline";
       				 	document.getElementById("resp").innerHTML = "";

       				})

				$('#two').on('click', function(e) {
       				 e.preventDefault();
       				 document.getElementById('demo').innerHTML='';
					+ function(d3) {

						var swatches = function(el) {
						var circleWidth = 45;	
						var charge = -800;
						var h = 0;
						var w= 0;
				        if("@php echo $agent->isMobile(); @endphp"){
				            //var mensaje2 = "@php echo $agent->version('Android'); @endphp";
				              h= window.screen.availHeight;
							  w= window.screen.availWidth;
				          
				            if(h >= 1000 && h <= 1300){
				            	circleWidth = 30;
								charge = -300;
				                h = h*0.20;
				                h = Math.floor(h);
				                w = w*0.40;
				                w = Math.floor(w);
				                  //alert("Altura: "+h + "anchura " + w);
				            }else if(h>=1800){
				              h-= 1840;
				              w-= 1200;
				             circleWidth = 30;
							 charge = -300;
				            }else
				            {
				              h-=315;
				              w-=100;
				              circleWidth = 30;
							 charge = -300;
				            }
				       	 }else{
				          h = window.screen.availHeight-375;
				          w = window.screen.availWidth-100;
				           circleWidth = 50;
				        }

						    w = w;
							h = h;

								    

								    var palette = {
								      "lightgray": "#819090",
								      "gray": "#708284",
								      "mediumgray": "#808486",
								      "darkgray": "#272B2C",
								      "darkblue": "#0A2933",
								      "darkerblue": "#042029",
								      "paleryellow": "#FCF4DC",
								      "paleyellow": "#EAE3CB",
								      "yellow": "#A57706",
								      "orange": "#BD3613",
								      "red": "#D11C24",
								      "pink": "#C61C6F",
								      "purple": "#595AB7",
								      "blue": "#2176C7",
								      "green": "#259286",
								      "white": "#fefefe",
								      "yellowgreen": "#738A05"
								    }

								    var nodes = @php echo $nodes; @endphp;
								    var links = [];

								    for (var i = 0; i < nodes.length; i++) {
								      if (nodes[i].target !== undefined) {
								        for (var x = 0; x < nodes[i].target.length; x++) {
								          links.push({
								            source: nodes[i],
								            target: nodes[nodes[i].target[x]]
								          })
								        }
								      }
								    }

								    var myChart = d3.select(el)
								      .append('svg')
								      .attr('width', "100%")
								      .attr('height', h)
								      .style('margin', '0').style('display','inline')

								    var force = d3.layout.force()
								      .nodes(nodes)
								      .links([])
								      .gravity(0.1)
								      .charge(charge)
								      .size([w, h])



								    var link = myChart.selectAll('line')
								      .data(links).enter().append('line')
								      .attr('stroke', palette.darkgray)
								      .attr('stroke-width', 3);

								    var node = myChart.selectAll('pattern')
								      .data(nodes).enter()
								      .append('g')
								      .call(force.drag);

								       node.append('svg:defs')
											    .append('svg:pattern')
											    .attr('id', function(d,i){
											      return d.id
											    })
											     .attr('patternUnits',"userSpaceOnUse")
											    .attr('height', function(d, i) {
											        if (i > 0) {
											          return (circleWidth-10) *2
											        } else {
											          return circleWidth * 2 
											        }
											      })
											    .attr('width', function(d, i) {
											        if (i > 0) {
											          return (circleWidth-10) *2
											        } else {
											          return circleWidth * 2 
											        }
											      })
											    .attr('x', function(d, i) {
											        if (i > 0) {
											          return circleWidth-10
											        } else {
											          return circleWidth
											        }
											      }).attr('y', function(d, i) {
											        if (i > 0) {
											          return circleWidth-10
											        } else {
											          return circleWidth
											        }
											      })
											    .append('svg:image')
											    .attr('xlink:href',function(d,i){
											     	 return d.photo + '?1'
											    })
											    .attr('height', function(d, i) {
											        if (i > 0) {
											          return (circleWidth-10) *2
											        } else {
											          return circleWidth * 2 
											        }
											      })
											    .attr('width', function(d, i) {
											        if (i > 0) {
											          return (circleWidth-10) *2
											        } else {
											          return circleWidth * 2 
											        }
											      })
											      .attr('x', 0)
											      .attr('y', 0);

								    node.append('circle')
								      .attr('cx', function(d) {
								        return d.x;
								      }).attr('cy', function(d) {
								        return d.y;
								      })
								      .attr('r', function(d, i) {
								        if (i > 0) {
								          return circleWidth - 10
								        } else {
								          return circleWidth
								        }
								      })
								      .attr('id', function(d, i) {
								          return d.id
								      })
								      .attr('stroke', function(d, i) {
								        if (i > 0) {
								          return palette.darkgray
								        } else {
								          return palette.darkgray
								        }
								      })
								      .attr('stroke-width', 5)
								      .style("fill", "#fff").style("fill", function(d,i){ return 'url(#' + d.id+')'})

								    node.append('text')
								      .text(function(d) {
								        return d.name
								      })
								      .attr('font-family', 'sans-serif')
								      .attr('fill', function(d, i) {
								        if (i > 0) {

								          return palette.darkgray
								        } else {
								          return "transparent"						   
								         }
								      })
								      .attr('x', function(d, i) {
								        if (i > 0) {
								          return -20
								        } else {
								          return circleWidth - 15
								        }
								      })
								      .attr('y', function(d, i) {
								        if (i > 0) {
								          return circleWidth + 5
								        } else {
								          return 8
								        }
								      })
								      .attr('text-anchor', function(d, i) {
								        if (i > 0) {
								          return 'beginning'
								        } else {
								          return 'end'
								        }
								      })
								      .attr('font-size', function(d, i) {
								        if (i > 0) {
								          return '1em'
								        } else {
								          return '1em'
								        }
								      })

								    force.on('tick', function(e) {
								      node.attr('transform', function(d, i) {
								        return 'translate(' + d.x + ', ' + d.y + ')';
								      })

								      link
								        .attr('x1', function(d) {
								          return d.source.x
								        })
								        .attr('y1', function(d) {
								          return d.source.y
								        })
								        .attr('x2', function(d) {
								          return d.target.x
								        })
								        .attr('y2', function(d) {
								          return d.target.y
								        })
								    })
								    node.on("click", click);
										function click(d) 
										{
										if(d.id == "n"){
											$("#modalfamily").modal('toggle');		
											}else{

										$('#userp').attr('src', d.photo + '?2');
										if(!d.namecom){
										  	$('#namep').html('Yo');
										  }	else{
										  	$('#namep').html(d.namecom + ' - ' + d.relationship);
										  	if(d.session == 1){
										  		$('#idpa').val(d.id);
										  		$('#init1').css({ 'display': "block" });
										  		$('#init').css({ 'display': "block" });
										  		$('#init').text('Iniciar sesión como ' + d.name);
										  	}else{
										  		$('#init1').css({ 'display': "none" });
												$('#init').css({ 'display': "none" });
										  	}
										  }
										  	$("#modalfamily2").modal('toggle');
										  }
										}
									force.start();

								  }('#demo');

								}(window.d3);
								  });

                    	</script>
                    </div>
                  </div>
                <br/>
                

                <div class="panel box box-default" style="border-top-color: black;">
                	 <div class="box-header with-border">
                	 	<h4 class="panel-title">
                 <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree" class="accordion-toggle collapsed text-black" style="display:block; height:100%; width:100%;font-size: 17px;" onclick="initMapAddressUser();">	
                       Dirección de usuario  
                  </a> 
                  </h4> 
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse" aria-expanded="false">
                    <div class="box-body" align="center">
                    	@if($latitude == "" && $longitude == "")
                    	         @include('empty.emptyData', 
                                            [
                                              'emptyc' => 'buttom',
                                              'title'  => 'No se ha agregado dirección',
                                              'icon'   => 'adminlte.empty-house'
                                            ]
                                          )
                                       <script type="text/javascript">
                                          $('#form_profile2').attr("action", "/user/edit/complete");
                                          $('.buttonEmpty').text('Agregar dirección');
                                          $('.spanEmpty1').html('No se ha agregado dirección');
                                       </script>   
                    	   <input type="hidden" id="nullmap" value="true">
                    	@else   
                          <div id="mapAddressUser"></div>
                          <input type="hidden" id="nullmap" value="false">
                        @endif
                    </div>
                </div>
              </div>


              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <!-- /.col -->
      </div>
    		@endif



    		<script type="text/javascript">
    			function fun(a) {
							    document.getElementById('sea').value = a.getAttribute("data-value");
							    document.getElementById('idfam').value = a.getAttribute("data-id");
							    document.getElementById("resp").innerHTML = "";
							    $("#sav").removeAttr("disabled");   
							}



				$(document).ready(function(){
					    $("#alertf").fadeTo(3000, 500).fadeOut(500, function(){
						    $("#alertf").fadeOut(500);
						});
 						 	$("#sea").on("keyup", function(e) {

						    		if(e.which == 32) {
					                   $.ajaxSetup({
				                        headers: {
				                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				                        }
				                    });
				                 var sea = document.getElementById('sea').value;
				                           $.ajax({     
				                             type: "POST",                 
				                             url: "{{ url('user/userSearch') }}",  
				                              data: { "search" : sea }, 
				                              dataType: 'json',                
				                             success: function(data)             
				                             {
				                             if(data.length == 0){
				                             	document.getElementById("resp").innerHTML = "No existe usuario registrado...";
				                             	
    											}else {

    													document.getElementById("resp").innerHTML = "Coincidencias: ";
    												for(var i= 0; i < data.length; i++){
				                     				if(data[i]['profile_photo'] == null){
				                     				$('#resp').append('<div style="margin-left:5%;"><img src="https://s3.amazonaws.com/abiliasf/profile-42914_640.png" class="img-circle" style="width:25px; height:25px;"><a data-id="'+ data[i]['id'] +'" data-value="'+ data[i]['name'] +'" onclick="fun(this);" class="btn text-muted" style="text-align: left;white-space: normal;">'+ data[i]['name'] +'</a></div>');
				                     				}else{
				                     				 $('#resp').append('<div style="margin-left:5%;"><img src="'+ data[i]['profile_photo'] +'" class="img-circle" style="width:25px; height:25px;"><a data-id="'+ data[i]['id'] +'" data-value="'+ data[i]['name'] +'" onclick="fun(this);" class="btn text-muted" style="text-align: left;white-space: normal;">'+ data[i]['name'] +'</a></div>');
				                     				}
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
