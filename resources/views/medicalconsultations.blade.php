@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content')
    
  <style type="text/css">
      #mapaC{
        position: relative;
        height: 100%;
        width: 100%;
      } 
      #map{
        position: relative;
        width: 100%;
        z-index: 30;
      }
      #rango{ 
        position: absolute;
        width: 70%; 
        bottom: 4.5%;
        left: 15%;
        right: 15%;
        padding-top: 0.7%;
        padding-bottom: 0%;
        padding-right: 0.7%;
        padding-left: 0.7%;
        /*background-color: rgba(255,255,255,0.7);*/
        z-index: 100;
        text-align: center;
        font-size: 90%;
        line-height: 15%;
      }
      #searchDiv{
        position: absolute;
        width: 24%;
        top: 4.5%;
        right: 4%;
        padding-top: 0.5%;
        padding-bottom: 0.5%;
        padding-right: 0.1%;
        padding-left: 0.1%;
        background-color: rgba(255,255,255,0.6);
        z-index: 100;
        text-align: center;
        font-size: 90%;
        line-height: 15%;        
      }
      .rangeStyle{
        height: 1%;
        width: 100%;
        
      }
      .checkStyle{
        position: absolute;
        top: 4.5%;
        left: 1%;
        background-color: rgba(255,255,255,0.8);
        z-index: 100;
        font-size: 90%;
        line-height: 15%;
        padding-top: 0.5%;
        padding-bottom: 0.5%;
        padding-right: 0.5%;
        padding-left: 0.5%;
        border-radius: 1px;
      }
     .checkStyl2{
        position: absolute;
        bottom: 4.5%;
        left: 1%;
        z-index: 100;
        font-size: 90%;
        line-height: 15%;
        padding-top: 0.5%;
        padding-bottom: 0.5%;
        padding-right: 0.5%;
        padding-left: 0.5%;
      }
      .infoSpStyle{
        position: absolute;
        top: 19%;
        right: 1%;
        background-color: rgba(255,255,255,0.8);
        z-index: 100;
        font-size: 90%;
        padding-right: 0.5%;
        padding-left: 0.5%;
      }
      .launchSearchStyle{
        position: absolute;
        top: 7%;
        right: 1%;
        /*background-color: rgba(255,255,255,0.8);
        z-index: 100;
        font-size: 90%;
        padding-right: 0.5%;
        padding-left: 0.5%;*/
      }
      .textStyle01{
        color: #424242;
        text-shadow: 1px 1px 0.5px #424242;
      }
      .content{
        padding-left: 1px;
        padding-right: 1px;
        padding-top: 0px;
      }
      .content-header {
          position: relative;
          padding: 1px 1px 0 1px; 
      }
      /*** Range
      /*General format*/
      input[type='range'] {
        display: block;
        width: 100%;
        height: 100%;
        margin: 18px 0;
      }
      /*Removes the blue border*/
      input[type='range']:focus {
        outline: none;
      }
      input[type=range]:focus::-webkit-slider-runnable-track {
        outline: none;
      }
      /*Unstyled range input*/
      input[type='range'],
      input[type='range']::-webkit-slider-runnable-track,
      input[type='range']::-webkit-slider-thumb {
        -webkit-appearance: none;
      }
      /*Thumb Chrome*/
      input[type=range]::-webkit-slider-thumb {
        background-color: #000;
        width: 20px;
        height: 20px;
        border: 3px solid #000;
        border-radius: 50%;
        margin-top: -9px;
      }
      /*Thumb Mozilla*/
      input[type=range]::-moz-range-thumb {
        background-color: #000;
        width: 15px;
        height: 15px;
        border: 3px solid #000;
        border-radius: 50%;
      }
      /*Thumb Edge*/
      input[type=range]::-ms-thumb {
        background-color: #000;
        width: 20px;
        height: 20px;
        border: 3px solid #000;
        border-radius: 50%;
      }
      /*Track Chrome*/
      input[type=range]::-webkit-slider-runnable-track {
        background-color: #000;
        height: 3.5px;
      }
      /*Color barra Mozilla*/
      input[type=range]::-moz-range-track {
        background-color: #000;
        height: 3px;
      }
      /*Track Edge*/
      input[type=range]::-ms-track {
        width: 100%;
        height: 2.4px;
        background-color: #000;
        height: 3px;
      }
     /****/
     /* Modal */
     .modal-header, h4, .close {
          color:black;
          text-align: center;
          font-size: 100%;
          font-weight: bold;
      }
      .btn-default {
          box-shadow: 1px 2px 5px #000000;   
      }
    
  </style>

  <!--  -->
  <script type="text/javascript">
    /**
     * Text of labels
     */
    var title = "Programar Cita";
    var check01 = "Médico General";
    var select01 = "Seleccionar especialidad";
    var firstValue = '- Ninguna -';
    var fieldSearch = 'Buscar';//'Nombre del Médico';
    var Rango01 = 'Rango de búsqueda (metros):';
    var Rango02 = 'Rango de búsqueda predefinido (metros):';
    var Rango03 = 'Rango de búsqueda actual (metros):';
    var Button02 = 'Mostrar filtros';
    var Button01 = 'Buscar';
    var error01 = 'Seleccione una especialidad';
    var error02 = 'No se encontraron coincidencias';
    var message01 = 'Su ubicación';
    var message02 = 'Sólo se permiten origenes seguros';
    var message03 = 'Error: Geolocation no soportada';
    var result01 = 'Mostrando resultados para';
    var result02 = 'Metros a la redonda';
    /**
     * Variables
     */
    var markerP;
    var loc = [];
    var typeC = 'TypeGeneral';
    var startProcess = false;
    /**
     * Information loader
     */
    var specialities = [@php echo implode(',', array_unique(session()->get('sp'))).','; @endphp];
    var generalM = [@php if(session()->get('mg') != '0') foreach(session()->get('mg') as $mg){ echo $mg.','; } @endphp];
    var datos = [@php foreach(session()->get('it') as $it){ echo $it.','; } @endphp];
  </script>
 @if($appointments->isEmpty())
