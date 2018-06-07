@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')
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
		#map {
			padding-top: 0;
		    width: 100%;
		    height: 300px;
		    z-index: 30;
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
	 .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
		    padding-left: 5px !important;
		}

    </style>
@stop

@section('content')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>

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
	@if($mode == 'doctor')
	@if( empty($status) )

    @include('headerprofile')
    <script type="text/javascript">
      //O si no lleva botón hacer el div "div_profile" invisible
      document.getElementById('labeltext').innerHTML = 'Editar';
      var elemento = document.getElementById("i_button");
      elemento.className = "fa fa-pencil text-muted";
      document.forms.form_profile.action = "/doctor/edit/complete";

    </script>
	@endif

	


    <div class="box">
	  	<div class="box-header with-border">
		    <h3 class="box-title">Información de Médico</h3>
	    	<!-- /.box-tools -->
	  	</div>
	  			<!-- Modal photo settings-->
	<div id="loadingmodal" class="modal fade" role="dialog" style="background: rgba(0, 0, 0, 0.8);">
	    <div class="modal-dialog">
	        <div class="modal-content-2">
	        	<div align="center">
					<h1><i class="fa fa-refresh fa-spin"></i><br/>Cargando...</h1><br/><h4>(Esto podría tardar unos segundos)</h4>
	          	</div>
	        </div>
	    </div>
 	</div>
 	<!-- Modal photo settings-->



	  	<!-- /.box-header -->
	  	<div class="box-body">
	  		@if( !empty($status) )
	  			<!-- Modal photo settings-->
	<div id="modal" class="modal fade" role="dialog" style="width: 100%">
	    <div class="modal-dialog">
	        <div class="modal-content" >
	          	<div class="modal-header"><label for="recorte">Recorte de imagen:</label></div>
	          	<div class="modal-body" >
	                <div align="center">
	                   	<img src="{{ $photo }}?{{ \Carbon\Carbon::now()->format('h:i') }}" id="target">
	                   	<form enctype="multipart/form-data" action="/doctor/cropDoctor/{{$userId}}" method="post" onsubmit="return checkCoords();">
		                   	<input type="hidden" id="x" name="x" />
							<input type="hidden" id="y" name="y" />
							<input type="hidden" id="w" name="w" />
							<input type="hidden" id="h" name="h" /><br/>
		                    <span class="input-group-btn">
		                    <input type="submit" class="btn btn-secondary btn-block btn-flat" value="Guardar"></span>
	                  	</form>
	               </div>
	          	</div>
	        </div>
	    </div>
 	</div>
 	<!-- Modal photo settings-->

		  		@if ($status == "In Progress")
		  			<div class="callout callout-success">
		                <h4>Ya casi estamos listos {{ $firstname }} !!!</h4>

		                <p>Confirma y completa la información que esta debajo</p>
		            </div>
	    		@endif
	    		<!-- Photo Zone. -->
	 <label class="col-sm-2 control-label" style="text-align: right;">Foto de perfil</label>
	    		<div class="row" align="center">

		    		<div class="col-sm-4" align="center">
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
						<div class="col-sm-6" align="center" style="width: 240px;"><form enctype="multipart/form-data" action="/doctor/updateDoctor/{{$userId}}" method="post" class="dropzone" id="myAwesomeDropzone"></form></div>
	    		</div>
	    		<!-- Photo Zone. -->
	    		<br/>

	    		<form action="/doctor/laborInformation/{{$userId}}" method="post" class="form-horizontal" id="formDr">
	    <div id="modalAlert" class="modal fade" role="dialog">
	    <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">La foto de perfil es obligatoria, recuerde que es la imagen que verá el ppaciente.</h4>
              </div>
            </div>
          </div>
      </div>
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
	                    <label for="email" class="col-sm-2 control-label">Correo electrónico</label>
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
		                <b>Información Profesional</b>
		            </div>
		            <div class="form-group">
		            	<label for="medical_society" class="col-sm-2 control-label">Sociedad de Médicos</label>
	                	<div class="col-sm-10">
	                		<select class="form-control select2" name="medical_society" id="medical_society" size="1">
	                			@foreach($asso as $asso)
	                			@if($asso->name == $medical_society)
	                				<option value="{{ $medical_society }}" selected> {{ $medical_society }}</option>
	                			@else	
	                				<option value="{{ $asso->name }}"> {{ $asso->name }}</option>
	                			@endif
	                			@endforeach
	                		</select>
	                	</div></div>
	               <div class="form-group"> 	
	                	<label for="professional_license" class="col-sm-2 control-label">Licencia Profesional</label>
	                	<div class="col-sm-10">
		                  	<input type="text" name="professional_license" id="professional_license" value="{{ $professional_license }}" class="form-control">
	                	</div>
	                	<!-- /.input group -->
	              	</div>
		            <div class="form-group">	
	                	<label for="specialty" class="col-sm-2 control-label">Especialidad</label>
	                	<div class="col-sm-10">
		                  	<select class="form-control" name="specialty" id="specialty">
		                    	<option value="{{ $specialty }}" selected> {{ $specialty }}</option>
		                    	<option value="Médico General"> Médico General </option>
		                    	<option value="Alergología"> Alergología </option>
		                    	<option value="Cardiología">Cardiología</option>
		                    	<option value="Gastroenterología"> Gastroenterología </option>
		                    	<option value="Geriatría"> Geriatría </option>
		                    	<option value="Infectología"> Infectología </option>
		                    	<option value="Neumología"> Neumología </option>
		                    	<option value="Neurología"> Neurología </option>
		                    	<option value="Nutriología"> Nutriología </option>
		                    	<option value="Oftalmología"> Oftalmología </option>
		                    	<option value="Oncología"> Oncología </option>
		                    	<option value="Pediatría"> Pediatría </option>
		                    	<option value="Psiquiatría"> Psiquiatría </option>
		                    	<option value="Rehabilitación"> Rehabilitación </option>
		                    	<option value="Reumatología"> Reumatología </option>
		                    	<option value="Toxicología"> Toxicología </option>
		                    	<option value="Odontología"> Odontología </option>
		                  	</select>
	                	</div>
	                	<!-- /.input group -->
	              	</div>
	              	<div class="form-group">
	                	<label for="schoolOfMedicine" class="col-sm-2 control-label">Escuela de Medicina</label>
	                	<div class="col-sm-10">
		                  	<input type="text" name="schoolOfMedicine" id="schoolOfMedicine" value="{{ $schoolOfMedicine }}" class="form-control">
	                	</div>
	                	<!-- /.input group -->
	              	</div>
	              	<div class="form-group">
	                	<label for="facultyOfSpecialization" class="col-sm-2 control-label">Facultad de Especialización</label>
	                	<div class="col-sm-10">
		                  	<input type="text" name="facultyOfSpecialization" id="facultyOfSpecialization" value="{{ $facultyOfSpecialization }}" class="form-control">
	                	</div>
	                	<!-- /.input group -->
	              	</div>
	              	<div class="form-group">
	                	<label for="practiseProfessional" class="col-sm-2 control-label">Práctica Profesional</label>
	                	<div class="col-sm-10">
		                  	<input type="text" name="practiseProfessional" id="practiseProfessional" value="{{ $practiseProfessional }}" class="form-control">
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
		            	<div id="locationField" class="col-sm-10">
					      	<input id="autocomplete" class="form-control" placeholder="Ingresa tu dirección" onFocus="geolocate()" type="text"></input>
					    </div>
		            </div>

		            <div class="form-group">
		            	<label  class="col-sm-2 control-label">
		            	</label>
			            	<div class="col-sm-5">
			            		<input type="text" value="{{ $street }}" class="form-control" name="street" id="street_number"  placeholder="Número de calle" {{ ( empty( $street ) ) ? 'disabled="true"' : '' }}></input>
			            	</div>
			            	<div class="col-sm-5">
			            		<input type="text" value="{{ $colony }}" class="form-control" name="colony" id="route" {{ ( empty( $colony ) ) ? 'disabled="true"' : '' }}></input>
			            	</div>  
			        </div>
			        <div class="form-group">
			        	<label  class="col-sm-2 control-label">
		            	</label>    	            	
			            	<div class="col-sm-5">
			            		<input type="text" value="{{ $delegation }}" class="form-control" name="delegation" id="locality" {{ ( empty( $delegation ) ) ? 'disabled="true"' : '' }} placeholder="Ciudad"></input>
			            	</div>
			            	<div class="col-sm-5">
			            		<input type="text" value="{{ $state }}" class="form-control" name="state" id="administrative_area_level_1" placeholder="Estado" {{ ( empty( $state ) ) ? 'disabled="true"' : '' }}></input>
			            	</div>
			        </div>
			        <div class="form-group">  
			        	<label  class="col-sm-2 control-label">
		            	</label>  	
			            	<div class="col-sm-5">
			            		<input type="text" value="{{ $postalcode }}" class="form-control" name="postalcode" id="postal_code" {{ ( empty( $postalcode ) ) ? 'disabled="true"' : '' }} placeholder="Código postal"></input>
			            	</div>
			            	<div class="col-sm-5">
			            		<input type="text" value="{{ $country }}" class="form-control" name="country" id="country" placeholder="País" {{ ( empty( $country ) ) ? 'disabled="true"' : '' }}></input>
			            	</div>
			            
		            </div>

		            <input type="text" style="display: none;" name="latitude" id="latitudeFend" />
		            <input type="text" style="display: none;" name="longitude" id="longitudeFend" />
		            <br/>
		            <!-- /.box-body -->
		            <input type="hidden" name="change" value="true"/>
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
    			<!-- Custom Tabs -->
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
                            <div class="col-sm-10" align="left">{{ $email }}</div>
                         
                        </div>
                        <div class="col-xs-12">
                          
                            <div class="col-sm-2" align="left"><b>Nombre de usuario:</b></div>
                            <div class="col-sm-10" align="left">{{ $username }}</div>
                         
                        </div>
                        <div class="col-xs-12">
                          
                            <div class="col-sm-2" align="left"><b>Edad:</b></div>
                            <div class="col-sm-10" align="left">{{ $age }}</div>
                         
                        </div>
                        <div class="col-xs-12">
                         
                            <div class="col-sm-2" align="left"><b>Ocupación:</b></div>
                            <div class="col-sm-10" align="left">{{ $occupation }}</div>
                         
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
                            <div class="col-sm-10" align="left">{{ $scholarship }}</div>
                    
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
                            <div class="col-sm-10" align="left">{{ $mobile }}</div>
                       
                        </div>
                        <div class="col-xs-12">
                        
                            <div class="col-sm-2" align="left"><b>Ultima modificación:</b></div>
                            <div class="col-sm-10" align="left">{{ $updated_at }}</div>
                        
                        </div>
                    </div>
                  </div>
                </div>
                <br/>
                <div class="panel box box-default" style="border-top-color: black;">
               <div class="box-header with-border">
               	<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false"  class="accordion-toggle collapsed text-black" style="display:block; height:100%; width:100%;font-size: 17px;">
                        Información Profesional
                </a>
            </h4>
                </div>
                  <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false">
                    <div class="box-body">
                        <div class="col-xs-12">
                            <div class="col-sm-2" align="left"><b>Licencia Profesional:</b></div>
                            <div class="col-sm-10" align="left">{{ $professional_license }}</div>
                        </div>
                         <div class="col-xs-12">
                            <div class="col-sm-2" align="left"><b>Sociedad de Médicos:</b></div>
                            <div class="col-sm-10" align="left">{{ $medical_society }}</div>
                        </div>
                        <div class="col-xs-12">
                            <div class="col-sm-2" align="left"><b>Especialidad:</b></div>
                            <div class="col-sm-10" align="left">{{ $specialty }}</div>
                        </div>
                       <div class="col-xs-12">
                            <div class="col-sm-2" align="left"><b>Escuela de Medicina:</b></div>
                            <div class="col-sm-10" align="left">{{ $schoolOfMedicine }}</div>
                        </div>
                        <div class="col-xs-12">
                            <div class="col-sm-2" align="left"><b>Facultad de Especialización:</b></div>
                            <div class="col-sm-10" align="left">{{ $facultyOfSpecialization }}</div>
                        </div>
                        <div class="col-xs-12">
                            <div class="col-sm-2" align="left"><b>Práctica Profesional:</b></div>
                            <div class="col-sm-10" align="left">{{ $practiseProfessional }}</div>
                        </div>
                    </div>
                  </div>
                </div>
                <br/>
                <div class="panel box box-default" style="border-top-color: black;">
                	 <div class="box-header with-border">
                	 	<h4 class="panel-title">
                 <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree" class="accordion-toggle collapsed text-black" style="display:block; height:100%; width:100%;font-size: 17px;">	
                        Consultorios    
                  </a> 
                  </h4> 
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse" aria-expanded="false">
                    <div class="box-body">
                          @if($labor->isEmpty())
						 <span class="text-black">No hay ningún centro asociado a su cuenta.</span>			
							@else
							
							@foreach($labor->sortByDesc('created_at') as $labor)
							<div class="form-group">	
							<div class="col-sm-8" style="padding-right: 0; padding-left: 0;">
									          <div class="info-box sm bg-gray">
									          	<a href="{{ url('workboardDr/index') }}/{{$labor->id}}"><span class="info-box-icon sm bg-black"><i class="fa fa-calendar"></i></span></a> 
									            <div class="info-box-content sm">
									              <b>{{ $labor->workplace}}</b> 
									              <span class="text-black">{{ $labor->country }}, {{ $labor->state }}, {{ $labor->colony }}, {{ $labor->delegation }}, {{ $labor->street }} {{ $labor->streetNumber }}. Código Postal: {{ $labor->postalcode }}</span>
									            </div>
									            <!-- /.info-box-content -->
									          </div>
									          <!-- /.info-box -->
							</div>
							<div class="col-sm-4" style="padding-right: 0; padding-left: 0;">
							<img border="0" src="//maps.googleapis.com/maps/api/staticmap?center={{ $labor->latitude }},{{ $labor->longitude }}&amp;markers=size:small%7Ccolor:black%7Clabel:%7C{{ $labor->latitude }},{{ $labor->longitude }}&amp;zoom=15&amp;style=element:geometry%7Ccolor:0xf5f5f5&amp;size=400x45&amp;key=AIzaSyCKh6YcZQgwbcbUBCftcAQq7rfL5bLW_6g" alt="ubicación"  style="width:100%; height:45px;">	
							</div>
							</div>		
							@endforeach
							@endif
									<div class="pull-right">
									   	<form action="/doctor/laborInformation/{{$userId}}" method="post">
									   	<button type="submit" class="btn btn-secondary btn-xs"><i class="fa fa-plus"></i> Agregar consultorio</button>
									   </form></div>
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

    		$(document).ready(function(){
				  $("#formDr").submit(function() {
				    var x = "{{ $photo }}"; 
				      if (x == '') {
				        $('#modalAlert').modal()	
				        return false;
				      } else 
				          return true;			
				    });
				});

    			window.onload = function(){
    				@if(!empty($status))
    				initAutocomplete();
    				@endif
    				@if( empty($status) )
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
		            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
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

		            console.log(geolocation.lat + ' ' + geolocation.lng);
		            document.getElementById('latitudeFend').value = geolocation.lat; 
		            document.getElementById('longitudeFend').value = geolocation.lat;
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
					          zoom: 7,
					          center: {lat: {{ $longitude }} , lng: {{ $latitude }} }

					        });

					        var image = "{{ asset('maps-and-flags_1.png') }}";
					        
					        var beachMarker = new google.maps.Marker({
					          position: {lat: {{ $longitude }} , lng: {{ $latitude }} },
					          map: map,
					          icon: image
					        });
					    }
				        counter++;
			      	}
		    	</script>

			@endif

	  	</div>	  	
	</div>
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
    @endif



				    @if($mode == 'labor')
				<div class="box" id="boxlabor">
							  	<div class="box-header with-border">
								    <h3 class="box-title">Alta de nuevo consultorio</h3>
							  	</div>
						  	<!-- /.box-header -->
				<div class="box-body">
					   <div id="buttonOpen" class="col-sm-12">
					   	<div  class="col-sm-5">
					      <button type="button" id="openform" class="btn btn-secondary btn-block btn-flat"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Ingresar dirección</button>
					     </div> <div  class="col-sm-2" align="center">
					      ó 
					  </div><div  class="col-sm-5">
					       <button type="button" id="openform2" class="btn btn-secondary btn-block btn-flat"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;Registrar por ubicación actual</button>
					   </div>
					   </div>

					<form action="/doctor/laborInformationNext/{{$userId}}" method="post" class="form-horizontal" id="form1" style="display:none">
		<div class="modal fade" id="modal-default1" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Servicios disponibles en este lugar</h4>
              </div>
              <div class="modal-body">
               <div class="label-group">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Estacionamiento">
                      Estacionamiento
                    </label>
                  </div>

                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Ambulancias">
                      Ambulancias
                    </label>
                  </div>

                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Cafetería">
                      Cafetería
                    </label>
                  </div>
                 <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Elevador">
                     Elevador
                    </label>
                  </div>
                   <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Wifi">
                     Wifi
                    </label>
                  </div>
                </div>
              </div>
             
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><i class="fa fa-check"></i></button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
					<div class="callout callout-default">
					<label id="labelwork" class="text-red"></label>
				 <div class="form-group">
	                	<label for="workplace" class="col-sm-2 control-label">Nombre del Lugar</label>
	                	<div class="col-sm-10">

		                  	<input type="text" name="workplace" id="workplace" value="" class="form-control" placeholder="Particular, Los Angeles, Traumatología del Valle, entre otros.">
	                	</div>
	                	<!-- /.input group -->
	              	</div>
	              	<div class="form-group">
	                	<label for="professionalPosition" class="col-sm-2 control-label">Posición Profesional</label>
	                	<div class="col-sm-4">
		                  	<input type="text" name="professionalPosition" id="professionalPosition" value="" class="form-control">
	                	</div>
	                	<label for="cost" class="col-sm-2 control-label">Costo de Consulta</label>
	                	<div class="col-sm-4">
		                  	<input type="text" name="cost" id="cost" value="" class="form-control">
	                	</div>
	                </div>
	                	
	                <div class="form-group">
		            	
		            		<label for="professionalPosition" class="col-sm-2 control-label">Dirección</label>
		            	<div id="locationField" class="col-sm-10">
					      	 <input id="autocomplete" class="form-control" placeholder="Ingresa la dirección del consultorio" onFocus="geolocate()" type="text"/>
					    </div>
					</div>   

			            	<div class="col-sm-6">
			            		<input type="text" value="" class="form-control" name="street" id="street_number"  placeholder="Número de calle" {{ ( empty( $street ) ) ? 'disabled="true"' : '' }}/>
			            	</div>
			            	<div class="col-sm-6">
			            		<input type="text" value="" class="form-control" name="colony" id="route" {{ ( empty( $colony ) ) ? 'disabled="true"' : '' }} placeholder="Colonia"/>
			            	</div>

			            	<div class="col-sm-6">
			            		<input type="text" value="" class="form-control" name="delegation" id="locality" {{ ( empty( $delegation ) ) ? 'disabled="true"' : '' }} placeholder="Ciudad"/>
			            	</div>
			            	<div class="col-sm-6">
			            		<input type="text" value="" class="form-control" name="state" id="administrative_area_level_1" placeholder="Estado" {{ ( empty( $state ) ) ? 'disabled="true"' : '' }}/>
			            	</div>
			            	<div class="col-sm-6">
			            		<input type="text" value="" class="form-control" name="postalcode" id="postal_code" {{ ( empty( $postalcode ) ) ? 'disabled="true"' : '' }} placeholder="Código postal"/>
			            	</div>
			            	<div class="col-sm-6">
			            		<input type="text" value="" class="form-control" name="country" id="country" placeholder="País" {{ ( empty( $country ) ) ? 'disabled="true"' : '' }}/>
			            	</div>
		         

		            <input type="hidden" name="lati" id="latitude"/>
		            <input type="hidden" name="long" id="longitude"/>
		            <br/>
		            <!-- /.box-body -->
		            <div class="form-group" align="left">
								<div class="col-sm-6">
									<br/>
					    		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default1">
						                Agregar servicios
						        </button>
					            </div>
					       		<div class="col-sm-6" align="right">
					       			<br/>
						    		<button type="submit" class="btn btn-secondary">
						                Guardar
						            </button>
					    			<button type="button" id="cancel" class="btn btn-default ">Cancelar</button>
					            </div>

				 </div>
				 				</form>	

		</div>	
				

				<!-- form for map -->
		<form action="/doctor/laborInformationNext/{{$userId}}" method="post" class="form-horizontal" id="form2" style="display: none;">
			<div class="modal fade" id="modal-default" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Servicios disponibles en este lugar</h4>
              </div>
              <div class="modal-body">
               <div class="label-group">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Estacionamiento">
                      Estacionamiento
                    </label>
                  </div>

                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Ambulancias">
                      Ambulancias
                    </label>
                  </div>

                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Cafeteria">
                      Cafetería
                    </label>
                  </div>
                 <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Elevador">
                     Elevador
                    </label>
                  </div>
                   <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Wifi">
                     Wifi
                    </label>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><i class="fa fa-check"></i></button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
			<div class="form-group">
			<div class="col-sm-5">
				<div class="col-sm-12">
					<label id="labelwork2" class="text-red"></label>
					 <div class="form-group">
	                	<label for="workplace" class="col-sm-4 control-label">Nombre del lugar</label>
	                	<div class="col-sm-8">

		                  	<input type="text" name="workplace" id="workplace2" value="" class="form-control" placeholder="Particular, Los Angeles, Traumatología del Valle, entre otros...">
	                	</div>
	                	<!-- /.input group -->
	              	</div>
	              	<div class="form-group">

	                	<label for="professionalPosition" class="col-sm-4 control-label">Posición Profesional</label>
	                	<div class="col-sm-8">
		                  	<input type="text" name="professionalPosition" id="professionalPosition" value="" class="form-control">
	                	</div>
	                </div>
	                <div class="form-group">
	                	<label for="cost" class="col-sm-4 control-label">Costo de Consulta</label>
	                	<div class="col-sm-8">
		                  	<input type="text" name="cost" id="cost" value="" class="form-control">
	                	</div>
	                </div>
				</div>	
					 <input type="hidden" name="lati" id="lati"/>
		            <input type="hidden" name="long" id="long"/>
			<div class="col-sm-12">			
			            	<div class="col-sm-6">
			            		<input type="text" value="" class="form-control" name="country" id="countr" placeholder="País" disabled="true" placeholder="País"/>
			            	</div>
			            	<div class="col-sm-6">
			            		<input type="text" value="" class="form-control" name="state" id="state" disabled="true" placeholder="Estado"/>
			            	</div>		  
			            	<div class="col-sm-6">
			            		<input type="text" class="form-control" name="street" id="street_numbe" disabled="true" placeholder="Calle"/>
			            	</div>
			            	<div class="col-sm-6">
			            		<input type="text" class="form-control" name="colony" id="rout" disabled="true" placeholder="Colonia"/>
			            	</div>
			            	<div class="col-sm-6">
			            		<input type="text" value="" class="form-control" name="delegation" id="localit" disabled="true" placeholder="Delegación"/>
			            	</div>

			        
			            	<div class="col-sm-6">
			            		<input type="text" class="form-control" name="postalcode" id="postalcode" disabled="true" placeholder="Código Postal"/>
			            	</div>

			</div>
				<div class="col-sm-12 form-group" align="right">
								
									<br/>
					    		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
						                Agregar servicios
						        </button>	
				


					            
				</div>
			</div>
			<div class="col-sm-7">
			<div id="loadingGif2" align="center"><center><h1><i class="fa fa-refresh fa-spin"></i> Cargando ...</h1></center></div>
		  	<div id="map"></div>
		  	<div class="pull-center">	
					<span class="btn btn-secondary btn-block btn-flat" onclick="initMap();"><i class="fa fa-map-marker"></i>&nbsp; Ubícame</span>
			</div>	
		  </div>
							    <div class="col-sm-12" align="right">
					       			<br/>
						    		<button type="submit" class="btn btn-secondary">
						                Guardar
						            </button>
						            <button type="button" id="cancel2" class="btn btn-default ">Cancelar</button>
					            </div></div>
		  
		</form>
			</div>
				
    		<script type="text/javascript">
    	


    		$(document).ready(function() {

				$("input#workplace").bind('change keyup input', function() {
    			var workplace =  document.getElementById('workplace').value;

    			if(workplace.indexOf('Hospital') >= 0 || workplace.indexOf('Consultorio') >= 0 || workplace.indexOf('hospital') >= 0 || workplace.indexOf('HOSPITAL') >= 0 || workplace.indexOf('consultorio') >= 0 || workplace.indexOf('CONSULTORIO') >= 0){
    					document.getElementById('labelwork').innerHTML = '* Las palabras hospital, o consultorio están restringidas.'
    			}
    			else{
    				document.getElementById('labelwork').innerHTML = ''
    			}
    		})

				$("input#workplace2").bind('change keyup input', function() {
    			var workplace =  document.getElementById('workplace2').value;

    			if(workplace.indexOf('Hospital') >= 0 || workplace.indexOf('Consultorio') >= 0 || workplace.indexOf('hospital') >= 0 || workplace.indexOf('HOSPITAL') >= 0 || workplace.indexOf('consultorio') >= 0 || workplace.indexOf('CONSULTORIO') >= 0){
    					document.getElementById('labelwork2').innerHTML = '* Las palabras hospital, o consultorio están restringidas.'
    			}
    			else{
    				document.getElementById('labelwork2').innerHTML = ''
    			}
    		})

				$("#openform").click(
				function(event) {
				   $("#buttonOpen").hide();
				   document.getElementById("form1").style.display = "block";
				})
				$("#openform2").click(
				function(event) {
				   $("#buttonOpen").hide();
				   document.getElementById("form2").style.display = "block";		  
				  setTimeout(function(){ 
				  	initMap();
				  	document.getElementById('loadingGif2').style.display = "none";	 
				  },2000);
				 
				})
				$("#cancel").click(
				function(event) {
				   $("#buttonOpen").show();
				   document.getElementById("form1").style.display = "none";
				   document.getElementById("form2").style.display = "none";
				   initMap();
				 
				})

				$("#cancel2").click(
				function(event) {
				   $("#buttonOpen").show();
				   document.getElementById("form1").style.display = "none";
				   document.getElementById("form2").style.display = "none";
				   document.getElementById("boxlabor").style.paddingBottom = "";
				   initMap();
				 
				})
			})
    			window.onload = function(){
    				initAutocomplete();

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
		        postal_code: 'short_name',
		        latitude: 'long_name',
		        longitude: 'long_name'
		      };


		      function initAutocomplete() {
		        // Create the autocomplete object, restricting the search to geographical
		        // location types.
		        autocomplete = new google.maps.places.Autocomplete(
		            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
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
		            var lat =  place.geometry.location.lat();
		            var lng =  place.geometry.location.lng();
		            document.getElementById('latitude').value = lat; 
		            document.getElementById('longitude').value = lng;

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

		            console.log(geolocation.lat + ' ' + geolocation.lng);
		            document.getElementById('latitude').value = geolocation.lat; 
		            document.getElementById('longitude').value = geolocation.lng;
		            var circle = new google.maps.Circle({
		              center: geolocation,
		              radius: position.coords.accuracy
		            });
		            autocomplete.setBounds(circle.getBounds());
		          });
		        }
		      }	
      function initMap() {

        infoWindow = new google.maps.InfoWindow();

        //Current position
        if (navigator.geolocation) {
          console.log('POSICION ACTUAL');
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            //Map
             document.getElementById('lati').value = position.coords.latitude;
             document.getElementById('long').value = position.coords.longitude;
        var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        geocoder = new google.maps.Geocoder();
        geocoder.geocode({"latLng": latlng}, function(results, status)
			{
				if (status == google.maps.GeocoderStatus.OK)
				{
					if (results[0])
					{
						

						   		for(var i=0; i < results[0].address_components.length; i++)
										{
										    var component = results[0].address_components[i];
										    if(component.types[0] == "postal_code")
										    {
										         document.getElementById('postalcode').value = component.long_name ;
										         document.getElementById('postalcode').disabled = false;
										    }
										     if(component.types[0] == "country")
										    {
										         document.getElementById('countr').value = component.long_name ;
										         document.getElementById('countr').disabled = false;
										    }
										    if(component.types[0] == "locality")
										    {
										         document.getElementById('localit').value = component.long_name ;
										          document.getElementById('localit').disabled = false;
										    }
										    if(component.types[0] == "street_number")
										    {
										         document.getElementById('street_numbe').value = component.short_name ;
										         document.getElementById('street_numbe').disabled = false;
										    }
										    if(component.types[0] == "route")
										    {
										         document.getElementById('rout').value = component.long_name ;
										         document.getElementById('rout').disabled = false;
										    }
										     if(component.types[0] == "administrative_area_level_1")
										    {
										         document.getElementById('state').value = component.long_name ;
										         document.getElementById('state').disabled = false;
										    }

										}

					}

				}
			});	


            map = new google.maps.Map(document.getElementById('map'), {
              zoom: 14,
              center: new google.maps.LatLng(pos),
            
              // disableDefaultUI: true,
              zoomControl: true,
              mapTypeControl: false,
              scaleControl: false,
              streetViewControl: false,
              rotateControl: false,
              fullscreenControl: false
            });

            var markerUser = "{{ asset('markerUser.png') }}";

            //Marker
              markerP = new google.maps.Marker({
              draggable: true,
              position: new google.maps.LatLng(pos),
              icon: markerUser,
              map: map
            });
            //Evento to open infowindow
            markerP.addListener('mouseover', function() {
           	 document.getElementById('lati').value = markerP.getPosition().lat();
             document.getElementById('long').value = markerP.getPosition().lng();
             var latlng = new google.maps.LatLng(markerP.getPosition().lat(), markerP.getPosition().lng());
             geocoder.geocode({"latLng": latlng}, function(results, status)
			{
				if (status == google.maps.GeocoderStatus.OK)
				{
					if (results[0])
					{
						 

						   		for(var i=0; i < results[0].address_components.length; i++)
										{
										    var component = results[0].address_components[i];
										    if(component.types[0] == "postal_code")
										    {
										         document.getElementById('postalcode').value = component.long_name ;
										         document.getElementById('postalcode').disabled = false;
										    }
										     if(component.types[0] == "country")
										    {
										         document.getElementById('countr').value = component.long_name ;
										         document.getElementById('countr').disabled = false;
										    }
										    if(component.types[0] == "locality")
										    {
										         document.getElementById('localit').value = component.long_name ;
										          document.getElementById('localit').disabled = false;
										    }
										    if(component.types[0] == "street_number")
										    {
										         document.getElementById('street_numbe').value = component.short_name ;
										         document.getElementById('street_numbe').disabled = false;
										    }
										    if(component.types[0] == "route")
										    {
										         document.getElementById('rout').value = component.long_name ;
										         document.getElementById('rout').disabled = false;
										    }
										     if(component.types[0] == "administrative_area_level_1")
										    {
										         document.getElementById('state').value = component.short_name ;
										         document.getElementById('state').disabled = false;
										    }

										}
                               

					}

				}
			});	
              infoWindow.open(map, markerP);
              infoWindow.setContent('Ubicación actual');
            });

          },

          //****Error
          function(failure) {
            if(failure.message.indexOf('Sólo se permiten origenes seguros') == 0) {
            // Secure Origin issue.
            }
          });



        }else {
            // Browser doesn't support Geolocation
            infoWindow.setMap(map);
            //infoWindow.setPosition(map.getCenter());
            infoWindow.setPosition({lat: 20.42, lng: -99.18});
            infoWindow.setContent('Error: Geolocation no soportada');
        }



      }

		    </script> 

				    @endif

			@if($mode == 'viewlabor')
					<div class="box">
						<div class="box-header with-border">
								    <h3 class="box-title">Consultorios agregados</h3>
							    	<!-- /.box-tools -->
						</div>
					<div class="box-body"><br/>
						<div class="form-group">
				@foreach($labor->sortByDesc('created_at') as $labor)	

						<div class="pull-center">
							<div class="col-sm-8" style="padding-right: 0; padding-left: 0;">
					          <div class="info-box bg-gray">
					          	<a href="{{ url('workboardDr/index') }}/{{$labor->id}}"><span class="info-box-icon bg-black"><i class="fa fa-calendar"></i></span></a>
					            <div class="info-box-content">
					              <b>{{ $labor->workplace}}</b><br/>
					             <span class="text-black">{{ $labor->country }}, {{ $labor->state }}, {{ $labor->colony }}, {{ $labor->delegation }}, {{ $labor->street }} {{ $labor->streetNumber }}. CP: {{ $labor->postalcode }}</span><a href = "{{ url('doctor/delete') }}/{{ $labor->id }}" class="btn" onclick ="return confirm('¿Seguro desea eliminar este lugar?')"><i class="fa fa-trash text-muted"></i></a>
					     						        
					            </div>
					          </div>
					        </div>
					        <div class="col-sm-4" style="padding-right: 0; padding-left: 0;">
							<img border="0" src="//maps.googleapis.com/maps/api/staticmap?center={{ $labor->latitude }},{{ $labor->longitude }}&amp;markers=size:small%7Ccolor:black%7Clabel:%7C{{ $labor->latitude }},{{ $labor->longitude }}&amp;zoom=15&amp;style=element:geometry%7Ccolor:0xf5f5f5&amp;size=400x90&amp;key=AIzaSyCKh6YcZQgwbcbUBCftcAQq7rfL5bLW_6g" alt="ubicación"  style="width:100%; height: 91px;">
							</div>

						</div> <br> 
			
			@endforeach
			<br/>
			<div class="col-sm-6">&nbsp;</div>
								<div class="pull-right">
					    			<a href="{{ url('doctor/doctor') }}/{{ $userId }}" class="btn btn-secondary btn-block btn-flat">
						                Volver al Perfil
						            </a>
					            </div>
					        </div>

					</div>
					</div>   	
			@endif
