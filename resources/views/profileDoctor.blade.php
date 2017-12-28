@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')
    <style type="text/css">

		.panel-title > a.collapsed:before {
		float: left !important;
		content:"\f067";
		}
		.panel-title > a:before {
		    float: left !important;
		    font-family: FontAwesome;
		    content:"\f068";
		    padding-left: 5px;
		    color: gray;
		    margin-right: 1em; 
		}
		#map {
			padding-top: 0;
		    width: 100%;
		    height: 350px;
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
				  document.getElementById('loadingGif').style.display = "block";
				  setTimeout(function(){ 
				  	document.getElementById('loadingGif').style.display = "none";
				  	window.location.reload(true);
				  },12000);
				     	}
			    //autoProcessQueue : false 
			 };
			 var val = "@php echo session()->get('val'); @endphp";
			 		if(val == "true"){
			 		setTimeout(function() {
					    $('#modal').modal({ backdrop: 'static' }, 'show');
					}, 1000);	
				}

				    
	</script>
	<br/>
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

	
	<!-- Modal photo settings-->
	<div id="modal" class="modal fade" role="dialog" style="width: 100%">
	    <div class="modal-dialog">
	        <div class="modal-content" >
	          	<div class="modal-header"><label for="recorte">Recorte de imagen:</label></div>
	          	<div class="modal-body" >
	                <div align="center">
	                   	<img src="https://s3.amazonaws.com/abiliasf/{{ $userId }}.jpg" id="target">
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

    <div class="box">
	  	<div class="box-header with-border">
		    <h3 class="box-title">Información de Médico</h3>
	    	<!-- /.box-tools -->
	  	</div>
	  	<div id="loadingGif" style="display:none" align="center"><center><h1><i class="fa fa-refresh fa-spin"></i> Cargando ...</h1></center></div>
	  	<!-- /.box-header -->
	  	<div class="box-body">
	  		@if( !empty($status) )

		  		@if ($status == "In Progress")
		  			<div class="callout callout-success">
		                <h4>Ya casi estamos listos {{ $firstname }} !!!</h4>

		                <p>Confirma y completa la información que esta debajo</p>
		            </div>
	    		@endif
	    		<!-- Photo Zone. -->
	    		<div class="row">
	    			<label class="col-sm-2 control-label" style="text-align: right;">Foto de perfil</label>
		    		<div class="col-sm-4" align="center">
		    			@if($photo == '')
			    	 		<img src="https://s3.amazonaws.com/abiliasf/profile-42914_640.png" alt="User Image"  style="width:150px; height: 150px;">
						@else
					@php 
					  $imagen = getimagesize($photo);    //Sacamos la información
			          $width = $imagen[0];              //Ancho
			          $height = $imagen[1];  

			          if($height > '500' || $width > '500'){
			            $height = $height / 2.5;
			            $width = $width / 2.5;
			        }
			        if($height > '800' || $width > '800'){
			            $height = $height / 4;
			            $width = $width / 4;
			        }


			          if($height < '400' || $width < '400'){
			            $height = $height / 1.3;
			            $width = $width / 1.3;
			        }

					@endphp
							<img src="{{ $photo }}" style="width:{{ $width }}px; height: {{ $height }}px;">			
				    	@endif 
		    			
		    		</div>
						<div class="col-sm-3" align="center"><form enctype="multipart/form-data" action="/doctor/updateDoctor/{{$userId}}" method="post" class="dropzone" id="myAwesomeDropzone"></form></div>
	    		</div>
	    		<!-- Photo Zone. -->
	    		<br/>

	    		<form action="/doctor/laborInformation/{{$userId}}" method="post" class="form-horizontal">
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
	                	<label for="professional_license" class="col-sm-2 control-label">Licencia Profesional</label>
	                	<div class="col-sm-10">
		                  	<input type="text" name="professional_license" id="professional_license" value="{{ $professional_license }}" class="form-control">
	                	</div>
	                	<!-- /.input group -->
	              	</div>
		            <div class="form-group">
	                	<label for="specialty" class="col-sm-2 control-label">Especialidad</label>
	                	<div class="col-sm-10">
		                  	<input type="text" name="specialty" id="specialty" value="{{ $specialty }}" class="form-control">
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
		            	<label for="autocomplete" class="col-sm-2 control-label">
		            		<i class="fa fa-location-arrow"></i>
		            	</label>
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
              <div class="box-group" id="accordion" aria-multiselectable="true">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
             
                <div class="panel box box-default" style="border-top-color: black;">
                
                 <div class="box-header with-border"> 
                 	<h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="a text-black" style="display:block; height:100%; width:100%;font-size: 17px;">
                        Información personal
                  </a>
              </h4>
                  	</div>
                   
                  <div id="collapseOne" class="panel-collapse collapse in" aria-labelledby="headingOne">

                    <div class="box-body">
                      <br/>

                      
                        <div class="col-sm-12">
                          <div class="row">
                            <div class="col-sm-4" align="left"><b>Correo:</b></div>
                            <div class="col-sm-8" align="left">{{ $email }}</div>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="row">
                            <div class="col-sm-4" align="left"><b>Nombre de usuario:</b></div>
                            <div class="col-sm-8" align="left">{{ $username }}</div>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="row">
                            <div class="col-sm-4" align="left"><b>Edad:</b></div>
                            <div class="col-sm-8" align="left">{{ $age }}</div>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="row">
                            <div class="col-sm-4" align="left"><b>Ocupación:</b></div>
                            <div class="col-sm-8" align="left">{{ $occupation }}</div>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="row">
                            <div class="col-sm-4" align="left"><b>Genero:</b></div>
                            <div class="col-sm-8" align="left">{{ $gender }}</div>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="row">
                            <div class="col-sm-4" align="left"><b>Escolaridad:</b></div>
                            <div class="col-sm-8" align="left">{{ $scholarship }}</div>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="row">
                            <div class="col-sm-4" align="left"><b>Estado civil:</b></div>
                            <div class="col-sm-8" align="left">{{ $maritalstatus }}</div>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="row">
                            <div class="col-sm-4" align="left"><b># Móvil:</b></div>
                            <div class="col-sm-8" align="left">{{ $mobile }}</div>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="row">
                            <div class="col-sm-4" align="left"><b>Ultima modificación:</b></div>
                            <div class="col-sm-8" align="left">{{ $updated_at }}</div>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
                <br/>
                <div class="panel box box-default" style="border-top-color: black;">
               <div class="box-header with-border">
               	<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="a text-black" style="display:block; height:100%; width:100%;font-size: 17px;">
                        Información Profesional
                </a>
            </h4>
                </div>
                  <div id="collapseTwo" class="panel-collapse collapse in" aria-labelledby="headingTwo">
                    <div class="box-body">
                            <div class="col-sm-12">
                          <div class="row">
                            <div class="col-sm-4" align="left"><b>Licencia Profesional:</b></div>
                            <div class="col-sm-8" align="left">{{ $professional_license }}</div>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="row">
                            <div class="col-sm-4" align="left"><b>Especialidad:</b></div>
                            <div class="col-sm-8" align="left">{{ $specialty }}</div>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="row">
                            <div class="col-sm-4" align="left"><b>Escuela de Medicina:</b></div>
                            <div class="col-sm-8" align="left">{{ $schoolOfMedicine }}</div>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="row">
                            <div class="col-sm-4" align="left"><b>Facultad de Especialización:</b></div>
                            <div class="col-sm-8" align="left">{{ $facultyOfSpecialization }}</div>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="row">
                            <div class="col-sm-4" align="left"><b>Práctica Profesional:</b></div>
                            <div class="col-sm-8" align="left">{{ $practiseProfessional }}</div>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
                <br/>
                <div class="panel box box-default" style="border-top-color: black;">
                	 <div class="box-header with-border">
                	 	<h4 class="panel-title">
                 <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" onclick="initMapAddressUser();" aria-expanded="false" aria-controls="collapseThree" class="a text-black" style="display:block; height:100%; width:100%;font-size: 17px;">	
                        Información Laboral      
                  </a> 
                  </h4> 
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse in" aria-labelledby="headingThree">
                    <div class="box-body">
                          @if($labor->isEmpty())
							<div class="box-footer">
										 <span class="text-black">No hay ningún centro asociado a su cuenta...</span>
							</div>
							
							@else
							
							<div class="box-footer">
							@foreach($labor as $labor)	
							
										@if($loop->iteration < 3)
											<div class="col-sm-12">
									          <div class="info-box sm bg-gray">
									          	@if($loop->iteration == 1)
									            <span class="info-box-icon sm bg-lighten-1"><i class="fa fa-hospital-o"></i></span>
									            @endif
									            @if($loop->iteration == 2)
									            <span class="info-box-icon sm bg-black"><i class="fa fa-hospital-o"></i></span>
									            @endif
									            <div class="info-box-content sm">
									              <b>{{ $labor->workplace}}</b><br/>
									              <span class="text-black">{{ $labor->country }}, {{ $labor->state }}, {{ $labor->colony }}, {{ $labor->delegation }}, {{ $labor->street }} {{ $labor->streetNumber }}. Código Postal: {{ $labor->postalcode }}</span>
									            </div>
									            <!-- /.info-box-content -->
									          </div>
									          <!-- /.info-box -->
									        </div>
									   @endif	
									   @if($loop->iteration > 2)
									   <div class="col-sm-11" style="text-align: right;">
									   	<form action="/doctor/laborInformation/{{$userId}}" method="post">
									   	<button type="submit" class="btn btn-secondary"><i class="fa fa-plus"></i>Agregar otro centro</button>
									   </form></div>
									   <div class="col-sm-1" style="text-align: right;">
									   	<a href="{{ url('doctor/laborInformationView') }}/{{ $userId }}" class="btn btn-default">
									   Ver todos... <i class="fa fa-arrow-right"></i>
									   </a>

									   </div>
									   @break
							 		   @endif			
							@endforeach
							</div>	 
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


    			window.onload = function(){
    			$('#collapseTwo').collapse("toggle");
				$('#collapseThree').collapse("toggle");
    				initAutocomplete();
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
	<link rel="stylesheet" href="{{ asset('css/jquery.Jcrop.css') }}" type="text/css" />
	<script src="{{ asset('js/jquery.color.js') }}"></script>
	<script src="{{ asset('js/jquery.Jcrop.js') }}"></script>
	  	</div>	  	
	</div>
	<script type="text/javascript">
    $(function(){ $.Jcrop('#target'); });
     $.Jcrop('#target',{
      aspectRatio: 1,
      onSelect: updateCoords,
	  setSelect: [0, 0, 300, 300],
      bgColor:     'black'
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
				   			<div class="box" style="padding-bottom:130px;">
							  	<div class="box-header with-border">
								    <h3 class="box-title">Información Laboral</h3>
							  	</div>
						  	<!-- /.box-header -->
				<div class="box-body">
					   <div id="buttonOpen" class="col-sm-12">
					      <button type="button" id="openform" class="btn btn-secondary btn-block btn-flat"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Ingresar Dirección</button>
					      <br/><br/>
					       <button type="button" id="openform2" class="btn btn-secondary btn-block btn-flat"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;Registrar por ubicación actual</button>
					   </div>

					<form action="/doctor/laborInformationNext/{{$userId}}" method="post" class="form-horizontal" id="form1" style="display:none">
					<div class="callout callout-default">
				 <div class="form-group">
	                	<label for="workplace" class="col-sm-2 control-label">Lugar de trabajo</label>
	                	<div class="col-sm-10">
		                  	<input type="text" name="workplace" id="workplace" value="" class="form-control">
	                	</div>
	                	<!-- /.input group -->
	              	</div>
	              	<div class="form-group">
	                	<label for="professionalPosition" class="col-sm-2 control-label">Posición Profesional</label>
	                	<div class="col-sm-10">
		                  	<input type="text" name="professionalPosition" id="professionalPosition" value="" class="form-control">
	                	</div>
	                </div>
	                	
		            <div class="form-group">
		            	<label for="autocomplete" class="col-sm-2 control-label">
		            		<i class="fa fa-location-arrow"></i>
		            	</label>
		            	<div id="locationField" class="col-sm-10">
					      	<input id="autocomplete" class="form-control" placeholder="Ingresa la dirección del centro de salud donde trabajas" onFocus="geolocate()" type="text"></input>
					    </div>
		            </div>

		            <div class="form-group">
		            	<label  class="col-sm-2 control-label">
		            	</label>
		            	
			            	<div class="col-sm-5">
			            		<input type="text" value="" class="form-control" name="street" id="street_number"  placeholder="Número de calle" {{ ( empty( $street ) ) ? 'disabled="true"' : '' }}></input>
			            	</div>
			            	<div class="col-sm-5">
			            		<input type="text" value="" class="form-control" name="colony" id="route" {{ ( empty( $colony ) ) ? 'disabled="true"' : '' }}></input>
			            	</div>
			        </div>
			        <div class="form-group">  
			        <label  class="col-sm-2 control-label">
		            	</label>  	
			            	<div class="col-sm-5">
			            		<input type="text" value="" class="form-control" name="delegation" id="locality" {{ ( empty( $delegation ) ) ? 'disabled="true"' : '' }} placeholder="Ciudad"></input>
			            	</div>
			            	<div class="col-sm-5">
			            		<input type="text" value="" class="form-control" name="state" id="administrative_area_level_1" placeholder="Estado" {{ ( empty( $state ) ) ? 'disabled="true"' : '' }}></input>
			            	</div>
			        </div>
			        <div class="form-group"> 
			        <label  class="col-sm-2 control-label">
		            	</label>  	
			            	<div class="col-sm-5">
			            		<input type="text" value="" class="form-control" name="postalcode" id="postal_code" {{ ( empty( $postalcode ) ) ? 'disabled="true"' : '' }} placeholder="Código postal"></input>
			            	</div>
			            	<div class="col-sm-5">
			            		<input type="text" value="" class="form-control" name="country" id="country" placeholder="País" {{ ( empty( $country ) ) ? 'disabled="true"' : '' }}></input>
			            	</div>
			         </div>
		         

		            <input type="hidden" name="latitude" id="latitude"/>
		            <input type="hidden" name="longitude" id="longitude"/>
		            <br/>
		            <!-- /.box-body -->
		            <div class="row">
					<div class="col-sm-4">
					            	&nbsp;
					            </div>
					       		<div class="col-sm-4">
						    		<button type="submit" class="btn btn-secondary btn-block btn-flat">
						                Guardar
						            </button>
					            </div>
					    		<div class="col-sm-4">
					    			<button type="button" id="cancel" class="btn btn-default btn-block btn-flat">Cancelar</button>
					            </div>
					            <div class="col-sm-4">
					            	&nbsp;
					            </div>
				 </div>
				 				</form>	


				</div>	

				<!-- form for map -->
		<form action="/doctor/laborInformationNext/{{$userId}}" method="post" class="form-horizontal" id="form2" style="display: none;">
			<div class="form-group">
			<div class="col-sm-5">
				<div class="col-sm-12">
					 <div class="form-group">
	                	<label for="workplace" class="col-sm-4 control-label">Lugar de trabajo</label>
	                	<div class="col-sm-8">
		                  	<input type="text" name="workplace" id="workplace" value="" class="form-control">
	                	</div>
	                	<!-- /.input group -->
	              	</div>
	              	<div class="form-group">

	                	<label for="professionalPosition" class="col-sm-4 control-label">Posición Profesional</label>
	                	<div class="col-sm-8">
		                  	<input type="text" name="professionalPosition" id="professionalPosition" value="" class="form-control">
	                	</div>
	                </div>
				</div>	
			<div class="col-sm-12">	
				<div class="col-sm-3">
					&nbsp;
				</div>
				<div class="col-sm-3"  align="right">
					<span class="info-box-icon btn bg-black" onclick="initMap();"><i class="fa fa-map-marker"></i><br/>Ubícame</span>
				</div>
				<div class="col-sm-4">	 
				  <input type="text" name="lati" id="lati" class="form-control" disabled="true" />
				<br/>
		          <input type="text" name="long" id="long" class="form-control" disabled="true"/>
		      </div>
		      <div class="col-sm-2">
					&nbsp;
				</div>
			</div>
			<div class="col-sm-12">
				<br/>
					  <div class="form-group">
		            	
			            	<div class="col-sm-6">
			            		<input type="text" class="form-control" name="street" id="street_numbe" disabled="true"></input>
			            	</div>
			            	<div class="col-sm-6">
			            		<input type="text" class="form-control" name="colony" id="rout" disabled="true"></input>
			            	</div>
			        </div>

			        <div class="form-group">  
			            	<div class="col-sm-6">
			            		<input type="text" value="" class="form-control" name="delegation" id="localit" disabled="true"></input>
			            	</div>
			            	<div class="col-sm-6">
			            		<input type="text" value="" class="form-control" name="state" id="state" disabled="true" placeholder="Estado"></input>
			            	</div>
			        </div>
			        <div class="form-group"> 
			            	<div class="col-sm-6">
			            		<input type="text" class="form-control" name="postalcode" id="postalcode" disabled="true" placeholder="Código Postal"></input>
			            	</div>
			            	<div class="col-sm-6">
			            		<input type="text" value="" class="form-control" name="countr" id="countr" placeholder="País" disabled="true"></input>
			            	</div>
			         </div>
				</div>
				<div class="col-sm-12">
					       		<div class="col-sm-6">
						    		<button type="submit" class="btn btn-secondary btn-block btn-flat">
						                Guardar
						            </button>
					            </div>
					    		<div class="col-sm-6">
					    			<button type="button" id="cancel2" class="btn btn-default btn-block btn-flat">Cancelar</button>
					            </div>
				</div>
			</div>
			<div class="col-sm-7">
		  	<div id="map"></div>
		  </div></div>
		  <input type="hidden" name="ub" id="ub" value="true"></input>
		</form>
			</div>





			<div class="footer">
			@if($labor->isEmpty())
			<div class="box-footer">
						 <span class="text-black">No hay ningún centro asociado a su cuenta...</span>
			</div>
			
			@else
			
			<div class="box-footer">
			@foreach($labor as $labor)	
			
						@if($loop->iteration < 3)
							<div class="col-sm-12">
					          <div class="info-box sm bg-gray">
					          	@if($loop->iteration == 1)
					            <span class="info-box-icon sm bg-lighten-1"><i class="fa fa-hospital-o"></i></span>
					            @endif
					            @if($loop->iteration == 2)
					            <span class="info-box-icon sm bg-black"><i class="fa fa-hospital-o"></i></span>
					            @endif
					            <div class="info-box-content sm">
					              <b>{{ $labor->workplace}}</b><br/>
					              <span class="text-black">{{ $labor->country }}, {{ $labor->state }}, {{ $labor->colony }}, {{ $labor->delegation }}, {{ $labor->street }} {{ $labor->streetNumber }}. Código Postal: {{ $labor->postalcode }}</span>
					            </div>
					            <!-- /.info-box-content -->
					          </div>
					          <!-- /.info-box -->
					        </div>
					   @endif	
					   @if($loop->iteration > 2)
					   <div class="col-sm-12" style="text-align: right;">
					   	<a href="{{ url('doctor/laborInformationView') }}/{{ $userId }}" class="btn btn-default">
					   Ver todos... <i class="fa fa-arrow-right"></i>
					   </a>
					   </div>
					   @break
			 		   @endif			
			@endforeach
			</div>	 
			@endif
			</div>


				
    		<script type="text/javascript">

    		$(document).ready(function() {
				$("#openform").click(
				function(event) {
				   $("#buttonOpen").hide();
				   document.getElementById("form1").style.display = "block";
				})
				$("#openform2").click(
				function(event) {
				   $("#buttonOpen").hide();
				   document.getElementById("form2").style.display = "block";
				   initMap();
				 
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
					else
					{
						 document.getElementById('dir').value = "No se ha podido obtener ninguna dirección en esas coordenadas";
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
					else
					{
						 document.getElementById('dir').value = "No se ha podido obtener ninguna dirección en esas coordenadas";
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
								    <h3 class="box-title">Registro de Centros Laborales</h3>
							    	<!-- /.box-tools -->
						</div>
					<div class="box-body"><br/>
				@foreach($labor as $labor)	
			

							<div class="col-sm-12">
					          <div class="info-box bg-gray">
					            <span class="info-box-icon bg-black"><i class="fa fa-hospital-o"></i></span>
					            <div class="info-box-content">
					              <b>{{ $labor->workplace}}</b><br/>
					              <span class="text-black">{{ $labor->country }}, {{ $labor->state }}, {{ $labor->colony }}, {{ $labor->delegation }}, {{ $labor->street }} {{ $labor->streetNumber }}. Código Postal: {{ $labor->postalcode }}</span>
					            </div>
					            <!-- /.info-box-content -->
					          </div>
					          <!-- /.info-box -->
					        </div><br/>    
			
			@endforeach
			<div class="col-sm-6">&nbsp;</div>
								<div class="col-sm-6">
					    			<a href="{{ url('doctor/doctor') }}/{{ $userId }}" class="btn btn-secondary btn-block btn-flat">
						                Volver al Perfil
						            </a>
					            </div>
			

					</div>
					</div>   	
			@endif
@stop