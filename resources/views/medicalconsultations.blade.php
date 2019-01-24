@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
        width: 90%;
        bottom: 5%;
        right: 10%;
        padding-top: 0.7%;
        padding-bottom: 0.7%;
        padding-right: 0.7%;
        padding-left: 0.7%;
        /*background-color: rgba(255,255,255,0.7);*/
        z-index: 100;
        text-align: center;
        font-size: 90%;
        line-height: 15%;
      }

      #rango03{
        font-size:25px;
      }

      .rango{ 
        position: absolute;
        width: 90%;
        bottom: 90%;
        right: 10%;
        padding-top: 0.7%;
        padding-bottom: 0.7%;
        padding-right: 0.7%;
        padding-left: 0.7%;
        /*background-color: rgba(255,255,255,0.7);*/
        z-index: 100;
        text-align: center;
        font-size: 90%;
        line-height: 15%;
      }
      #rangothree{ 
        position: absolute !important;
        bottom: 4% !important;
        right: 2% !important;
        padding-top: 0.7%;
        padding-bottom: 0.7%;
        padding-right: 0.7%;
        padding-left: 0.7%;
        /*background-color: rgba(255,255,255,0.7);*/
        z-index: 1000;
        text-align: center;
      }
      #rangotwo{ 
        position: absolute;
        top: 2%;
        right: 2%;
        padding-top: 0.7%;
        padding-bottom: 0.7%;
        padding-right: 0.7%;
        padding-left: 0.7%;
        /*background-color: rgba(255,255,255,0.7);*/
        z-index: 100;
        text-align: center;
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

      .btn-default {
          box-shadow: 1px 2px 5px #000000;   
      }
        .box {
             margin-bottom: 0;
        }
        .panel {
             margin-bottom: 0; 
        }
        .pac-container {
         z-index: 100000; 
       }
      .box.box-primary {
        border-top-color: #242627;
        }
    #infDr {
    bottom: 0;
    right: 0;
    position: fixed;
    z-index: 1050;
    width: 70%;
    margin: 0 0 0 0 !important;
    }
    @media( max-width : 700px ) {
       #infDr {
         width: 95%;
       }
    }
    .alert .close {
    color: white !important;
    opacity: .8 !important;
}
    #bodyDr{
       margin-left: 90px; 
    }