@stop
@section('footer')

@if($mode == 'labor')
  <div class="box-body">
            @if($labor->isEmpty())
                         <span class="text-black">No hay ningún consultorio asociado a su cuenta.</span>
            @else
                    <span class="text-black" style="font-size: 12px;">Consultorios agregados recientemente</span>
                    @foreach($labor->sortByDesc('created_at') as $labor) 
                    
                                @if($loop->iteration < 3)

                                    <div class="pull-center">
                                      <div class="info-box sm bg-gray">
                                        <a href="{{ url('workboardDr/index') }}/{{$labor->id}}"><span class="info-box-icon sm bg-black"><i class="fa fa-calendar"></i></span></a>
                                        <div class="info-box-content sm">
                                          <b> {{ $labor->workplace}}</b>
                                         <span class="text-black">{{ $labor->country }}, {{ $labor->state }}, {{ $labor->colony }}, {{ $labor->delegation }}, {{ $labor->street }} {{ $labor->streetNumber }}.</span>
                                        </div>
                                      </div>
                                    </div>
                                        
                               @endif   
                               @if($loop->iteration > 2)
                               <div class="pull-right">
                                <a href="{{ url('doctor/laborInformationView') }}/{{ $userId }}" style="font-size: 11px;" class="text-muted">
                               Ver todos... <i class="fa fa-arrow-right"></i>
                               </a>
                               </div>
                               @break
                               @endif           
                    @endforeach

        @endif
</div>
    @endif

@stop

