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

	  	<!-- /.box-header -->
	
	  		@if(empty($status))

    <section class="content">

      	<div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-default">
            <div class="box-body box-profile">

            	@if($photo == '')
		    	 		<img class="profile-user-img img-responsive img-circle" src="https://s3.amazonaws.com/abiliasf/profile-42914_640.png" alt="User Image"  style="width:150px; height: 150px;">
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
	                 	<b>Familiares</b> <a class="pull-right">2</a>
	                </li>
	                <li class="list-group-item">
	                  	<b>No. de citas</b> <a class="pull-right">1</a>
	                </li>
	            </ul>

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
              <strong><i class="fa fa-book margin-r-5"></i> Educación</strong>

              <p class="text-muted">
              	@if(empty($scholarship) && empty($occupation))
                	<a href="#">Agregar información</a>
                @elseif(empty($scholarship) && !empty($occupation))
                	<a href="#">Agregar Escolaridad</a> / {{ $occupation }}
                @elseif(!empty($scholarship) && empty($occupation))
                	{{ $scholarship }} / <a href="#">Agregar ocupación</a>
                @endif
              </p>

              <hr>

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

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Prescripción médica actual</strong>

              <p>
                <span class="label label-info">{{$current_prescription}}</span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Miembro desde</strong>
              <p>{{$created_at}}</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        	<div class="col-md-9">
        		<div class="nav-tabs-custom">
		            <ul class="nav nav-tabs">
		              	<li class="active"><a href="#activity" data-toggle="tab">Detalle</a></li>
		              	<li><a href="#family" id="familyOption" data-toggle="tab">Familia</a></li>
		              	<li><a href="#address" onclick="initMapAddressUser();" data-toggle="tab">Dirección</a></li>
		            </ul>
		            <div class="tab-content">
		            	<div class="active tab-pane" id="activity">

	                        <div class="row">
	                          
	                            <div class="col-sm-3" align="left"><b>Nombre de usuario:</b></div>
	                            <div class="col-sm-9 cut" align="left">{{ $username }}</div>
	                         
	                        </div>
	                        <div class="row">
	                          
	                            <div class="col-sm-3" align="left"><b>Edad:</b></div>
	                            <div class="col-sm-9" align="left">{{ $age }}</div>
	                         
	                        </div>
	                        <div class="row">
	                         
	                            <div class="col-sm-3" align="left"><b>Ocupación:</b></div>
	                            <div class="col-sm-9 cut" align="left">{{ $occupation }}</div>
	                         
	                        </div>
	                        <div class="row">
	                        
	                            <div class="col-sm-3" align="left"><b>Genero:</b></div>
	                            @if($gender == "female")
	                            	<div class="col-sm-9" align="left">{{ trans('adminlte::adminlte.female') }}</div>
	                            @endif
	                            @if($gender == "male")
	                            	<div class="col-sm-9" align="left">{{ trans('adminlte::adminlte.male') }}</div>
	                            @endif
	                            @if($gender == "other")
	                            	<div class="col-sm-9" align="left">{{ trans('adminlte::adminlte.other') }}</div>
	                            @endif
	                      
	                        </div>
	                        <div class="row">
	                         
	                            <div class="col-sm-3" align="left"><b>Escolaridad:</b></div>
	                            <div class="col-sm-9 cut" align="left">{{ $scholarship }}</div>
	                    
	                        </div>
	                        <div class="row">
	                         
	                            <div class="col-sm-3" align="left"><b>Estado civil:</b></div>
	                              @if($maritalstatus == "single")
	                            <div class="col-sm-9" align="left">{{ trans('adminlte::adminlte.single') }}</div>
	                             @endif
	                            @if($maritalstatus == "married")
	                            <div class="col-sm-9" align="left">{{ trans('adminlte::adminlte.married') }}</div>
	                             @endif	
	                      
	                        </div>
		         	    </div>
		         	    <div class="tab-pane" id="family">
		         	    	

	                    	<div id="diagramFamily"></div>


	                    	<!-- modals add family member & session as child -->
	                    	
	                    	@include('modals.addFamilyMember')
	                    	@include('modals.sessionAsParentChild')
	                    	
	                    	<!-- modals add family member & session as child -->

	                    	<script type="text/javascript">
	                    		
	                    		$('#familyOption').on('click', function(e) {
       				 				e.preventDefault();
       				 				document.getElementById('diagramFamily').innerHTML='';
									+ function(d3) {
							/* Para centrar globos charge junta globos secundarios o los exparce más, y variable w, restarle o sumarl dependiendo el panel en donde se ve */			
									var swatches = function(el) {
										var circleWidth = 45;	
										var charge = -700;//800
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
								            }else{
								              h-=315;
								              w-=100;
								              circleWidth = 30;
											 charge = -300;
								            }
								       	 }else{
								          h = window.screen.availHeight-375;
								          w = window.screen.availWidth-550;//100
								           circleWidth = 53;
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
										  		$('#init1').css({ 'display': "none" });
												$('#init').css({ 'display': "none" });
										  	}else{
										  		$('#idpa').val(d.id);
										  		$('#init1').css({ 'display': "none" });
												$('#init').css({ 'display': "none" });
										  	}
										  }
										  	$("#modalfamily2").modal('toggle');
										  }
										}
									force.start();

								  }('#diagramFamily');

								}(window.d3);
								  });

	                    	</script>

		         	    </div>
		         	    <div class="tab-pane" id="address">

		         	    	<div align="center">
		         	    		
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
    	</div>
    </section>
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