<div class="alert alert-info alert-dismissible" id="alert">
                <h4><i class="icon fa fa-info"></i> No hay citas registradas para los próximos días...</h4>               
</div>
 @else
      <div class="box-group" id="accordion">
                <div class="panel box box-default" style="border-top-color: gray;">
                
                 <div class="box-header with-border"> 
                  <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="a text-black" style="font-size: 12px;">
                   <div align="left"><i class="fa fa-chevron-down text-muted"></i> Citas médicas registradas</div>
                  </a>
              </h4>
                    </div> 
                  <div id="collapseOne" class="panel-collapse collapse" >
                    <div class="box-body">
                         @foreach($appointments->sortBy('when') as $appo)
                              @if($loop->iteration < 3)

                                            <div class="col-sm-12">
                                                  <div class="info-box sm bg-gray">
                                                    <span class="info-box-icon sm bg-black"><i class="fa fa-heartbeat"></i></span>
                                                    <div class="info-box-content sm">
                                                      <b>Lugar:</b> {{ $appo->workplace}}.<br/>
                                                     <span class="text-black">Asignada para:  {{ \Carbon\Carbon::parse($appo->when)->format('d-m-Y h:i A') }}</span>            
                                                    </div>
                                 @endif 
                                                         @if($loop->iteration > 2)
                                                         <div class="col-sm-12" style="text-align: right;">
                                                          <a href="{{ url('/medicalconsultations') }}" style="font-size: 12px;">
                                                         Más detalles...
                                                         </a>
                                                         </div>
                                                         @break
                                                         @endif 
                                                  </div>
                                                </div>

                         @endforeach
                    </div>
                  </div>
                </div>
            </div>    
 @endif
          
   
    
    <div id="mapaC">
      <!-- Trigger the modal with a checkbox -->
      <div class="checkStyle">
        <input type="checkbox" name="general" id="general" checked onchange="changeCheck();"><strong><label for="general" id="label01" class="textStyle01"></label></strong>
      </div>

      <div id="infoSp" class="infoSpStyle" style="display:none;" onclick="changeCheck();">
        <strong>
          <span id="infoSpDetail" class="textStyle01"></span>
        </strong>
      </div>
 
      <div id="searchDiv">
        <!-- <strong>
          <label for="keyWordSearch" id="label03" class="textStyle01"></label>&nbsp;
        </strong>
        <input type="text" name="keyWordSearch" class="form-control input-sm" id="kWSearch"> -->
      
        <div class="input-group input-group-sm">
          <input type="text" class="form-control" placeholder="Buscar ..."  name="keyWordSearch"  id="kWSearch" >
          <span class="input-group-btn">
            <button type="button" class="btn btn-info btn-flat" onclick="start();">
              <span class="fa fa-search"></span>
            </button>
          </span>
        </div>
      </div>

      <div class="overlay" align="center" id="loadermap-to-remove" style="position:absolute;left:33%;padding-top: 20%;">

        <center><h1><i class="fa fa-refresh fa-spin"></i> Cargando ...</h1></center>
      </div>



    <div id="map"></div>
         <div class="checkStyl2">      
      <a class="btn btn-secondary btn-block btn-flat" data-backdrop="static" data-toggle="modal" data-target="#modal">Búsqueda</a>
    </div>
    <div id='rango'>
        <strong><label for="rango01" id="label04" class="textStyle01"></label> <span id="rango03"></span></strong><br/>
        <input type="range" name="rango01" id="rango01" value="1000" min="1000" max="10000" step="50" autocomplete="off" onchange="start();" class="rangeStyle"/>
      </div>
  </div> 

      
         <!-- Modal Busqueda por lugar -->

            <div id="modal" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">   
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <label for="Busqueda">Búqueda de lugar:</label>
                  </div>
                  <div class="modal-body">
                        <div class="input-group input-group-sm">
                          <input id="address" type="textbox" value="" class="form-control">
                          <span class="input-group-btn">
                          <input id="submit" type="button" class="btn btn-secondary btn-block btn-flat" value="Buscar"></span>
                       </div>
                            <br/>                    
                          <div id ="ubi" class="input-group input-group-sm" style="display:none">
                          <input id="ubication" type="button" class="btn btn-secondary btn-block btn-flat" value="Volver a ubicación" onclick="initMap()">
                          </div>
                     <!--<input id="submit" type="button" value="Buscar" class="map-marker text-muted">-->
                  </div>
                </div>
              </div>
            </div>


    <!-- Modal de especialidades -->
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog modal-sm">
      
        <!-- Modal content-->
        <div class="modal-content">

          <div class="modal-header" >

            <!-- Tachecito para cerrar -->
          
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <label for="Speciality" id="label02"></label>

          </div>

          <div class="modal-body" >
              <div class="form-group">
                <select class="form-control" name="Speciality" id="mySelect" size="1">
                  <option id="opc01"></option>
                </select>
              </div>
          </div>

          <div class="modal-footer">
            <center>
              <button type="button" id="button01" class="btn btn-secondary btn-block btn-flat" onclick="start();">
                <label for="button01" id="label07"></label>
              </button>
            </center>
          </div>
        </div>
        
      </div>
    </div>


    <!-- Modal de registro de cita -->
    <div class="modal fade" id="modal-register-cite">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Concretar cita</h4>
              </div>


              <div class="modal-body">
                <div >
                  <p id="info"></p>
                </div>
              <hr width="100%">
                <!-- Calendar -->
          <div class="box box-solid bg-green-gradient">
            <div class="box-header">
              <i class="fa fa-calendar"></i>

              <h3 class="box-title">Seleccionar día</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <!--The calendar -->
              <div id="calendar" style="width: 80%"></div>
            </div>
            <!-- /.box-body -->
            
          </div>

          <input type="hidden" id="dateSelectedForCite">
 
          <!-- /.box -->
          <select id="timesByDay" class="form-control" style="display: none;">
            <option>10:00 A.M.</option>
            <option>11:00 A.M.</option>
            <option>12:00 P.M.</option>
            <option>13:00 P.M.</option>
            <option>14:00 P.M.</option>
            <option>15:00 P.M.</option>
            <option>16:00 P.M.</option>
            <option>17:00 P.M.</option>
            <option>18:00 P.M.</option>
          </select>
          <br/>
          <br/>
          <select id="paymentMethodsFields" class="form-control" style="display: none;">
            
          
          </select>

          <script type="text/javascript">
          $(function () {

            $('#calendar').datepicker();

            $('#calendar').on('changeDate', function() {
                $('#dateSelectedForCite').val(
                    $('#calendar').datepicker('getFormattedDate')
                );
            });


            $(".datepicker .datepicker-days").on('click', 'td.day', function () {
                document.getElementById('paymentMethodsFields').style.display = "block";
                document.getElementById('timesByDay').style.display = "block";
            });



            $.ajax(
              {
                url: "medicalappointments/showPaymentMethods", 
                success: function(result){
                  console.log(result);

                  var x = document.getElementById("paymentMethodsFields");

                  for (var i = result.length - 1; i >= 0; i--) {
                    
                    var option = document.createElement("option");
                    option.text = result[i].provider + ": " + result[i].cardnumber;
                    option.value = result[i].provider + "_" + result[i].cardnumber;
                    option.setAttribute("data-icon", result[i].provider);
                    x.add(option);

                  }
                }
              }
            );

            $('select').select2({
                width: "100%",
            });

          });
          </script>


          </div>
              <div class="modal-footer">
                <form action="/payment/postPaymentWithpaypal" id="formulatio_paypal" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                  <input id="amount" type="hidden" class="form-control" name="amount" required>
                  
                  <button type="submit" id="button01" class="btn btn-secondary btn-block btn-flat">
                    Confirmar y programar cita
                  </button>
                </form>
              </div>

            </div>
        </div>
    </div>
    <!--/ Modal de registro de cita -->



    <script type="text/javascript">
    $("#alert").fadeTo(3000, 500).fadeOut(500, function(){
    $("#alert").fadeOut(500);
});
      function infoSelect(){
        var x = document.getElementById("mySelect");
        for (var i = 0; i < specialities.length; i++) {
        var c = document.createElement("option");
        c.text = specialities[i][0];
        x.options.add(c, 1);
        }
      }
      function changeCheck(){
        if (!document.getElementById('general').checked){
          startProcess = false;
          typeC = 'TypeSpeciality';
          $("#myModal").modal({backdrop: "static"});
        }
        if (document.getElementById('general').checked){
          startProcess = false;
          var x = document.getElementById("mySelect");   
          x.selectedIndex = 0;
          typeC = 'TypeGeneral';
          document.getElementById("infoSpDetail").innerHTML = ' ';
          document.getElementById('infoSp').style.display = 'none';
          start();
        }
      }
      function showM(){
        if (!document.getElementById('general').checked){
          startProcess = false;
          typeC = 'TypeSpeciality';
          $("#myModal").modal({backdrop: "static"});
        }
      }
      function hideM(){
        if (document.getElementById('general').checked)
          $("#myModal").modal("hide");
      }
      function showM2(){
        $("#myModal").modal({backdrop: "static"});
      }
      function hideM2(){
        $("#myModal").modal("hide");
      }
    </script>

    <!-- Current range -->
    <script>
      var slider = document.getElementById("rango01");
      var output2 = document.getElementById("rango03");
      var defaultVal = slider.defaultValue;
      output2.innerHTML = slider.value;
      slider.oninput = function() {
        output2.innerHTML = this.value;
      }
    </script>

    <p id="ShowDetails"></p>
    
    

    <!-- Values of Labels -->
    <script type="text/javascript">
      document.title = title;
      document.getElementById('label01').innerHTML = check01;
      document.getElementById('label02').innerHTML = select01;
      document.getElementById('opc01').innerHTML = firstValue;
      // document.getElementById('label03').innerHTML = fieldSearch;
      document.getElementById('label04').innerHTML = Rango01;
      /*document.getElementById('label08').innerHTML = Button02;*/
      document.getElementById('label07').innerHTML = Button01;
    </script>

    <script type="text/javascript">
      function start(){
        startProcess = true;
        //Clean
        clearMarkers();
        document.getElementById("ShowDetails").innerHTML = ' ';
        document.getElementById("info").innerHTML = ' ';
        //Value of Speciality
        var x = document.getElementById("mySelect");
        var s = x.selectedIndex;
        var selectedValue = x.options[s].text;
        console.log('ESPECIALIDAD::'+selectedValue);
        //Value of word for search
        var keySearch = document.getElementById("kWSearch").value;
        console.log('PALABRA BÚSQUEDA::'+keySearch);
        //Value of indicated Position
        markerLatLng = markerP.getPosition();
        console.log('NUEVA POSICION::'+markerLatLng);
        //Value of Range to search
        var x = document.getElementById("rango01");
        var currentVal = x.value;
        console.log('RANGO INDICADO:: '+currentVal);
        
        if(typeC == 'TypeSpeciality'){
          if(selectedValue == firstValue){
            console.log('NULO ESPECIALIDAD:: '+selectedValue);
            clearMarkers();
            /*document.getElementById("ShowDetails").innerHTML = error01;*/
            document.getElementById("ShowDetails").innerHTML = ' ';
            document.getElementById("info").innerHTML = ' ';
            document.getElementById('infoSp').style.display = 'none';
            startProcess = false;
          }
          if(selectedValue !== firstValue){
            console.log('VÁLIDO ESPECIALIDAD:: '+selectedValue);
            hideM2();
            document.getElementById('infoSp').style.display = 'block';
            document.getElementById("infoSpDetail").innerHTML = selectedValue;
            functionEsp(selectedValue, keySearch, markerLatLng, currentVal);
            drop();
            }
          }
          if(typeC == 'TypeGeneral'){
            console.log('CITA GENERAL');
            document.getElementById('infoSp').style.display = 'none';
            functionGen(keySearch, markerLatLng, currentVal);
            drop();
          }
      }
    </script>

    <script type="text/javascript">
      var markers = [];
      var map;
      var infoWindow;
      /**
       * Function responsable of execute the main functions 
       * 
       */
      window.onload = function(){
        var height = window.screen.availHeight-115;
        console.log(height);
        document.getElementById('map').setAttribute("style","height:" + height + "px");
        initMap();
        infoSelect();
        setTimeout(function(){
          document.getElementById('loadermap-to-remove').style.display = 'none';
        }, 4000);
      };
      function initMap() {
        //var image = "{{ asset('maps-and-flags_1.png') }}";
        $('#modal').modal('hide');
         document.getElementById('ubi').style.display = 'none'; 
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
            map = new google.maps.Map(document.getElementById('map'), {
              zoom: 14,
              center: new google.maps.LatLng(pos),
              styles: [
              {
                "elementType": "geometry",
                "stylers": [
                  {
                    "color": "#f5f5f5"
                  }
                ]
              },
              {
                "elementType": "labels.icon",
                "stylers": [
                  {
                    "visibility": "off"
                  }
                ]
              },
              {
                "elementType": "labels.text.fill",
                "stylers": [
                  {
                    "color": "#616161"
                  }
                ]
              },
              {
                "elementType": "labels.text.stroke",
                "stylers": [
                  {
                    "color": "#f5f5f5"
                  }
                ]
              },
              {
                "featureType": "administrative.land_parcel",
                "stylers": [
                  {
                    "visibility": "off"
                  }
                ]
              },
              {
                "featureType": "administrative.land_parcel",
                "elementType": "labels.text.fill",
                "stylers": [
                  {
                    "color": "#bdbdbd"
                  }
                ]
              },
              {
                "featureType": "administrative.neighborhood",
                "stylers": [
                  {
                    "visibility": "off"
                  }
                ]
              },
              {
                "featureType": "poi",
                "elementType": "geometry",
                "stylers": [
                  {
                    "color": "#eeeeee"
                  }
                ]
              },
              {
                "featureType": "poi",
                "elementType": "labels.text",
                "stylers": [
                  {
                    "visibility": "off"
                  }
                ]
              },
              {
                "featureType": "poi",
                "elementType": "labels.text.fill",
                "stylers": [
                  {
                    "color": "#757575"
                  }
                ]
              },
              {
                "featureType": "poi.business",
                "stylers": [
                  {
                    "visibility": "off"
                  }
                ]
              },
              {
                "featureType": "poi.medical",
                "stylers": [
                  {
                    "color": "#686b6e"
                  },
                  {
                    "visibility": "on"
                  },
                  {
                    "weight": 3
                  }
                ]
              },
              {
                "featureType": "poi.medical",
                "elementType": "labels.icon",
                "stylers": [
                  {
                    "visibility": "off"
                  }
                ]
              },
              {
                "featureType": "poi.park",
                "stylers": [
                  {
                    "visibility": "off"
                  }
                ]
              },
              {
                "featureType": "poi.park",
                "elementType": "geometry",
                "stylers": [
                  {
                    "color": "#e5e5e5"
                  }
                ]
              },
              {
                "featureType": "poi.park",
                "elementType": "labels.text.fill",
                "stylers": [
                  {
                    "color": "#9e9e9e"
                  },
                  {
                    "visibility": "off"
                  }
                ]
              },
              {
                "featureType": "road",
                "elementType": "geometry",
                "stylers": [
                  {
                    "color": "#ffffff"
                  }
                ]
              },
              {
                "featureType": "road",
                "elementType": "labels",
                "stylers": [
                  {
                    "visibility": "off"
                  }
                ]
              },
              {
                "featureType": "road",
                "elementType": "labels.icon",
                "stylers": [
                  {
                    "visibility": "off"
                  }
                ]
              },
              {
                "featureType": "road.arterial",
                "elementType": "labels.text.fill",
                "stylers": [
                  {
                    "color": "#757575"
                  }
                ]
              },
              {
                "featureType": "road.highway",
                "elementType": "geometry",
                "stylers": [
                  {
                    "color": "#dadada"
                  }
                ]
              },
              {
                "featureType": "road.highway",
                "elementType": "labels.text.fill",
                "stylers": [
                  {
                    "color": "#616161"
                  }
                ]
              },
              {
                "featureType": "road.highway.controlled_access",
                "stylers": [
                  {
                    "visibility": "on"
                  }
                ]
              },
              {
                "featureType": "road.local",
                "elementType": "labels.text.fill",
                "stylers": [
                  {
                    "color": "#9e9e9e"
                  }
                ]
              },
              {
                "featureType": "transit",
                "stylers": [
                  {
                    "visibility": "off"
                  }
                ]
              },
              {
                "featureType": "transit.line",
                "elementType": "geometry",
                "stylers": [
                  {
                    "color": "#e5e5e5"
                  }
                ]
              },
              {
                "featureType": "transit.station",
                "elementType": "geometry",
                "stylers": [
                  {
                    "color": "#eeeeee"
                  }
                ]
              },
              {
                "featureType": "water",
                "elementType": "geometry",
                "stylers": [
                  {
                    "color": "#c9c9c9"
                  }
                ]
              },
              {
                "featureType": "water",
                "elementType": "labels.text",
                "stylers": [
                  {
                    "visibility": "off"
                  }
                ]
              },
              {
                "featureType": "water",
                "elementType": "labels.text.fill",
                "stylers": [
                  {
                    "color": "#9e9e9e"
                  }
                ]
              }
            ], 
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
              infoWindow.open(map, markerP);
              infoWindow.setContent(message01);
            });
                var geocoder = new google.maps.Geocoder();
                document.getElementById('submit').addEventListener('click', function() {
                geocodeAddress(geocoder, map, markerP);
                $('#modal').modal('hide');
                document.getElementById('ubi').style.display = 'inline'; 
                });
          },
          //****Error
          function(failure) {
            if(failure.message.indexOf(message02) == 0) {
            // Secure Origin issue.
            }
          });
        }else {
            // Browser doesn't support Geolocation
            infoWindow.setMap(map);
            //infoWindow.setPosition(map.getCenter());
            infoWindow.setPosition({lat: 20.42, lng: -99.18});
            infoWindow.setContent(message03);
        }
      }
      //Filter geocode Address
        function geocodeAddress(geocoder, resultsMap, markerP) {
        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            markerP.setPosition(results[0].geometry.location);
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }
  
      //Filter of Speciality
      function functionEsp(specialityValue, keyWordValue, positionValue, rangeValue) {
        var res = [];
        loc = [];
        console.log('specialityValue:: '+specialityValue);
        console.log('keyWordValue:: '+keyWordValue);
        console.log('positionValue:: '+positionValue);
        console.log('rangeValue:: '+rangeValue);
        if(keyWordValue == ''){
          for(var i = 0; i < datos.length; i++) {
            if(datos[i][0] == specialityValue){
              res.push([datos[i][1], datos[i][2], datos[i][0], datos[i][3], datos[i][4], datos[i][5]]);
            }
          }
        }else{
          for(var i = 0; i < datos.length; i++) {
            if(datos[i][0] == specialityValue && datos[i][3] == keyWordValue){
              res.push([datos[i][1], datos[i][2], datos[i][0], datos[i][3], datos[i][4], datos[i][5]]);
            }
          }          
        }
        for(var i = 0; i < res.length; i++) {
          var posB = new google.maps.LatLng(res[i][0], res[i][1]);
          metros = google.maps.geometry.spherical.computeDistanceBetween(positionValue, posB);
          console.log('metros:: '+metros);
          console.log('Nombre:: '+res[i][3]);
          if(metros < rangeValue){
            //loc[latitud, longitud, especialidad, nombre, hospital, dirección]
            loc.push([res[i][0], res[i][1], res[i][2], res[i][3], res[i][4], res[i][5]]);
          }
        }
        console.log(res);
        console.log(loc);
        
        if(loc.length <= 0){
          console.log('NO ENCONTRO MÉDICO');
          console.log('TAMAÑO:: '+loc.length);
          document.getElementById("ShowDetails").innerHTML = '<strong>'+error02+'.</strong>';
          document.getElementById("info").innerHTML = ' ';
        }else{
          document.getElementById("ShowDetails").innerHTML = '<strong>'+ result01 + ' ' + specialityValue +'. '+ result02 + ' ' + rangeValue +'.</strong>';
        }
      }
      //Filter of General Appointment
      function functionGen(keyWordValue, positionValue, rangeValue) {
        var res = [];
        loc = [];
        console.log('keyWordValue:: '+keyWordValue);
        console.log('positionValue:: '+positionValue);
        console.log('rangeValue:: '+rangeValue);
        
        if(keyWordValue != ''){
          console.log('KEYWORD SEARCH VÁLIDO:: '+keyWordValue);
          for(var i = 0; i < generalM.length; i++) {
            if(generalM[i][2] == keyWordValue){
               res.push([generalM[i][0], generalM[i][1], "Médico General", generalM[i][2], generalM[i][3], generalM[i][4]]);
            }
          }
          for(var i = 0; i < res.length; i++) {
            var posB = new google.maps.LatLng(res[i][0], res[i][1]);
            metros = google.maps.geometry.spherical.computeDistanceBetween(positionValue, posB);
            console.log('metros:: '+metros);
            console.log('Nombre:: '+res[i][3]);
            if(metros < rangeValue){
               //loc[latitud, longitud, especialidad, nombre, hospital, dirección, precio]
               loc.push([res[i][0], res[i][1], res[i][2], res[i][3], res[i][4], res[i][5]]);
             }
          }
          if(loc.length <= 0){
            console.log('NO ENCONTRO MÉDICO');
            console.log('TAMAÑO:: '+loc.length);
            document.getElementById("ShowDetails").innerHTML = '<strong>'+error02+'.</strong>';
            document.getElementById("info").innerHTML = ' ';
          }else{
            document.getElementById("ShowDetails").innerHTML = '<strong>' + result01 + ' ' + keyWordValue +'.</strong>';
          }
        }else{
          console.log('KEYWORD SEARCH NULO:: '+keyWordValue);
          for(var i = 0; i < generalM.length; i++) {
            var posB = new google.maps.LatLng(generalM[i][0], generalM[i][1]);
            metros = google.maps.geometry.spherical.computeDistanceBetween(positionValue, posB);
            console.log('metros:: '+metros);
            console.log('Nombre:: '+generalM[i][2]);
            if(metros < rangeValue){
              console.log('Nombre:: '+generalM[i][2]);
              console.log(metros +'<'+ rangeValue);
               res.push([generalM[i][0], generalM[i][1], "Médico General", generalM[i][2], generalM[i][3],generalM[i][4]]);
               //loc[latitud, longitud, especialidad, nombre, hospital, dirección]
            }
          }
          for(var i = 0; i < res.length; i++) {
            loc.push([res[i][0], res[i][1], res[i][2], res[i][3], res[i][4], res[i][5]]);
          }
          if(loc.length <= 0){
            console.log('NO ENCONTRO MÉDICO');
            console.log('TAMAÑO:: '+loc.length);
            document.getElementById("ShowDetails").innerHTML = '<strong>'+error02+'.</strong>';
            document.getElementById("info").innerHTML = ' ';
          }else{
            document.getElementById("ShowDetails").innerHTML = '<strong>'+ result01 + ' ' + rangeValue + ' ' + result02 +'.</strong>';
          }
        }      
        console.log(res);
        console.log(loc);
      }
      function drop() {
        clearMarkers();
        for (var i = 0; i < loc.length; i++) {
          var lat = loc[i][0];
          var lon = loc[i][1];
          console.log(lat);
          console.log(lon);
          var doctor = "{{ asset('doctors.png') }}";
          markers[i] = new google.maps.Marker({
            position: new google.maps.LatLng(lat,lon),
            animation: google.maps.Animation.DROP,
            icon: doctor
          });
          var infowindow = new google.maps.InfoWindow();
          var marker = markers[i];
          google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
            return function() {
              infowindow.setContent("<b>"+loc[i][2]+"</b><br/>"+loc[i][3]+"</b><br/>"+loc[i][4]+"</b><br/>Consulta: $"+loc[i][5]);
              infowindow.open(map, marker);
              console.log(marker);
              
              showInfo("<b>"+loc[i][2]+"</b><br/>"+loc[i][3]+"</b><br/>"+loc[i][4]+"</b><br/>Consulta: $"+loc[i][5]);
          
            }
          })(marker, i));
          google.maps.event.addListener(marker, 'dblclick', (function(marker, i) {
            return function() {  
              
              showInfo(loc[i][2] + ', ' + loc[i][3] + '.<br/>Costo consulta: $' + loc[i][5] +'<br/>');
              document.getElementById('amount').value = loc[i][5];
              $('#modal-register-cite').modal('show');
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
        document.getElementById("info").innerHTML = '<strong>Información del médico:</strong> <br/>'+ info +'';
      }
    </script>

    <!-- Calculate distance -->
    <script type="text/javascript">
      function distancia(lat1, lng1, lat2, lng2){
        var earthRadius = 6371000; //meters
        var dLat = Math.toRadians(lat2-lat1);
        var dLng = Math.toRadians(lng2-lng1);
        var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
               Math.cos(Math.toRadians(lat1)) * Math.cos(Math.toRadians(lat2)) *
               Math.sin(dLng/2) * Math.sin(dLng/2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
        var dist = (earthRadius * c);
        return dist;
      }
    </script>

    <!-- Hides modal -->
    <script>
    $(document).ready(function(){
        $("#myModal").on('hidden.bs.modal', function () {
          //console.log(startProcess);
          //alert(startProcess);
           if(!startProcess){
            /*alert('The modal is now hidden.');*/
            var x = document.getElementById("mySelect");
            var s = x.selectedIndex;
            var selectedValue = x.options[s].text;
            //alert(s);
            document.getElementById("general").checked = true;            
            x.selectedIndex = 0;
            typeC = 'TypeGeneral';
          }
        });
    });
    </script>


@stop