.customMarker {
    position:absolute;
    cursor:pointer;
    background:#424242;
    width:50px;
    height:50px;
    /* -width/2 */
    margin-left:-25px;
    /* -height + arrow */
    margin-top:-55px;
    border-radius:50%;
    padding:0px;
}
.customMarker:after {
    content:"";
    position: absolute;
    bottom: -5px;
    left: 20px;
    border-width: 5px 5px 0;
    border-style: solid;
    border-color: #424242 transparent;
    display: block;
    width: 0;
}
.customMarker img {
    width:45px;
    height:45px;
    margin:3px;
    border-radius:50%;
    pointer-events: auto;
}
    .modal-content-2 {
        position: relative;
        background-color: transparent;
        -webkit-background-clip: padding-box;
        background-clip: padding-box;
        color: white;
        padding-top: 50%;
    }
    .liright { 
    color: #999 !important;
    float: right !important;
    padding: 3px !important;
    font-size: 10px !important;
    }
    .nav-stacked>li.active>a {
      border-left-color: #080808 !important;
    }
    .cut{
      width:60%;
      text-overflow:ellipsis;
      white-space:nowrap; 
      overflow:hidden; 
      text-align: right;
    }
    .direct-chat-contacts {
          height: 28px !important;
          background: transparent !important; 
          top: 90% !important; 
          z-index: 900;
    }

  </style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>



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
    var Rango01 = 'Rango de búsqueda (Kilómetros):';
    var Rango02 = 'Rango de búsqueda predefinido (Kilómetros):';
    var Rango03 = 'Rango de búsqueda actual (Kilómetros):';
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
                            <h5><i class="icon fa fa-info"></i> No hay citas registradas para los próximos días...</h5>               
            </div>
             @else
        <div class="box-group" id="accordion">
                <div class="panel box box-default" style="border-top-color: gray;">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="a text-black" style="font-size: 12px;">
                 <div class="box-header with-border"> 
                       <div align="left"><i class="fa fa-chevron-down text-muted"></i> <b>Citas médicas registradas</b></div>
                     </div> 
                    </a>
                  <div id="collapseOne" class="panel-collapse collapse" >
                    <div class="box-body">
                         @foreach($appointments->sortBy('when') as $appo)
                              @if($loop->iteration < 3)
                            <div class="col-sm-12">
                                  <div class="info-box sm bg-gray">
                                    <a data-toggle="modal" data-target="#{{ $appo->id }}"><div class="info-box-icon2-sm"><img src="{{ $appo->profile_photo }}" class="img-circle" alt="User Image" style="height: 35px;"></div></a>
                                    <div class="info-box-content sm">
                                     <a href="https://www.google.com/maps/search/?api=1&query={{ $appo->latitude }}, {{ $appo->longitude }}" class="text-muted" target="_blank"> 
                                      <b>Lugar:</b> {{ $appo->workplace}}.</a><br/>
                                     <span class="text-black">Asignada para:  {{ \Carbon\Carbon::parse($appo->when)->format('d-m-Y h:i A') }}</span>     
                                     </div>       
                                    </div>
                                   </div> 
                                         <div class="modal fade" role="dialog" id="{{ $appo->id }}">
                                            <div class="modal-dialog modal-sm">

                                              <div class="modal-content">

                                                <div class="modal-header" >
                                                  <!-- Tachecito para cerrar -->

                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                   <div align="left"><label>Detalle de cita</label></div>
                                                </div>
                                                    <div class="modal-body" style="padding: 0px !important;">
                                                      <div align="center">
                                                      <table style="width: 80%; text-align: center;">
                                                         <tr>
                                                            <td width="40%"><img src="{{ $appo->profile_photo }}" class="img-circle" alt="User Image" style="height: 55px;"></td>
                                                            <td><img src="https://s3.amazonaws.com/abiliasf/Sin+título-1_a-01.png"></td>
                                                            <td width="40%"><img src="{{ $photo }}" class="img-circle" alt="User Image" style="height: 55px;"></td>
                                                         </tr>
                                                         <tr>
                                                            <td width="40%">{{ $appo->name }}</td><td>&nbsp;</td><td width="40%">{{ $name }}</td>
                                                         </tr>
                                                      </table>
                                                      </div><br/><br/>
                                                      <div align="left">
                                                      <ul class="nav nav-pills nav-stacked">
                                                        <li class="active"><a href="javascript:void(0)">Tiempo restante para la cita <span class="liright">{{ \Carbon\Carbon::parse($appo->when)->diffForHumans() }}</span></a></li>
                                                        <li><a href="{{ url('/payment/Transactions/') }}/{{ $appo->idtr }}">Método de pago 
                                                     @if($appo->provider != 'Paypal')
                                                             @php 
                                                            $cardfin = substr_replace($appo->cardnumber, '••••••••••••', 0, 12)
                                                             @endphp 
                                                          @if($appo->provider == "Visa")
                                                          <span class="liright cut"><i class="fa fa-cc-visa" style="font-size: 14px;"></i> &nbsp;{{ $cardfin }}</span>
                                                          @endif
                                                          @if($appo->provider == "MasterCard")
                                                          <span class="liright cut"><i class="fa fa-cc-mastercard" style="font-size: 14px;"></i> &nbsp;{{ $cardfin }}</span>
                                                          @endif
                                                     @else 
                                                          <span class="liright cut"><i class="fa fa-cc-paypal" style="font-size: 14px;"></i> &nbsp;{{ $appo->paypal_email }}</span>
                                                     @endif 
                                                        </a></li>
                                                        <li><a data-target="#chat-{{ $appo->id }}" data-dismiss="modal" data-toggle="modal">Conectar con Médico</a></li>
 
                                                      </ul>
                                                      </div>
                                                      
                                                    <div align="center"><img border="0" src="//maps.googleapis.com/maps/api/staticmap?center={{ $appo->latitude }},{{ $appo->longitude }}&amp;markers=%7Ccolor:black%7Clabel:%7C{{ $appo->latitude }},{{ $appo->longitude }}&amp;zoom=15&amp;style=element:geometry%7Ccolor:0xf5f5f5&amp;size=250x200&amp;key={{ env('GOOGLE_KEY') }}" alt="ubicación"  style="width:100%;"> </div> 
                                                    </div>
                                                </div>
                                              </div> 
                                            </div>

                                                              <div class="modal-chat fade2 modal" id="chat-{{ $appo->id }}">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                         <div class="modal-header">
                                                                             <button type="button" class="close" data-target="#{{ $appo->id }}" data-dismiss="modal" data-toggle="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span></button>
                                                                             <h4 class="modal-title"> <i class="fa fa-comments"></i> Ventana de Conversación</h4>
                                                                             </div>
                                                                          <div class="modal-body">
                                                                                <input type="hidden" class="middr" value="{{ $appo->did }}">
                                                                                <input type="hidden" class="midfield" value="{{ $appo->id }}">
                                                                                <input type="hidden" class="mname" value="Cita médica">
                                                                                <input type="hidden" class="mtable" value="medical_appointments">
                                                                             @include('conversations.conversationform')

                                                                         </div>
                                                                          </div>  
                                                                       </div>
                                                                    </div>  


                                 @endif 
                                                         @if($loop->iteration > 2)
                                                         <div class="col-sm-12" style="text-align: right;">
                                                          <a href="{{ url('/appointments') }}" style="font-size: 11px;" class="text-muted">
                                                         Más detalles...
                                                         </a>
                                                         </div>
                                                         @break
                                                         @endif 
                                                  
                         @endforeach
                          </div>
                    </div>
                  </div>
                </div> 
 @endif
          
              <!-- Charge Alert whether payment was processed or not -->
              @if(session()->has('message'))

                @if(session()->has('success'))


                 <!--Modal cita y pago success-->
                 <div class="modal fade" role="dialog" id="modalsuccess">
                    <div class="modal-dialog modal-sm">

                      <div class="modal-content">

                        <div class="modal-header" >
                          <!-- Tachecito para cerrar -->
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <div align="left"><label>¡Cita registrada!</label></div>
                        </div>
                            <div class="modal-body" >
                            <div align="center"><img src="{{ session()->get('drphoto') }}" class="img-circle" alt="User Image" style="height: 80px;"><br/><b>Dr. {{ session()->get('dr') }}</b></div>  <br/>
                              <div class="box box-primary">
                                <div class="box-header with-border">
                                  <b>Información General de la cita</b>
                                </div>
                                <div class="box-body">
                             Lugar: <span class="text-muted">{{ session()->get('work') }}</span><br/>
                             Especialidad: <span class="text-muted">{{ session()->get('spe') }}</span><br/>
                             Fecha de Cita: <span class="text-muted">{{ \Carbon\Carbon::parse(session()->get('fecha'))->format('d-m-Y h:i A') }}</span>

                             </div>
                              </div>

                              <div class="box box-primary">
                                <div class="box-header with-border">
                                  <b>Información de Pago</b>
                                </div>
                                <div class="box-body">

                             Monto: <span class="text-muted">${{ session()->get('monto') }}</span><br/>  
                             Transacción: <a href = "payment/Transactions/{{ session()->get('idcard') }}" class="btn">{{ session()->get('transaccion') }}</a><br/>
                             Método de pago: <span class="text-muted">{{ session()->get('card') }}</span>
                             <br/><br/><div align="right"><a href = "https://site-boomedic.herokuapp.com/login" class="btn btn-secondary btn-flat btn-sm">Facture aquí</a></div>
                            </div>
                              </div>
                            </div>
                        </div>
                      </div> 
                    </div>

                 <!--Fin modal success-->

                @elseif(session()->has('error'))
  
                <!--Modal cita y pago error-->
                 <div class="modal fade" role="dialog" id="modalerror">
                    <div class="modal-dialog modal-sm">

                      <div class="modal-content">

                        <div class="modal-header" >
                          <!-- Tachecito para cerrar -->

                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                           <div align="left"><label>¡Hubo un error en tu pago y no fue procesado!</label></div>
                        </div>
                            <div class="modal-body" >
                                 @php
                                  $code = session()->get('message');
                                 @endphp
                          <!-- Error codes are defined within the adminlte -->
                          @if($code > 0)
                              {{ trans('adminlte::adminlte.'.$code) }}
                          @else
                              {{ $code }}
                              @endif
                            </div>
                        </div>
                      </div> 
                    </div>

                 <!--Fin modal error-->
                 @endif

              @endif
            <!-- Here ends the code for the alert --> 




    <div id="mapaC">
      <!-- Trigger the modal with a checkbox -->


      <div id="infoSp" class="infoSpStyle" style="display:none;" onclick="changeCheck();">
        <strong>
          <span id="infoSpDetail" class="textStyle01" style="visibility: hidden;"></span>
        </strong>
      </div>
 



<div id="loadingmodal" class="modal fade" role="dialog" style="background: rgba(0, 0, 0, 0.8);">
      <div class="modal-dialog">
          <div class="modal-content-2">
            <div align="center">
          <h1><i class="fa fa-refresh fa-spin"></i><br/>Cargando...</h1>
              </div>
          </div>
      </div>
  </div>

  @if(count($medication) > 0)

                                         <div class="modal fade" role="dialog" id="medications">
                                            <div class="modal-dialog modal-sm">

                                              <div class="modal-content">

                                                <div class="modal-header" >
                                                  <!-- Tachecito para cerrar -->

                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                   <div align="left"><label>Tienes un tratamiento sin confirmar</label></div>
                                                </div>
                                                    <div class="modal-body" style="padding-top: 0 !important">
                                                       <div class="wizard">
                                                                <div class="wizard-inner">
                                                                   
                                                                    <ul class="nav nav-tabs" role="tablist">

                                                                        <li role="presentation" class="active">
                                                                            <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Tratamientos" id="tab2">
                                                                                <span class="round-tab">
                                                                                    <i class="fa fa-list-alt"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li role="presentation" id="">
                                                                            <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Confirmar" id="conf">
                                                                                <span class="round-tab">
                                                                                    <i class="glyphicon glyphicon-ok"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>

                                                                    <div class="tab-content">
                                                                      
                                                                        <div class="tab-pane active" role="tabpanel" id="step1">
                                                                          <span style="font-size: 16px;">En lista por confirmar</span><br/><br/>
                                                                            <ul class="nav nav-pills nav-stacked">
                                                                                    @foreach($medication as $med)
                                                                                        <li class="active" style="border-bottom-color: white!important;"><a href="javascript:void(0)"><span style="font-size: 12px;">{{ $med->name_medicine }}
                                                                                              <ul>
                                                                                                  <li>Duración: {{ $med->frequency_days }} día(s)</li>
                                                                                                  <li>Posología: {{ $med->posology }}</li> 
                                                                                              </ul>
                                                                                              </span></a>
                                                                                        </li>
                                                                                    @endforeach
                                                                              </ul>  <br>    
                                                                              <div align="right"><a onclick="document.getElementById('conf').click();" title="Confirmar" class="btn btn-secondary btn-flat">Siguiente</a></div>
                                                                                                         
                                                                         </div> 

                                                                        <div class="tab-pane" role="tabpanel" id="complete">
                                                                              <span style="font-size: 16px;">Confirmar fecha de inicio del tratamiento</span><br/><br/>
                                                                              Fecha Receta: {{ $daterecipe[0]->date }}
                                                                              <input type="date" name="datemedications" class="form-control">
                                                                              <br>
                                                                              <div align="right"><a onclick="document.getElementById('conf').click();" title="Confirmar" class="btn btn-secondary btn-flat">Confirmar</a></div>
                                                                        </div>
                                                                  </div>  
                                                     </div> 

                                                </div>
                                              </div> 
                                            </div>
                                        </div>  





  @endif



    <div id="map"></div>

