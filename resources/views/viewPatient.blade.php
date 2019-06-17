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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>

	  	<!-- /.box-header -->
	
	@if(empty($status))

	    <section class="content">

	      	<div class="row">
		        <div class="col-md-3">
		        	<div class="box box-default">
			            <div class="box-body box-profile">

			            	@if($pphoto == '')
					    	 	<img class="profile-user-img img-responsive img-circle" src="{{ asset('profile-42914_640.png') }}" alt="User Image"  style="width:150px; height: 150px;">
							@else
								@php 
								  $imagen = getimagesize($pphoto);    //Sacamos la información
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
								<img class="profile-user-img img-responsive img-circle" src="{{ $pphoto }}?{{ \Carbon\Carbon::now()->format('h:i') }}" style="width:{{ $width }}px; height: {{ $height }}px;" >			
					    	@endif 

			              	

			              	<h3 class="profile-username text-center">{{ $pfirstname }}</h3>

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
				                	<!--
									 	##HDHM#### tengo que validar que cuando el médico no tenga preguntas agregadas se deshabilite este botón
									-->

				                	<a href="#" id="initAttentionMedicalButton" onclick="medicalAttention('viewPatientBlade'); loadMedicines();" class="btn btn-secondary btn-flat btn-block">
				                		Iniciar atención médica
				                	</a>
				                
				                </li>
				            </ul>
			            </div>
			            <!-- /.box-body -->
			        </div>
			        
	                <div class="box box-default">
			            <div class="box-header with-border">
			              	<h3 class="box-title">Información adicional</h3>
			            </div>
			            <div class="box-body">
			            	<strong><i class="fa fa-book margin-r-5"></i> Educación</strong>
			            	<p class="text-muted">
				              	@if(empty($scholarship) && empty($occupation))
				                	<a href="#">Agregar información</a>
								@endif
				            </p>
				            <hr />
				            <strong><i class="fa fa-map-marker margin-r-5"></i> Dirección</strong>
				            <p class="text-muted">
				              	@if(empty($colony) && empty($state))
				                	<a href="#">Agregar dirección</a>
				                @elseif(empty($colony) && !empty($state))
				                	<a href="#">Agregar colonia</a>, {{$state}} {{$country}}
				                @elseif(!empty($colony) && empty($state))
				                	{{ $colony }}, <a href="#">Agregar estado</a> {{$country}}
				                @endif
							</p>
							<hr />
							<strong><i class="fa fa-pencil margin-r-5"></i> Prescripción médica actual</strong>
				            <p><span class="label label-info">{{$current_prescription}}</span></p>
				            <strong><i class="fa fa-file-text-o margin-r-5"></i> Miembro desde</strong>
				            <p>{{$created_at}}</p>
			            </div>    
				    </div>
		        </div>

		        <div class="col-md-9"> 

		        	@include('tabs.tabsviewpatient', [

			    			'latitude' 		=>  $latitude,
			    			'longitude'		=>  $longitude,
			    			'nodes' 		=>  $nodes,
			    			'pusername'		=>	$pusername,
							'agep'			=>	$agep,
							'occupation'	=>	$occupation,
							'gender'		=>	$gender,
							'maritalstatus'	=>	$maritalstatus,
							'scholarship'	=>	$scholarship,
							'updated_at'	=>	$updated_at,
							'patientId'		=>  $patientId,
							'questions_appointments'	=> $questions_appointments,
							'clinic_history_appointments'	=> $clinic_history_appointments,
							'questions' 	=> $questions
		    			]
		    		)
		        </div>		          
	    	</div>
	    </section>
	@endif
    <script type="text/javascript">

    	function byId(argument) {
    		return document.getElementById(argument);
    	}

    	function medicalAttention(from) {
    		byId('initAttentionMedicalButton').style.display = 'none';
    		if(from == "viewPatientBlade"){
    			byId('medicalAttentionTab').style.display = 'block';
				byId('medicalAttentionLink').style.display = 'block';

				var activeItem = document.getElementsByClassName('active tab-pane');
				activeItem[0].className = 'tab-pane';

				byId('medicalAttentionTab').className = 'active tab-pane';
				byId('medicalAttentionLink').className = 'active tab-pane';
    		}else{

    			byId('activity').className = 'active tab-pane';
    			byId('initAttentionMedicalButton').style.display = 'block';

    			byId('medicalAttentionTab').style.display = 'none';
				byId('medicalAttentionLink').style.display = 'none';

				byId('medicalAttentionTab').className = 'tab-pane';
				byId('medicalAttentionLink').className = 'tab-pane';
    		}   		
    	}

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
		                     				$('#resp').append('<div style="margin-left:5%;"><img src="{{ asset("profile-42914_640.png") }}" class="img-circle" style="width:25px; height:25px;"><a data-id="'+ data[i]['id'] +'" data-value="'+ data[i]['name'] +'" onclick="fun(this);" class="btn text-muted" style="text-align: left;white-space: normal;">'+ data[i]['name'] +'</a></div>');
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

		      		@if($latitude != "" && $longitude != "")

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

					@endif

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

