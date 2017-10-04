@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

    Programa tu Consulta {{ $username }}

@stop

@section('content')
    
<!-- Starts map -->
    <script type="text/javascript">
      var loc = [];

      var specialities = [["Alergología"], ["Cardiología"], ["Gastroenterología"], ["Geriatría"], ["Infectología"], ["Neumología"], ["Neurología"], ["Nutriología"], ["Oftalmología"], ["Oncología"], ["Pediatría"], ["Psiquiatría"], ["Rehabilitación"], ["Reumatología"], ["Toxicología"], ["Odontología"]];

      var datos = [["Alergología", 19.3605334,-99.22670670000002, "Alicia García Vega", "Hospital Arcángel"], ["Cardiología", 19.4846606, -99.18867490000002, "Marcos Ortega Acevedo", "Clínica Ortega"], ["Gastroenterología", 19.3794059, -99.15914459999999, "Cristóbal Torres Escudero", "Consultorio Escudero"], ["Geriatría", 19.3437444, -99.1561883, "Gonzalo Flores Alarcón", "Hospital Arcángel"], ["Infectología", 19.3631419, -99.28805969999996, "Damián Suarez Fonseca", "Hospital DEF"], ["Neumología", 19.4356338, -99.14951070000001, "Humberto Ramos Mora", "Consultorio Ramos Mora"], ["Neurología", 19.4873329, -99.12361340000001, "Fernando Ortiz Álamo", "Hospital Arcángel"], ["Nutriología", 19.3948036, -99.09768079999998, "Beatriz Fuentes Galindo", "Servicios Médicos Fuentes"], ["Oftalmología", 19.342083, -99.0532159, "Lucía Medina Arenas", "Clínica Venecia"], ["Oncología", 19.3149641, -99.24258859999998, "Valeria Guerrero Ibáñez", "Hospital Arcángel"], ["Pediatría", 19.409044, -99.19057579999998, "Sergio Vega Infante", "Hospital Arcángel"], ["Psiquiatría", 19.1942041, -99.02670760000001, "Porfirio Soto Cuevas", "Hospital Arcángel"], ["Rehabilitación", 19.2990233, -99.04364670000001, "Elías Vidal Íñigo", "Hospital Arcángel"], ["Reumatología", 19.2790911, -99.2114234, "Inés Salazar Lara", "Hospital DTC"], ["Toxicología", 19.4395911, -99.1131054, "Elena Ríos Macías", "Hospital DTC"], ["Odontología", 19.2572314, -99.10296640000001, "Adrián Rivera Llamas", "Hospital DTC"], ["Alergología", 19.3605334,-99.32670670000002, "Sara Lozano Alcántara", "Hospital DTC"], ["Cardiología", 19.4846606, -99.28867490000002, "Oswaldo Robles Alfaro", "Hospital DTC"], ["Gastroenterología", 19.3794059, -99.25914459999999, "Patricia Caballero Manzano", "Hospital DTC"], ["Geriatría", 19.3437444, -99.2561883, "Martín Aguirre Olivera", "Hospital DTC"], ["Infectología", 19.3631419, -99.38805969999996, "Octavio Garrido Quiroga", "Hospital DTC"], ["Neumología", 19.4356338, -99.24951070000001, "Magdalena Cruz Orozco", "Hospital DEF"], ["Neurología", 19.4873329, -99.22361340000001, "Alvaro Gutiérrez Quintana", "Hospital DEF"], ["Nutriología", 19.3948036, -99.19768079999998, "David Romero Acosta", "Clínica Acosta"], ["Oftalmología", 19.342083, -99.1532159, "Bernardo Gil Montoya", "Hospital DEF"], ["Oncología", 19.3149641, -99.34258859999998, "Gisela Rojas Palma", "Hospital DEF"], ["Pediatría", 19.409044, -99.29057579999998, "Natalia Reyes Salgado", "Hospital DEF"], ["Psiquiatría", 19.1942041, -99.12670760000001, "Marcelo Campos Uribe", "Hospital DEF"], ["Rehabilitación", 19.2990233, -99.14364670000001, "Teresa Luna Carmona", "Clínica Venecia"], ["Reumatología", 19.2790911, -99.3114234, "Irene Morales Alcalá", "Clínica Cruces"], ["Toxicología", 19.4395911, -99.2131054, "Fabián Castillo Valencia", "Hospital Luna"], ["Odontología", 19.2572314, -99.20296640000001, "Adela Molina Zamora", "Clínica Venecia"]];
    </script>

    <form>
    <input type="checkbox" name="general" id="general" onchange="ocultar();"> Médico General<br>

    <br/>
    <div id="selectSp">
    <strong> Selecccionar especialidad  </strong>
      <select id="mySelect" size="1" >
        <!-- <option>- Select Speciality -</option> -->
        <option>- Ninguna -</option>
      </select>

      <br/><br/>
    </div>
    <strong> Institución  </strong><input type="text" name="franquicia" id="d1"><br>
    </form>

    <script type="text/javascript">
        var x = document.getElementById("mySelect");    
        for (var i = 0; i < specialities.length; i++) {
        var c = document.createElement("option");
        c.text = specialities[i][0];
        x.options.add(c, 1);
        }
    </script>

    <br/>
    <button type="button" onclick="start()"> Buscar </button>
    <br/><br/>
    <p id="demo"></p>
    
    <div id="map" class="tab-pane" style="height: 250px;"></div>

    <br/><br/>
    <p id="info"></p>

    <script type="text/javascript">
      function start(){
	  	var x = document.getElementById("mySelect");
        var s = x.selectedIndex;
        var fran = document.getElementById("d1").value;
        
        if(fran != '')
        	console.log('FRAN:: '+fran);

        if( x.options[s].text == "- Ninguna -"){
        	console.log('Valor NULO:: '+x.options[s].text);
        	clearMarkers();
        	document.getElementById("demo").innerHTML = 'Seleccione una especialidad.';
        	document.getElementById("info").innerHTML = ' ';
        }
        if( x.options[s].text !== "- Ninguna -"){
        	console.log('Valor VÁLIDO:: '+x.options[s].text);
        	myFunction2();
	  		drop();
        }
	  }

	  function ocultar(val){
	  	var gen = '';

        if (document.getElementById('general').checked) {
		  gen = document.getElementById("general").value;
		  console.log('GEN:: '+gen);
		  document.getElementById('selectSp').style.display = 'none';
		}else{
			console.log('GEN:: '+gen);
			document.getElementById('selectSp').style.display = 'block';
		}
	  }

	</script>

    <script type="text/javascript">

      var markers = [];
      var map;
      var infoWindow;

      window.onload = function(){
	    initMap();
	  };

      function initMap() {
      	var marker;
        var image = "{{ asset('maps-and-flags_1.png') }}";
        
        infoWindow = new google.maps.InfoWindow();

      	//Current position
      	if (navigator.geolocation) {

          console.log('Pos');
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            //Map
	        map = new google.maps.Map(document.getElementById('map'), {
	          zoom: 6,
	          center: new google.maps.LatLng(pos),//{lat: 20.42, lng: -99.18}
	        });

            marker = new google.maps.Marker({
              position: new google.maps.LatLng(pos),
              icon: image,
              map: map
            });

            marker.addListener('mouseover', function() {
              infoWindow.open(map, marker);
              infoWindow.setContent('Su ubicación');
            });
          });
        } else {
            // Browser doesn't support Geolocation
            infoWindow.setMap(map);
            //infoWindow.setPosition(map.getCenter());
            infoWindow.setPosition({lat: 20.42, lng: -99.18});
            infoWindow.setContent('Error: Your browser doesn\'t support geolocation.');
        }
      }

      //Filter
      function myFunction2() {
        var res = [];
        loc = [];

        var x = document.getElementById("mySelect");
        var s = x.selectedIndex;

        if( x.options[s].text == "- Ninguna -")
        	console.log('Valor NULO:: '+x.options[s].text);
        if( x.options[s].text !== "- Ninguna -")
        	console.log('Valor VALIDO:: '+x.options[s].text);

        for(var i = 0; i < datos.length; i++) {
          if(datos[i][0] == x.options[s].text){
            console.log(datos[i][0]);
            console.log(x.options[s].text);

             res.push([datos[i][1], datos[i][2], datos[i][0], datos[i][3], datos[i][4]]);

             //loc[latitud, longitud, especialidad, nombre, hospital, dirección]
             loc.push([datos[i][1], datos[i][2], datos[i][0], datos[i][3], datos[i][4]]);
          }
        }

        console.log(loc);
        console.log(loc[0]);
        console.log(loc[1]);
        
        console.log(res);
        document.getElementById("demo").innerHTML = '<strong>Mostrando resultados para '+ res[0][2] +'</strong>';
      }

      function drop() {
        clearMarkers();
        for (var i = 0; i < loc.length; i++) {
        	var lat = loc[i][0];
        	var lon = loc[i][1];
        	console.log(lat);
        	console.log(lon);

          //addMarkerWithTimeout(lat, lon, i * 100);

          	markers[i] = new google.maps.Marker({
	          position: new google.maps.LatLng(lat,lon),
	          animation: google.maps.Animation.DROP
	        });

          	var infowindow = new google.maps.InfoWindow();
          	var marker = markers[i];

          	google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
            return function() {
              infowindow.setContent("<b>"+loc[i][2]+"</b><br/>"+loc[i][3]+"</b><br/>"+loc[i][4]);
              infowindow.open(map, marker);
              console.log(marker);
              showInfo("<b>"+loc[i][2]+"</b><br/>"+loc[i][3]+"</b><br/>"+loc[i][4]);
            }
          })(marker, i));


	        setTimeout(dropMarker(i), i * 250);
        }
      }

      function dropMarker(i) {
        return function() {
          markers[i].setMap(map);
        };
      }

      function clearMarkers() {
        for (var i = 0; i < markers.length; i++) {
          markers[i].setMap(null);
        }
        markers = [];
      }

      function showInfo(info){
      	document.getElementById("info").innerHTML = '<strong>Seleccionado: <br/>'+ info +'</strong>';
      }
    </script>

@stop