<div class="alert alert-info alert-dismissable" id="infDr" style="display: none; background-color: rgba(0, 0, 0, 0.9) !important; border-color: rgba(0, 0, 0, 0.9) !important;">
   <a class="close" onclick="$('.alert').hide()" style="text-decoration: none">×</a>  
    <div class="info-box-icon2-sm" id="Drp"></div>                                           
     <div id="bodyDr"></div>
     <div class="pull-right" id="btncita"></div>
      </div>


<div class="direct-chat">
       <div  id="rangothree">
         <div class="btn-group-vertical">
        <a class="btn btn-default btn-flat" onclick="initMap();"><b><span class="fa fa-crosshairs"></span></b></a>
        <a class="btn btn-default btn-flat" data-widget="chat-pane-toggle" onclick="if($('#fap').hasClass('fa-plus')){$('#fap').removeClass('fa-plus'); $('#fap').addClass('fa-minus'); }else{ $('#fap').removeClass('fa-minus');$('#fap').addClass('fa-plus'); }"><b><span class="fa fa-plus" id="fap"></span></b></a></div></div>
      <div class="direct-chat-contacts">
            <div id="rango">   
              <div class="btn-group">
              <a class="btn btn-default btn-xs" onclick="showMy();"><b><span id="labelextra"></span></b></a>
              <a class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalrango" id="rang"><b>a <span id="rango04"></span> km</b></a>             
              <a class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal"><b>Ubicación</b></a>
              <a class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalsearch"><b>Búsqueda</b></a>
              </div>
            </div>
    </div>
</div>
    <div class="rango" id="dragmap" style="display: none;">
        <a class="btn btn-secondary" data-lng="" id="dragbutton">Buscar en esta zona</a>
    </div> 
  </div> 



        <div id="modalrango" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">   
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true" style="font-size: 21px;">&times;</span>
                    </button>
                    <div align="left"><label for="rango01" id="label04"></label></div>       
                  </div>
                  <div class="modal-body">
                    <div align="center"><label id="rango03"></label></div> 
                          <input type="range" name="rango01" id="rango01" value="1" min="1" max="10" step="0.1" autocomplete="off" onchange="start();" class="rangeStyle"/>
                  </div>
                </div>
              </div>
            </div>



        <div id="modalsearch" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">   
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true" style="font-size: 21px;">&times;</span>
                    </button>
                    <div align="left"><label>Busqueda</label></div>       
                  </div>
                  <div class="modal-body">
                        <!-- <strong>
                          <label for="keyWordSearch" id="label03" class="textStyle01"></label>&nbsp;
                        </strong>
                        <input type="text" name="keyWordSearch" class="form-control input-sm" id="kWSearch"> -->
                      
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Buscar firma, médico, hospital..."  name="keyWordSearch"  id="kWSearch" >
                          <span class="input-group-btn">
                            <button type="button" class="btn btn-secondary btn-flat" onclick="start();">
                              <span class="fa fa-search"></span>
                            </button>
                          </span>
                        </div>
                      </div>
                </div>
              </div>
            </div>

         <!-- Modal Busqueda por lugar -->

            <div id="modal" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">   
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true" style="font-size: 21px;">&times;</span>
                    </button>
                    <div align="left"><label for="Busqueda">Nueva ubicación:</label></div>
                        <div class="input-group input-group-sm">
                          <input id="address" type="textbox" value="" class="form-control" placeholder="Puede ingresar direcciones específicas..">
                          <span class="input-group-btn">
                          <input id="submit" type="button" class="btn btn-secondary btn-block btn-flat" value="Buscar"></span>
                       </div>
                        
                  </div>
                  <div class="modal-body">
                   <div id="recentS" align="left" style="display: none; font-weight:500;">Busquedas anteriores:<br/></div>         
                   <div id="resp" align="left"></div>                
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
              <span aria-hidden="true" style="font-size: 21px;">&times;</span>
            </button>
            <div align="left"><label for="Speciality" id="label02"></label></div>

          </div>

          <div class="modal-body" >
            <div class="form-group">
              <input type="checkbox" name="general" id="general" checked onchange="changeCheck();"><b>&nbsp;<label for="general" id="label01"></label></b>
            </div>
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
    <div class="modal-register-cite modal fade" id="modal-register-cite">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" style="font-size: 21px;">&times;</span></button>
                <div align="left"><label>Concretar cita</label></div>
              </div>
              <div class="modal-body">
                <div id="info">
                </div>

                <!--WIZARD TEST-->


    <section>
        <div class="wizard">
            <div class="wizard-inner">
                <div class="connecting-line"></div>
                <ul class="nav nav-tabs" role="tablist">

                    <li role="presentation" class="active">
                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Fecha" id="tab1">
                            <span class="round-tab">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </a>
                    </li>

                    <li role="presentation" class="disabled" id="s2">
                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Horario">
                            <span class="round-tab">
                                <i class="fa fa-clock-o"></i>
                            </span>
                        </a>
                    </li>
                    <li role="presentation" class="disabled" id="s3">
                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Programar pago">
                            <span class="round-tab">
                                <i class="fa fa-credit-card"></i>
                            </span>
                        </a>
                    </li>

                    <li role="presentation" class="disabled" id="s4">
                        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Confirmar">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-ok"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="step1">
                       <span style="font-size: 18px;">Fecha</span><br/><br/>
                                  <div class="box box-solid bg-black-gradient calendar">
                                        <div class="box-header">
                                          <i class="fa fa-calendar"></i>

                                            <h3 class="box-title">Seleccionar día</h3>
                                          <!-- tools box -->
                                          <!-- /. tools -->
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body no-padding">
                                          <!--The calendar -->
                                            <div id="calendar1" style="width: 100%;" align="center"></div>
                                        </div>
                                        <!-- /.box-body -->
                                        
                                      </div>
                                      <div style="width: 100%; display: none;" align="center" class="calendarNull">
                                        @include('empty.emptyData', 
                                            [
                                              'emptyc' => 'not_buttom',
                                              'title'  => 'Expedientes',
                                              'icon'   => 'adminlte.empty-calendar'
                                            ]
                                          )
                                       <script type="text/javascript">
                                          $('#imgEmpty').css('width','150px');
                                          $('#imgEmpty').css('height','150px');
                                          $('.spanEmpty1').html('{{ $title }}');
                                       </script>   
                                      </div>

                                      <input type="hidden" id="dateSelectedForCite" value="">
                                       <br/>
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-secondary btn-flat btn-sm next-step" id="onestep" disabled="disabled">Siguiente</button>
                        </div>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step2">
                       <span style="font-size: 18px;">Seleccionar Horario</span><br/><br/>

                           <div class="form-group">
                          <div class="col-sm-12">
                          <select id="timesByDay" class="form-control">
                          </select>
                         </div>
                         </div>
                          <br/>

                          <div class="btn-group pull-right">
                        <button type="button" class="btn btn-default btn-flat btn-sm prev-step">Anterior</button>
                        <button type="button" class="btn btn-secondary btn-flat btn-sm next-step">Siguiente</button>
                         </div>

                    </div>
                    <div class="tab-pane" role="tabpanel" id="step3">
                        <span style="font-size: 18px;">Programar pago</span>
                        <br/><br/>
                        <div class="form-group">
                         <div class="col-sm-12">
                             <select id="paymentMethodsFields" class="form-control selectpicker">
                             </select>
                         </div>
                       </div>
                         <br/>     
                          <form action="/payment/postPaymentWithpaypal" id="formulatio_paypal" method="post" class="form-horizontal">
                                  {{ csrf_field() }}
                            <input id="amount" type="hidden" class="form-control" name="amount"/>
                            <input type="hidden" name="id" id="idcard"/>
                             <input type="hidden" name="receiver" id="receiver"/>
                             <input type="hidden" name="when" id="when"/>
                             <input type="hidden" name="when1" id="when1"/>
                             <input type="hidden" name="dr" id="dr"/>
                             <input type="hidden" name="idlabor" id="idlabor"/>
                             <input type="hidden" name="spe" id="spe"/>
                        

                          <div class="btn-group pull-right">
                            <button type="button" class="btn btn-default btn-flat btn-sm prev-step">Anterior</button>
                            <button type="button" class="btn btn-secondary btn-flat btn-sm next-step">Siguiente</button>
                          </div>

                    </div>
                    <div class="tab-pane" role="tabpanel" id="complete">
                        <span style="font-size: 18px;">Confirmar</span><br/><br/>
                       <label id="enddate"> </label><br/>
                       <label id="endtime"> </label><br/>
                       <label id="endpayment"> </label><br/>
                       <label id="endamount"></label><br/>
                       

                         <button type="submit" id="cite" class="btn btn-secondary btn-block btn-flat btn-sm">
                            Confirmar y programar cita
                          </button>
                          </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
        </div>
    </section>

                <!--WIZARD TEST-->


          <script type="text/javascript">

