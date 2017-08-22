@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')
    <!-- <h1>Perfil de usuario</h1> -->
@stop

@section('content')

	<br/>

	@if( empty($status) )

		<div class="lockscreen-item" style="margin: 10px 0 30px auto;">
		    <!-- lockscreen image -->
		    <div class="lockscreen-image">
		      <img src="https://adminlte.io/themes/AdminLTE/dist/img/user1-128x128.jpg" alt="User Image">
		    </div>
		    <!-- /.lockscreen-image -->

		    <!-- lockscreen credentials (contains the form) -->
		    <form class="lockscreen-credentials" action="/user/edit/complete" method="post">
		    	{{ csrf_field() }}
		      	<div class="input-group">
		        	<div class="form-control">{{ $username }}</div>
		        	<input type="hidden" name="id" value="{{ $userId }}">
		        	<div class="input-group-btn">
			          	<button type="button" class="btn">
			          		<i class="fa fa-pencil text-muted"></i>
			          	</button>
		        	</div>
		      	</div>
		    </form>
		    <!-- /.lockscreen credentials -->

		</div>

	@endif

    <div class="box">
	  	<div class="box-header with-border">
		    <h3 class="box-title">Información</h3>
	    	<!-- /.box-tools -->
	  	</div>
	  	<!-- /.box-header -->
	  	<div class="box-body">
	  		@if( !empty($status) )

		  		@if ($status == "In Progress")
		  			<div class="callout callout-success">
		                <h4>Ya casi estamos listos {{ $firstname }} !!!</h4>

		                <p>Confirma y completa la información que esta debajo</p>
		            </div>
	    		@endif

	    	
	    		<form action="/user/update/{{$userId}}" method="post" class="form-horizontal">
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

		            <div align="right">
		            	<div class="row" style="width: 90%;" >
			            	<div class="col-sm-6">
			            		<input type="text" class="form-control" name="street" id="street_number"  placeholder="Número de calle" disabled="true"></input>
			            	</div>
			            	<div class="col-sm-6">
			            		<input type="text" class="form-control" name="colony" id="route" disabled="true">
			            	</div>
			            </div>
						<br />              	
		              	<div class="row" style="width: 90%;" >
			            	<div class="col-sm-6">
			            		<input type="text" class="form-control" name="delegation" id="locality" disabled="true" placeholder="Ciudad"></input>
			            	</div>
			            	<div class="col-sm-6">
			            		<input type="text" class="form-control" name="state" id="administrative_area_level_1" placeholder="Estado" disabled="true"></input>
			            	</div>
			            </div>
						<br />
			            <div class="row" style="width: 90%;" >
			            	<div class="col-sm-6">
			            		<input type="text" class="form-control" name="postalcode" id="postal_code" disabled="true" placeholder="Código postal"></input>
			            	</div>
			            	<div class="col-sm-6">
			            		<input type="text" class="form-control" name="country" id="country" placeholder="País" disabled="true"></input>
			            	</div>
			            </div>
		            </div>

		            <input type="hidden" name="latitude" id="latitudeFend" />
		            <input type="hidden" name="longitude" id="longitudeFend" />

		            <!-- /.box-body -->
				  	<div class="box-footer">
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
				            	&nbsp;
				            </div>
				    	</div>
				  	</div>
				  	<!-- box-footer -->

	    		</form>

	    	@else
    			aquí va a ir el contenido.
    		@endif



    		<script type="text/javascript">
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
	  	</div>	  	
	</div>

@stop