$(document).ready(function () {
       $( "#medications" ).modal();
                         $( ".modal-register-cite" ).on('shown.bs.modal', function (e) {
                          var vis = $(this).find( ".calendarNull" );
                             if(vis.is(":visible")){
                                    $.ajax(
                                    {
                                      type: "GET",    
                                      url: "{{ url('medicalconsultations/notificationdr') }}/" + document.getElementById('dr').value, 
                                      success: function(result){
                                      }
                                    })
                                  }
                      })

 $('#mySelect').on('change', function() {
        if( $('#mySelect').val() !== firstValue){
          $("#general" ).prop( "checked", false );
          $('#general').attr('checked', false);
          startProcess = false;
          typeC = 'TypeSpeciality';
        }
       if( $('#mySelect').val() == firstValue){
          $("#general" ).prop( "checked", true);
          $('#general').attr('checked', true);
          startProcess = false;
          typeC = 'TypeGeneral';
        }
      })
    //Initialize tooltips
       $('#footerw').css("display", "none");
       $('#modalsuccess').modal('show');
       $('#modalerror').modal('show');
 $("#paymentMethodsFields").on("change", function(){
        document.getElementById('endtime').innerHTML = 'Hora: ' + $('#timesByDay option:selected').text();
        document.getElementById('endpayment').innerHTML =  'Método de Pago: ' + $('#paymentMethodsFields option:selected').text();
        document.getElementById("idcard").value = document.getElementById('paymentMethodsFields').value;
        if(document.getElementById('paymentMethodsFields').value != "Paypal"){
          $('#formulatio_paypal').attr('action', '/medicalappointments/store');
         document.getElementById('when').value = document.getElementById('when1').value +' '+ $('#timesByDay option:selected').text() +':00';
        }
       if(document.getElementById('paymentMethodsFields').value == "Paypal"){
          $('#formulatio_paypal').attr('action', '/payment/postPaymentWithpaypal');
                   document.getElementById('when').value = document.getElementById('when1').value +' '+ $('#timesByDay option:selected').text() +':00';
        }
                        })
          $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });
    $(".next-step").click(function (e) {
        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);
        document.getElementById('endtime').innerHTML = 'Hora: ' + $('#timesByDay option:selected').text();
        document.getElementById('endpayment').innerHTML =  'Método de Pago: ' + $('#paymentMethodsFields option:selected').text();
        document.getElementById("idcard").value = document.getElementById('paymentMethodsFields').value;
        if(document.getElementById('paymentMethodsFields').value != "Paypal"){
          $('#formulatio_paypal').attr('action', '/medicalappointments/store');
         document.getElementById('when').value = document.getElementById('when1').value +' '+ $('#timesByDay option:selected').text() +':00';
        }
       if(document.getElementById('paymentMethodsFields').value == "Paypal"){
          $('#formulatio_paypal').attr('action', '/payment/postPaymentWithpaypal');
                   document.getElementById('when').value = document.getElementById('when1').value +' '+ $('#timesByDay option:selected').text() +':00';
        }
    });
    $(".prev-step").click(function (e) {
        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);
    });
});
function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}
               
          $(function () {
            $('select').select2({
                width: "100%",
            });
          });
            $.ajax(
              {
                type: "GET",    
                url: "medicalappointments/showPaymentMethods", 
                success: function(result){
                  /*console.log(result);*/
                  var x = document.getElementById("paymentMethodsFields");
                   var option = document.createElement("option");
                    option.text = "Paypal";
                    option.value = "Paypal";
                    option.setAttribute("data-icon", "glyphicon glyphicon-eye-open");
                    x.add(option);
                  for (var i = result.length - 1; i >= 0; i--) {
                    
                    var option = document.createElement("option");
                    if(result[i].provider != 'Paypal'){
                    option.text = result[i].provider + ": " + result[i].cardnumber;
                    option.value = result[i].id;
                    option.setAttribute("data-icon", "glyphicon glyphicon-eye-open");
                    x.add(option);
                        }
                        
                  }
                }
              });

           $.ajax({
                type: "GET",    
                url: "medicalconsultations/showrecent", 
                success: function(result){
                 /*console.log(result.length);
                  console.log(result);*/
                  if(result.length > '0'){

                   $('#recentS').show();
                   var result1 = JSON.parse(result).reverse();            
                              for(var z=0; z < result1.length; z++){
                                 $('#resp').append('<a data-value="'+ result1[z] +'" onclick="showvalue(this);" class="recent btn text-muted" style="text-align: left;white-space: normal;"><i class="fa fa-map-marker"></i> '+ result1[z] +'<br/></a>');
                               }
                  
                    }
                  }
                });

              function showvalue (link){
                  var value = link.getAttribute("data-value");
                  document.getElementById('address').value = value;
                  document.getElementById('submit').click();
              }
          </script>


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
        var specialities1 = specialities.sort();
        specialities1 = specialities.reverse();
        for (var i = 0; i < specialities1.length; i++) {
        var c = document.createElement("option");
        c.text = specialities1[i][0];
        x.options.add(c, 1);
        }
      }
      function changeCheck(){
        if (!document.getElementById('general').checked){
          startProcess = false;
          typeC = 'TypeSpeciality';
           start();
          
        }
        if (document.getElementById('general').checked){
          startProcess = false;
          var x = document.getElementById("mySelect");   
          x.selectedIndex = 0;
          typeC = 'TypeGeneral';
          document.getElementById("infoSpDetail").innerHTML = ' ';
          document.getElementById('infoSp').style.display = 'none';
          document.getElementById("label01").innerHTML = "Médico General";
          $('#mySelect').val("- Ninguna -").trigger("change");
          start();
          $("#myModal").modal("hide");
        }
      }
      function showM(){
        if (!document.getElementById('general').checked){
          startProcess = false;
          typeC = 'TypeSpeciality';
          $("#myModal").modal({backdrop: "static"});
        }
      }
    function showMy(){
          $("#myModal").modal();
        
      }
      function hideM(){
        if (document.getElementById('general').checked)
          $("#myModal").modal("hide");
      }
      function hideM2(){
        $("#myModal").modal("hide");
      }

    </script>

    <!-- Current range -->
    <script>
      var slider = document.getElementById("rango01");
      var output2 = document.getElementById("rango03");
      var output3 = document.getElementById("rango04");
      var defaultVal = slider.defaultValue;
      output2.innerHTML = slider.value;
      output3.innerHTML = slider.value;
      slider.oninput = function() {
        output2.innerHTML = this.value;
        output3.innerHTML = this.value;
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
      document.getElementById("labelextra").innerHTML = "Médico General";
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
        //Value of word for search
        var keySearch = document.getElementById("kWSearch").value;
        //Value of indicated Position
        markerLatLng = markerP.getPosition();
        //Value of Range to search
        var x = document.getElementById("rango01");
        var currentVal = x.value * 1000;
        
        if(typeC == 'TypeSpeciality'){

          if(selectedValue !== firstValue){
            hideM2();
            document.getElementById('infoSp').style.display = 'block';
            document.getElementById("infoSpDetail").innerHTML = selectedValue;
            document.getElementById("labelextra").innerHTML = selectedValue;
            functionEsp(selectedValue, keySearch, markerLatLng, currentVal);
            drop();
            }
          }
          if(typeC == 'TypeGeneral'){
            document.getElementById('infoSp').style.display = 'none';
            document.getElementById("label01").innerHTML = "Médico General";
            document.getElementById("labelextra").innerHTML = "Médico General";
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
       */

      window.onload = function(){

         $('#loadingmodal').modal({backdrop: 'static', keyboard: false})
        var height;
        if("@php echo $agent->isMobile(); @endphp"){
            //var mensaje2 = "@php echo $agent->version('Android'); @endphp";
            height = window.screen.availHeight;
            //alert("Altura: "+height);
            if(height >= 1000 && height <= 1300){
                var h = height*0.39;
                height = Math.floor(h);
            }else if(height >=1800){
              height -= 1480;
            }else
            {
              height -=160;
            }
        }else{
          height = window.screen.availHeight-156;
        }
        document.getElementById('map').setAttribute("style","height:" + height + "px");
        initMap();
        infoSelect();
        setTimeout(function(){
          $('#loadingmodal').modal('toggle');
        }, 2000);
      };
      function initMap() {
        //var image = "{{ asset('maps-and-flags_1.png') }}";
        $('#dragmap').fadeOut(); 
        $('#modal').modal('hide');
        infoWindow = new google.maps.InfoWindow();
        //Current position
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            //Map
            map = new google.maps.Map(document.getElementById('map'), {
              zoom: 14,
              gestureHandling: 'greedy',
              center: new google.maps.LatLng(pos),
              styles: [
                        {
                          "elementType": "labels",
                          "stylers": [
                            {
                              "visibility": "off"
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
                          "featureType": "administrative.neighborhood",
                          "stylers": [
                            {
                              "visibility": "off"
                            }
                          ]
                        },
                        {
                          "featureType": "landscape.man_made",
                          "elementType": "labels.icon",
                          "stylers": [
                            {
                              "visibility": "on"
                            }
                          ]
                        },
                        {
                          "featureType": "poi.attraction",
                          "stylers": [
                            {
                              "visibility": "off"
                            }
                          ]
                        },
                        {
                          "featureType": "poi.business",
                          "stylers": [
                            {
                              "saturation": -100
                            },
                            {
                              "visibility": "simplified"
                            }
                          ]
                        },
                        {
                          "featureType": "poi.medical",
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
                              "visibility": "on"
                            }
                          ]
                        },
                        {
                          "featureType": "poi.place_of_worship",
                          "stylers": [
                            {
                              "visibility": "simplified"
                            }
                          ]
                        },
                        {
                          "featureType": "poi.school",
                          "stylers": [
                            {
                              "visibility": "off"
                            }
                          ]
                        },
                        {
                          "featureType": "poi.sports_complex",
                          "stylers": [
                            {
                              "visibility": "off"
                            }
                          ]
                        },
                        {
                          "featureType": "water",
                          "stylers": [
                            {
                              "visibility": "off"
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

            var input = document.getElementById('address');
            var autocomplete = new google.maps.places.Autocomplete(input);
               autocomplete.setComponentRestrictions(
            {'country': ['mx']});
            var markerUser = "{{ asset('markerloc.png') }}";
           
            var pinIcon = new google.maps.MarkerImage(
                  "{{ asset('markerloc.png') }}",
                  null, /* size is determined at runtime */
                  null, /* origin is 0,0 */
                  null, /* anchor is bottom center of the scaled image */
                  new google.maps.Size(40, 40)
              ); 


            //Marker
              markerP = new google.maps.Marker({
              draggable: true,
              position: new google.maps.LatLng(pos),
              icon: pinIcon,
              map: map
            }); 
                 //Bound México (North East and South West)
                 var strictBounds = new google.maps.LatLngBounds(
                                    new google.maps.LatLng(14.3895,-118.6523),
                                    new google.maps.LatLng(32.718653,-86.5887)
                                    );
                  //Here function dragend map in marker//
                  google.maps.event.addListener(map, 'dragend', function(){

                        if("@php echo $agent->isMobile(); @endphp"){
                            var complat = markerP.getPosition().lat() + 0.015;
                            var complng = markerP.getPosition().lng() + 0.015;
                            var complat2 = markerP.getPosition().lat() - 0.015;
                            var complng2 = markerP.getPosition().lng() - 0.015;
                        }else{
                            var complat = markerP.getPosition().lat() + 0.03;
                            var complng = markerP.getPosition().lng() + 0.04;
                            var complat2 = markerP.getPosition().lat() - 0.03;
                            var complng2 = markerP.getPosition().lng() - 0.04;  
                        }
                        //console.log('marker'+ markerP.getPosition().lat() +' : ' + complat +'-'+complat2);
                      if(this.center.lat() > complat || this.center.lng() > complng || this.center.lat() < complat2 || this.center.lng() < complng2){
                          if(!strictBounds.contains(map.getCenter())){
                              map.setCenter(markerP.getPosition());
                               }
                          else{
                                $('#dragmap').fadeIn();
                                var latlng = new google.maps.LatLng(this.center.lat(),this.center.lng());
                                $('#dragbutton').prop('data-lng',latlng);
                              }
                        }                                    
                      });

                        $('#dragbutton').click(function() {
                            var look = $('#dragbutton').prop('data-lng'); 
                             $('#dragmap').fadeOut(); 
                            markerP.setPosition(look);
                            start();
                        });

                     /*  map.addListener('center_changed', function(event) {
                          console.log(this);
                        });*/

            if("@php echo $agent->isMobile(); @endphp"){
            var opt = { minZoom: 6, maxZoom: 20, zoomControl: false, componentRestrictions: {country: 'mx'}};
             map.setOptions(opt);
           }else{
           var opt = { minZoom: 6, maxZoom: 20, zoomControl: false, componentRestrictions: {country: 'mx'}};
             map.setOptions(opt);
           }
            //Evento to open infowindow
            markerP.addListener('click', function() {
              infoWindow.open(map, markerP);
              infoWindow.setContent(message01);
            });
                var geocoder = new google.maps.Geocoder();
                start();
                document.getElementById('submit').addEventListener('click', function() {
                geocodeAddress(geocoder, map, markerP);
                $('#modal').modal('hide');
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                 var address1 = document.getElementById('address').value;
                           $.ajax({     
                             type: "POST",                 
                             url: "medicalconsultations/recent",  
                              data: { "search" : address1 }, 
                              dataType: 'json',                
                             success: function(data)             
                             {
                       var data1 = JSON.parse(data).reverse(); 
                       $('#recentS').show();
                       $(".recent").remove();

                              for(var z=0; z < data1.length; z++){
                                 $('#resp').append('<a data-value="'+ data1[z] +'" onclick="showvalue(this);" class="recent btn text-muted" style="text-align: left;white-space: normal;"><i class="fa fa-map-marker"></i> '+ data1[z] +'<br/></a>');
                               }
                                document.getElementById('address').value = " ";     
                             }
                         });
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
        geocoder.geocode({'address': address, componentRestrictions: {
            country: 'MX'
          }},function(results, status) {
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            markerP.setPosition(results[0].geometry.location);
          } else {
            alert('Busqueda no es posible, por siguiente error: ' + status);
          }
        });
      }
  
      //Filter of Speciality
      function functionEsp(specialityValue, keyWordValue, positionValue, rangeValue) {
        var res = [];
        loc = [];
       /* console.log('specialityValue:: '+specialityValue);
        console.log('keyWordValue:: '+keyWordValue);
        console.log('positionValue:: '+positionValue);
        console.log('rangeValue:: '+rangeValue);*/
        if(keyWordValue == ''){
          for(var i = 0; i < datos.length; i++) {
            if(datos[i][0] == specialityValue){
              res.push([datos[i][1], datos[i][2], datos[i][0], datos[i][3], datos[i][4], datos[i][5], datos[i][6], datos[i][7], datos[i][8], datos[i][9], datos[i][10], datos[i][11]]);
            }
          }
        }else{
          for(var i = 0; i < datos.length; i++) {
            if(datos[i][0] == specialityValue && datos[i][3] == keyWordValue){
              res.push([datos[i][1], datos[i][2], datos[i][0], datos[i][3], datos[i][4], datos[i][5], datos[i][6], datos[i][7], datos[i][8], datos[i][9], datos[i][10], datos[i][11]]);
            }
          }          
        }
        for(var i = 0; i < res.length; i++) {
          var posB = new google.maps.LatLng(res[i][0], res[i][1]);
          metros = google.maps.geometry.spherical.computeDistanceBetween(positionValue, posB);
         /* console.log('metros:: '+metros);
          console.log('Nombre:: '+res[i][3]);*/
          if(metros < rangeValue){
            //loc[latitud, longitud, especialidad, nombre, hospital, dirección, workid, iddr]
            loc.push([res[i][0], res[i][1], res[i][2], res[i][3], res[i][4], res[i][5], res[i][6], res[i][7], res[i][8], res[i][9], res[i][10], res[i][11]]);
          }
        }
       /* console.log(res);
        console.log(loc);*/
        
        if(loc.length <= 0){
          /*console.log('NO ENCONTRO MÉDICO');
          console.log('TAMAÑO:: '+loc.length);*/
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
        /*console.log('keyWordValue:: '+keyWordValue);
        console.log('positionValue:: '+positionValue);
        console.log('rangeValue:: '+rangeValue);*/

          for(var i = 0; i < generalM.length; i++) {
            if(generalM[i][2] == keyWordValue){
               res.push([generalM[i][0], generalM[i][1], "Médico General", generalM[i][2], generalM[i][3], generalM[i][4],generalM[i][5],generalM[i][6],generalM[i][7],generalM[i][8],generalM[i][9],generalM[i][10]]);
            }
          }
          for(var i = 0; i < res.length; i++) {
            var posB = new google.maps.LatLng(res[i][0], res[i][1]);
            metros = google.maps.geometry.spherical.computeDistanceBetween(positionValue, posB);
            /*console.log('metros:: '+metros);
            console.log('Nombre:: '+res[i][3]);*/
            if(metros < rangeValue){
               //loc[latitud, longitud, especialidad, nombre, hospital, dirección, precio, intervalos]
               loc.push([res[i][0], res[i][1], res[i][2], res[i][3], res[i][4], res[i][5], res[i][6], res[i][7], res[i][8], res[i][9], res[i][10], res[i][11]]);
             }
          }
          if(loc.length <= 0){
            /*console.log('NO ENCONTRO MÉDICO');
            console.log('TAMAÑO:: '+loc.length);*/
            document.getElementById("ShowDetails").innerHTML = '<strong>'+error02+'.</strong>';
            document.getElementById("info").innerHTML = ' ';
          }else{
            document.getElementById("ShowDetails").innerHTML = '<strong>' + result01 + ' ' + keyWordValue +'.</strong>';
          }
      }
      function drop() {
        clearMarkers();
        for (var i = 0; i < loc.length; i++) {
          var lat = loc[i][0];
          var lon = loc[i][1];

          if(loc[i][10] != "https://s3.amazonaws.com/abiliasf/iconoo_doc_verde-01.png"){
          var doctor = {
              url:"https://s3.amazonaws.com/abiliasf/" + loc[i][8] + "-circle.png",
              scaledSize: new google.maps.Size(45, 45)
            };
        }else{
           var doctor = {
              url: "https://s3.amazonaws.com/abiliasf/iconoo_doc_verde-01.png",
              scaledSize: new google.maps.Size(45, 45)
            };
        }
        markers[i] = new google.maps.Marker({
            position: new google.maps.LatLng(lat,lon),
            animation: google.maps.Animation.DROP,
            icon: doctor 
          });
          var infowindow = new google.maps.InfoWindow();
          var marker = markers[i];
          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              $('#infDr').show();
              document.getElementById('Drp').innerHTML = '<img src="' + loc[i][10] +'" class="img-circle" alt="User Image" style="height: 65px;">';
              document.getElementById('bodyDr').innerHTML = "<b>"+loc[i][2]+"</b><br>"+loc[i][3]+"</b><br>"+loc[i][4]+"</b><br>Consulta: $"+loc[i][5];
              document.getElementById('btncita').innerHTML = '<button type="button" class="btn btn-default btn-flat btn-xs btncita" id="'+ loc[i][7] +'"><b>Concretar Cita</b></button>';
              console.log(loc[i][7]);
             console.log(loc[i][11]);
           $('#'+ loc[i][7]).on('click', function(){
              $('#infDr').hide();
              $('#tab1').trigger('click');
              document.getElementById("onestep").disabled = true;
               $('#s2').addClass("disabled");
               $('#s3').addClass("disabled");
               $('#s4').addClass("disabled");
              $('#formulatio_paypal').trigger("reset");
              showInfo(loc[i][2] + ', ' + loc[i][3] + '.<br>Costo consulta: $' + loc[i][5] +'<br>');
              document.getElementById('amount').value = loc[i][5];
              document.getElementById('endamount').innerHTML = 'Monto a pagar: $' + loc[i][5];
              document.getElementById('receiver').value = loc[i][3];
              document.getElementById('idlabor').value = loc[i][7];
              document.getElementById('dr').value = loc[i][8];
              document.getElementById('spe').value = loc[i][2];
              var whencites = loc[i][9];
              var blockers = loc[i][11];
              $('.modal-register-cite').modal('show');
                  var x = document.getElementById("timesByDay");
                  var optionhour = loc[i][6].reverse();
                if(optionhour.length > 0){  
                      $(".calendar").css("display","block");
                      $(".calendarNull").css("display","none");
                
                  var days = [0,1,2,3,4,5,6];
                  var resp = Array();
                  var resp2 = Array();
                  var Dom = Array();
                  var Lun = Array();
                  var Mar = Array();
                  var Mie = Array();
                  var Jue = Array();
                  var Vie = Array();                
                  var Sab = Array();
                  $('#calendar1').datepicker('destroy');
                 $('#timesByDay').children().remove();
                  for (var y = optionhour.length - 1; y >= 0; y--) { 
                     resp = optionhour[y].split(":",2); 
                     resp2 = JSON.parse(optionhour[y].slice(4));

                      if(resp[0] == 'Dom'){
                        Dom = resp2;
                      var index = days.indexOf(0);
                       if (index > -1) {
                               days.splice(index, 1);
                            }
                        }
                        if(resp[0] == 'Lun'){
                          Lun = resp2;
                        var index = days.indexOf(1);
                        if (index > -1) {
                               days.splice(index, 1);
                            }
                        }
                        if(resp[0] == 'Mar'){
                          Mar = resp2;
                          var index = days.indexOf(2);
                           if (index > -1) {
                               days.splice(index, 1);
                            }
                        }
                        if(resp[0] == 'Mie'){
                          Mie = resp2;
                          var index = days.indexOf(3);
                        if (index > -1) {
                               days.splice(index, 1);
                            }
                        }
                        if(resp[0] == 'Jue'){
                         Jue = resp2;
                          var index = days.indexOf(4);
                        if (index > -1) {
                               days.splice(index, 1);
                            }
                        }
                        if(resp[0] == 'Vie'){
                          Vie = resp2;
                          var index = days.indexOf(5);
                        if (index > -1) {
                               days.splice(index, 1);
                            }
                        }
                        if(resp[0] == 'Sab'){
                          Sab = resp2;
                          var index = days.indexOf(6);
                          if (index > -1) {
                               days.splice(index, 1);
                            }
                        }

                  }
 
                     $('#calendar1').datepicker({ daysOfWeekDisabled: days, startDate: "today", language: 'es' }).on('changeDate',function(e){
                     $('#timesByDay').children().remove();
                         document.getElementById("onestep").disabled = false;
                         var da = moment(e.date.toISOString()).format("DD-MM-YYYY");
                         var da2 = moment(e.date.toISOString()).format("YYYY-MM-DD");
                         var da3 = moment(e.date.toISOString()).format("YYYY-MM-DD");
                         document.getElementById("enddate").innerHTML = "Fecha: " + da;
                         document.getElementById('when1').value = da2;
                         var fech = Array();
                         var start = Array();
                         var end = Array();
                        
                     for(var f = 0; f < whencites.length; f++){
                        if(whencites[f].slice(0,-9) == da2){  
                          fech.push(whencites[f].slice(11));  
                          }   
                        }
                     for(var o = 0; o < blockers.length; o++){
                        if(blockers[o]['start'].slice(0,-9) == da2 && blockers[o]['start'] > moment(Date.now()).format('YYYY-MM-DD HH:mm')){  
                          start.push(blockers[o]['start']);
                          end.push(blockers[o]['end']);  
                          }   
                        }   

                        if (e.date.getDay() == 0) {
                          var Dom1 = $(Dom).not(fech).get();
                          for(var d = 0; d < Dom1.length; d++){
                            if(start.length > 0){
                            for(var u=0; u < start.length; u++){
                              if(da3  + ' ' + Dom1[d].slice(0,-3) < moment(start[u]).format('YYYY-MM-DD HH:mm') || da3  + ' ' + Dom1[d].slice(0,-3) > moment(end[u]).format('YYYY-MM-DD HH:mm') ){
                                if(da3  + ' ' + Dom1[d].slice(0,-3) > moment(Date.now()).format('YYYY-MM-DD HH:mm')){
                                   var option = document.createElement("option");
                                    option.text = Dom1[d].slice(0,-3);
                                    option.value = Dom1[d].slice(0,-3);
                                    x.add(option);
                                }
                              }
                             }
                          }else{
                            if(da3  + ' ' + Dom1[d].slice(0,-3) > moment(Date.now()).format('YYYY-MM-DD HH:mm')){
                                   var option = document.createElement("option");
                                    option.text = Dom1[d].slice(0,-3);
                                    option.value = Dom1[d].slice(0,-3);
                                    x.add(option);

                                }
                         }
                        }
                           $("#timesByDay option[value='asueto ']").remove();
                           $("#timesByDay option").val(function(idx, val) {
                              $(this).siblings('[value="'+ val +'"]').remove();
                            });
                        
                      }

                        if (e.date.getDay() == 1) {
                           var Lun1 = $(Lun).not(fech).get();
                          for(var d = 0; d < Lun1.length; d++){
                            if(start.length > 0){
                            for(var u=0; u < start.length; u++){
                              if(da3  + ' ' + Lun1[d].slice(0,-3) < moment(start[u]).format('YYYY-MM-DD HH:mm') || da3  + ' ' + Lun1[d].slice(0,-3) > moment(end[u]).format('YYYY-MM-DD HH:mm') ){
                                if(da3  + ' ' + Lun1[d].slice(0,-3) > moment(Date.now()).format('YYYY-MM-DD HH:mm')){
                                   var option = document.createElement("option");
                                    option.text = Lun1[d].slice(0,-3);
                                    option.value = Lun1[d].slice(0,-3);
                                    x.add(option);
                                }
                              }
                             }
                          }else{
                            if(da3  + ' ' + Lun1[d].slice(0,-3) > moment(Date.now()).format('YYYY-MM-DD HH:mm')){
                                   var option = document.createElement("option");
                                    option.text = Lun1[d].slice(0,-3);
                                    option.value = Lun1[d].slice(0,-3);
                                    x.add(option);

                                }
                         }
                        }
                           $("#timesByDay option[value='asueto ']").remove();
                           $("#timesByDay option").val(function(idx, val) {
                              $(this).siblings('[value="'+ val +'"]').remove();
                            });
                        }

                       if (e.date.getDay() == 2) {
                       
                          var Mar1 = $(Mar).not(fech).get();
                          for(var d = 0; d < Mar1.length; d++){
                            if(start.length > 0){
                            for(var u=0; u < start.length; u++){
                              if(da3  + ' ' + Mar1[d].slice(0,-3) < moment(start[u]).format('YYYY-MM-DD HH:mm') || da3  + ' ' + Mar1[d].slice(0,-3) > moment(end[u]).format('YYYY-MM-DD HH:mm') ){
                                if(da3  + ' ' + Mar1[d].slice(0,-3) > moment(Date.now()).format('YYYY-MM-DD HH:mm')){
                                   var option = document.createElement("option");
                                    option.text = Mar1[d].slice(0,-3);
                                    option.value = Mar1[d].slice(0,-3);
                                    x.add(option);
                                }
                              }
                             }
                          }else{
                            if(da3  + ' ' + Mar1[d].slice(0,-3) > moment(Date.now()).format('YYYY-MM-DD HH:mm')){
                                   var option = document.createElement("option");
                                    option.text = Mar1[d].slice(0,-3);
                                    option.value = Mar1[d].slice(0,-3);
                                    x.add(option);

                                }
                         }
                        }
                           $("#timesByDay option[value='asueto ']").remove();
                           $("#timesByDay option").val(function(idx, val) {
                              $(this).siblings('[value="'+ val +'"]').remove();
                            });
                        }

                       if (e.date.getDay() == 3) {
                          var Mie1 = $(Mie).not(fech).get();
                          for(var d = 0; d < Mie1.length; d++){
                            if(start.length > 0){
                            for(var u=0; u < start.length; u++){
                              if(da3  + ' ' + Mie1[d].slice(0,-3) < moment(start[u]).format('YYYY-MM-DD HH:mm') || da3  + ' ' + Mie1[d].slice(0,-3) > moment(end[u]).format('YYYY-MM-DD HH:mm') ){
                                if(da3  + ' ' + Mie1[d].slice(0,-3) > moment(Date.now()).format('YYYY-MM-DD HH:mm')){
                                   var option = document.createElement("option");
                                    option.text = Mie1[d].slice(0,-3);
                                    option.value = Mie1[d].slice(0,-3);
                                    x.add(option);
                                }
                              }
                             }
                          }else{
                            if(da3  + ' ' + Mie1[d].slice(0,-3) > moment(Date.now()).format('YYYY-MM-DD HH:mm')){
                                   var option = document.createElement("option");
                                    option.text = Mie1[d].slice(0,-3);
                                    option.value = Mie1[d].slice(0,-3);
                                    x.add(option);
                                }
                         }
                        }
                           $("#timesByDay option[value='asueto ']").remove();
                           $("#timesByDay option").val(function(idx, val) {
                              $(this).siblings('[value="'+ val +'"]').remove();
                            });
                        } 

                       if (e.date.getDay() == 4) {
                          var Jue1 = $(Jue).not(fech).get();
                          for(var d = 0; d < Jue1.length; d++){
                            if(start.length > 0){
                            for(var u=0; u < start.length; u++){
                              if(da3  + ' ' + Jue1[d].slice(0,-3) < moment(start[u]).format('YYYY-MM-DD HH:mm') || da3  + ' ' + Jue1[d].slice(0,-3) > moment(end[u]).format('YYYY-MM-DD HH:mm') ){
                                if(da3  + ' ' + Jue1[d].slice(0,-3) > moment(Date.now()).format('YYYY-MM-DD HH:mm')){
                                   var option = document.createElement("option");
                                    option.text = Jue1[d].slice(0,-3);
                                    option.value = Jue1[d].slice(0,-3);
                                    x.add(option);
                                }
                              }
                             }
                          }else{
                            if(da3  + ' ' + Jue1[d].slice(0,-3) > moment(Date.now()).format('YYYY-MM-DD HH:mm')){
                                   var option = document.createElement("option");
                                    option.text = Jue1[d].slice(0,-3);
                                    option.value = Jue1[d].slice(0,-3);
                                    x.add(option);
                                }
                         }
                        }
                           $("#timesByDay option[value='asueto ']").remove();
                           $("#timesByDay option").val(function(idx, val) {
                              $(this).siblings('[value="'+ val +'"]').remove();
                            });
                        }        

                        if (e.date.getDay() == 5) {
                          var Vie1 = $(Vie).not(fech).get();
                          for(var d = 0; d < Vie1.length; d++){
                            if(start.length > 0){
                            for(var u=0; u < start.length; u++){
                              if(da3  + ' ' + Vie1[d].slice(0,-3) < moment(start[u]).format('YYYY-MM-DD HH:mm') || da3  + ' ' + Vie1[d].slice(0,-3) > moment(end[u]).format('YYYY-MM-DD HH:mm') ){
                                if(da3  + ' ' + Vie1[d].slice(0,-3) > moment(Date.now()).format('YYYY-MM-DD HH:mm')){
                                   var option = document.createElement("option");
                                    option.text = Vie1[d].slice(0,-3);
                                    option.value = Vie1[d].slice(0,-3);
                                    x.add(option);
                                }
                              }
                             }
                          }else{
                            if(da3  + ' ' + Vie1[d].slice(0,-3) > moment(Date.now()).format('YYYY-MM-DD HH:mm')){
                                   var option = document.createElement("option");
                                    option.text = Vie1[d].slice(0,-3);
                                    option.value = Vie1[d].slice(0,-3);
                                    x.add(option);
                                }
                         }
                        }
                           $("#timesByDay option[value='asueto ']").remove();
                           $("#timesByDay option").val(function(idx, val) {
                              $(this).siblings('[value="'+ val +'"]').remove();
                            });
                        }

                       if (e.date.getDay() == 6) {
                          var Sab1 = $(Sab).not(fech).get();
                          for(var d = 0; d < Sab1.length; d++){
                            if(start.length > 0){
                            for(var u=0; u < start.length; u++){
                              if(da3  + ' ' + Sab1[d].slice(0,-3) < moment(start[u]).format('YYYY-MM-DD HH:mm') || da3  + ' ' + Sab1[d].slice(0,-3) > moment(end[u]).format('YYYY-MM-DD HH:mm') ){
                                if(da3  + ' ' + Sab1[d].slice(0,-3) > moment(Date.now()).format('YYYY-MM-DD HH:mm')){
                                   var option = document.createElement("option");
                                    option.text = Sab1[d].slice(0,-3);
                                    option.value = Sab1[d].slice(0,-3);
                                    x.add(option);
                                }
                              }
                             }
                          }else{
                            if(da3  + ' ' + Sab1[d].slice(0,-3) > moment(Date.now()).format('YYYY-MM-DD HH:mm')){
                                   var option = document.createElement("option");
                                    option.text = Sab1[d].slice(0,-3);
                                    option.value = Sab1[d].slice(0,-3);
                                    x.add(option);
                                }
                         }
                        }
                           $("#timesByDay option[value='asueto ']").remove();
                           $("#timesByDay option").val(function(idx, val) {
                              $(this).siblings('[value="'+ val +'"]').remove();
                            });
                        }

                      $('#dateSelectedForCite').val = e.date.toISOString();                  
                      });
                     }else{
                      $(".calendar").css("display","none");
                      $(".calendarNull").css("display","block");

                                  
                              }

                });
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
        document.getElementById("info").innerHTML = '<strong>Detalle del médico:</strong> <br/><span style="font-size:12px;">'+ info +'</span>';
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