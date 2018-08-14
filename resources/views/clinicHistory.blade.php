@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
	     <style type="text/css">

        .contacts-list>li {
         border-bottom: 1px solid rgba(0,0,0,0.2);
         padding: 10px;
         margin: 0;
      }
      	 .progress-bar {
      	 	background-color: #3E3E3E;
      	 }
      	 .nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover {
          color: #fff;
          background-color: #3E3E3E;
      		}
      		.nav-pills>li.active>a, .nav-pills>li.active>a:hover, .nav-pills>li.active>a:focus {
          border-top-color: #3E3E3E;
      }
       .nav-pills {
          width: 100% !important;
          text-align: center !important;

        }

        .nav-pills > li {
            float: none !important;
            display: inline-block !important;
          }
        .checkbox {
        padding-left: 20px; }

        .checkbox label {
        display: inline-block;
        position: relative;
        padding-left: 5px; }

        .checkbox label::before {
          content: "";
          display: inline-block;
          position: absolute;
          width: 17px;
          height: 17px;
          left: 0;
          margin-left: -20px;
          border: 1px solid #cccccc;
          border-radius: 3px;
          background-color: #fff;
          -webkit-transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
          -o-transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
          transition: border 0.15s ease-in-out, color 0.15s ease-in-out; }

        .checkbox label::after {
          display: inline-block;
          position: absolute;
          width: 16px;
          height: 16px;
          left: 0;
          top: 0;
          margin-left: -20px;
          padding-left: 3px;
          padding-top: 1px;
          font-size: 11px;
          color: #555555; }

        .checkbox input[type="radio"],  
        .checkbox input[type="checkbox"] {
          opacity: 0; }

        .checkbox input[type="radio"]:checked + label::after,
        .checkbox input[type="checkbox"]:checked + label::after {
          font-family: 'FontAwesome';
          content: "\f00c"; }

        .checkbox input[type="radio"]:disabled + label,  
        .checkbox input[type="checkbox"]:disabled + label {
          opacity: 0.65; }
       
        .checkbox input[type="radio"]:disabled + label::before,
        .checkbox input[type="checkbox"]:disabled + label::before {
        background-color: #eeeeee;
        cursor: not-allowed; }

        .checkbox-primary input[type="radio"]:checked + label::before,
        .checkbox-primary input[type="checkbox"]:checked + label::before {
         background-color: #3E3E3E;
         border-color: #3E3E3E; }
        
        .checkbox-primary input[type="radio"]:checked + label::after,
        .checkbox-primary input[type="checkbox"]:checked + label::after {
          color: #fff; }

          iframe {
            max-width: 100%;
            display:block;
            margin:0 auto;
          }

                .down {
                  position:absolute;
                  bottom:5px;
                  right:10px;
                }  
                .callout.callout-success {
                    border-color: #b7b7b7 !important;
                }
                .callout {
                    padding: 5px 15px 5px 5px !important;
                    margin: 0 0 5px 0 !important;
                    border-left: 3px solid #cacaca !important;
                }
                .callout.callout-success {
                    background-color: #ffffff !important;
                    border-left: 3px solid #cacaca !important;
                }
      .direct-chat-contacts.plus {
            height: 55px !important;
            background: transparent !important; 
            top: 75% !important; 
      }


        .sticky {
          position: fixed;
          top: 0;
          width: 82%;
          z-index: 1000;
          background: #ecf0f5;
        }
        .sticky + .content {
          padding-top: 102px;
        }
       .isDisabled {
        color: currentColor;
        cursor: not-allowed;
        opacity: 0.5;
        text-decoration: none;
      }   
      input[id^="spoiler"]{
         display: none;
        }
        input[id^="spoiler"] + label {
          text-align: center;
          font-size: 12px;
          cursor: pointer;
          transition: all .6s;
        }
        input[id^="spoiler"]:checked + label {
          color: #333;
          background: #ccc;
        }
        input[id^="spoiler"] ~ .spoiler {
          overflow: hidden;
          opacity: 0;
          background: #eee;
          border: 1px solid #ccc;
          transition: all .6s;
        }
        input[id^="spoiler"]:checked + label + .spoiler{
          height: auto;
          opacity: 1;
        }
      .dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover {
        background-color: #333 !important;  
       } 
     .cut{
      width: 85%;
      text-overflow:ellipsis;
      white-space:nowrap; 
      overflow:hidden; 
    } 
    .cut2{
       word-break: break-all;
       word-wrap: break-word;
    }
    .iframe-container{
      min-height: 100px;
      background: #fff url("{{ asset('images/Loading.gif') }}") no-repeat 50% center !important;
    }



</style>


 @if($mode == 'null')  
        <div class="box">
              	<div class="box-header with-border">
            	    <h3 class="box-title">Historia Clínica</h3>
              	</div>
             
              	<div class="box-body"  id="myWizard">

                 <div class="progress">
                   	@php
                   	$percent = (1 /count($questions)) * 100;
                    $per = intval($percent);
                   	@endphp
                 <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="5" style="width: {{ $percent }}%;">
                   {{ $per }}%
                 </div>
           </div>
  

           <div class="tab-content">
           	@foreach($questions as $questions1)
             @if($loop->iteration == 1 && count($questions) == 1)
              <div class="tab-pane fade in active" id="step1">
                 
                <div class="well well-sm"> 
                  
                    <h3>{{ $questions1->question }}</h3>
                    <br>
                  @php $an = json_decode($questions1->answer); @endphp
                    <label>Respuestas:</label><br>
                    <input type="hidden" class="quesId" value="{{ $questions1->id }}">
                    <input type="hidden" class="ansId" value="{{ $questions1->a }}">

                    @foreach($an as $an)
                            <div class="checkbox checkbox-primary">
                              @php  $a2 = str_replace(" ", "_", $an); @endphp
                                <input type="hidden" id="{{ $a2 }}" value="{{ $questions1->parent_answer }}">
                                <input type="hidden" id="p{{ $a2 }}" value="{{ $questions1->parent }}">
                                <input type="hidden" id="id{{ $a2 }}" value="{{ $questions1->id }}">
                                @if($a2 == "Si" OR $a2 == "No")
                                <input id="{{ $questions1->id }}{{ $loop->iteration }}{{ $an }}" name="{{ $questions1->id }}" type="radio" value="{{ $a2 }}">
                                <label for="{{ $questions1->id }}{{ $loop->iteration }}{{ $an }}">
                                    {{ $an }}
                                </label>
                                @else
                                <input id="{{ $questions1->id }}{{ $loop->iteration }}" type="checkbox" value="{{ $a2 }}" name="resp[]" class="checkbox">
                                <label for="{{ $questions1->id }}{{ $loop->iteration }}">
                                    {{ $an }}
                                </label>
                                @endif
                                 <div class="well well-sm" style="display: none; border: 1px solid #3E3E3E; padding: 0px;"></div>
                            </div>
                     @endforeach          
                </div>
                <a class="btn btn-secondary btn-flat pull-right finish">Finalizar</a>
                </div>
                  @endif 
              @if($loop->iteration == 1 && count($questions) != 1)
              <div class="tab-pane fade in active" id="step1">
                 
                <div class="well well-sm"> 
                  
                    <h3>{{ $questions1->question }}</h3>
                    <br>
                  @php $an = json_decode($questions1->answer); @endphp
                    <label>Respuestas:</label><br>
                    <input type="hidden" class="quesId" value="{{ $questions1->id }}">
                    <input type="hidden" class="ansId" value="{{ $questions1->a }}">

                    @foreach($an as $an)
                            <div class="checkbox checkbox-primary">
                              @php  $a2 = str_replace(" ", "_", $an); @endphp
                                <input type="hidden" id="{{ $a2 }}" value="{{ $questions1->parent_answer }}">
                                <input type="hidden" id="p{{ $a2 }}" value="{{ $questions1->parent }}">
                                <input type="hidden" id="id{{ $a2 }}" value="{{ $questions1->id }}">
                                @if($a2 == "Si" OR $a2 == "No")
                                <input id="{{ $questions1->id }}{{ $loop->iteration }}{{ $an }}" name="{{ $questions1->id }}" type="radio" value="{{ $a2 }}">
                                <label for="{{ $questions1->id }}{{ $loop->iteration }}{{ $an }}">
                                    {{ $an }}
                                </label>
                                @else
                                <input id="{{ $questions1->id }}{{ $loop->iteration }}" type="checkbox" value="{{ $a2 }}" name="resp[]" class="checkbox">
                                <label for="{{ $questions1->id }}{{ $loop->iteration }}">
                                    {{ $an }}
                                </label>
                                @endif
                                 <div class="well well-sm" style="display: none; border: 1px solid #3E3E3E; padding: 0px;"></div>
                            </div>
                     @endforeach          

                </div>

           <a class="btn btn-default btn-flat next pull-right">Continuar &nbsp;<span class="fa fa-chevron-right"></span></a>
                </div>
                  @endif
                   @if(($loop->iteration > 1) && !$loop->last)
                <div class="tab-pane fade" id="step{{ $loop->iteration }}">
                   <div class="well well-sm"> 
                      <h3>{{ $questions1->question }}</h3>
                      <br>
                      @php $an = json_decode($questions1->answer); @endphp
                      <label>Respuestas:</label><br>
                      <input type="hidden" class="quesId" value="{{ $questions1->id }}">
                      <input type="hidden" class="ansId" value="{{ $questions1->a }}">

                    @foreach($an as $an)
                            <div class="checkbox checkbox-primary">
                              @php  $a2 = str_replace(" ", "_", $an); @endphp
                                <input type="hidden" id="{{ $a2 }}" value="{{ $questions1->parent_answer }}">
                                <input type="hidden" id="p{{ $a2 }}" value="{{ $questions1->parent }}">
                                <input type="hidden" id="id{{ $a2 }}" value="{{ $questions1->id }}">
                                @if($a2 == "Si" OR $a2 == "No")
                                <input id="{{ $questions1->id }}{{ $loop->iteration }}{{ $an }}" name="{{ $questions1->id }}" type="radio" value="{{ $a2 }}">
                                <label for="{{ $questions1->id }}{{ $loop->iteration }}{{ $an }}">
                                    {{ $an }}
                                </label>
                                @else
                                <input id="{{ $questions1->id }}{{ $loop->iteration }}" type="checkbox" value="{{ $a2 }}" name="resp[]" class="checkbox">
                                <label for="{{ $questions1->id }}{{ $loop->iteration }}">
                                    {{ $an }}
                                </label>
                                @endif
                                 <div class="well well-sm" style="display: none; border: 1px solid #3E3E3E; padding: 0px;"></div>
                            </div>
                     @endforeach               

                   </div>
                 <a class="btn btn-default btn-flat prev pull-left"><span class="fa fa-chevron-left"></span> &nbsp;Atrás</a>
                 <a class="btn btn-default btn-flat next pull-right">Continuar &nbsp;<span class="fa fa-chevron-right"></span></a>
              </div>
        @endif
       @if($loop->last && count($questions) != 1)
              <div class="tab-pane fade" id="step{{ $loop->iteration }}">
                 <div class="well well-sm"> 
                    <h3>{{ $questions1->question }}</h3>
                    <br>
                        @php $an = json_decode($questions1->answer); @endphp
                    <label>Respuestas:</label><br>
                      <input type="hidden" class="quesId" value="{{ $questions1->id }}">
                      <input type="hidden" class="ansId" value="{{ $questions1->a }}">

                    @foreach($an as $an)
                            <div class="checkbox checkbox-primary">
                              @php  $a2 = str_replace(" ", "_", $an); @endphp
                                <input type="hidden" id="{{ $a2 }}" value="{{ $questions1->parent_answer }}">
                                <input type="hidden" id="p{{ $a2 }}" value="{{ $questions1->parent }}">
                                <input type="hidden" id="id{{ $a2 }}" value="{{ $questions1->id }}">
                                @if($a2 == "Si" OR $a2 == "No")
                                <input id="{{ $questions1->id }}{{ $loop->iteration }}{{ $an }}" name="{{ $questions1->id }}" type="radio" value="{{ $a2 }}">
                                <label for="{{ $questions1->id }}{{ $loop->iteration }}{{ $an }}">
                                    {{ $an }}
                                </label>
                                @else
                                <input id="{{ $questions1->id }}{{ $loop->iteration }}" type="checkbox" value="{{ $a2 }}" name="resp[]" class="checkbox">
                                <label for="{{ $questions1->id }}{{ $loop->iteration }}">
                                    {{ $an }}
                                </label>
                                @endif
                                 <div class="well well-sm" style="display: none; border: 1px solid #3E3E3E; padding: 0px;"></div>
                            </div>
                     @endforeach      


                 </div>
                <a class="btn btn-default btn-flat prev pull-left"><span class="fa fa-chevron-left"></span> &nbsp;Atrás</a>
                <a class="btn btn-default btn-flat first pull-left">Volver a iniciar &nbsp;<span class="fa fa-undo"></span></a>
                <a class="btn btn-secondary btn-flat pull-right finish">Finalizar</a>
                <a id="finish" href="cHistory" style="visibility: hidden;"></a>
              </div>
         @endif
              @endforeach

           </div>
                     <div class="navbar" style="visibility: hidden" id="wiz">
                <div class="navbar-inner">
                      <ul class="nav nav-pills pull-center">
                    @foreach($questions as $question) 
                        @if($loop->iteration == 1)
                         <li class="active"><a href="#step1" data-toggle="tab" data-step="1">1</a></li>
                        @endif
                         @if($loop->iteration > 1)
                         <li><a href="#step{{ $loop->iteration }}" data-toggle="tab" data-step="{{ $loop->iteration }}">{{ $loop->iteration }}</a></li>
                         @endif
                      @endforeach
                      </ul>
                </div>
             </div>
          </div>
        </div>
@endif

@if($mode == 'finish')

    <!-- Main content -->

        @if(count($test_result) == 0)
             <div class="box-header direct-chat">
              <h3 class="box-title">
                        Expediente médico
               </h3>
          <br><br>
            @include('empty.emptyData', 
                              [
                                'emptyc' => 'not_buttom',
                                'title'  => 'Expedientes',
                                'icon'   => 'adminlte.empty-box'
                              ]
                            )
            </div>                         
        @else 
     <div class="box-header direct-chat header1" id="header1">
              <h3 class="box-title">
                        Expediente médico<a href="javascript:void(0);" onclick="visib();" style="color: #777 !important;" class="btn"><i class="fa fa-eye" id="eye"></i></a>   
               </h3> 
        <button type="button" class="btn pull-right" title="" data-widget="chat-pane-toggle">
                 <span class="fa fa-search text-muted"></span></button>
      <div class="direct-chat-contacts plus">
       <div class="col-sm-3 pull-right"><input id="search" type="text" placeholder="Buscar expedientes" class="form-control"></div>     
     </div><br>
     <div id="headeralert"></div>
   </div>

        <div class="box-body content expbody">
      <!-- row -->
     <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline"  id="exp">
            <!--  li to imbox  -->
                     @foreach($files as $date_email => $fi)
                      <li>
                        <i class="fa fa-inbox bg-green disabled"></i>

                        <div class="timeline-item">
                        <span class="time">
                           <div class="btn-group"> 
                              <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><div class="btn-block"><i class="text-muted fa fa-ellipsis-v" style="font-weight: 800 !important"></i></div></a>
                              <ul class="dropdown-menu dropdown-menu-right" role="menu" style="float: left !important;">
                                <li><a onclick="send('{{ $fi[0]->id }}');" href="javascript:void(0)">Reenviar a correo personal</a></li>
                              </ul>
                            </div>
                        </span>

                          <h3 class="timeline-header cut"><a href="javascript:void(0)">Asunto: {{ $fi[0]->subject_email }}</a></h3>

                          <div class="timeline-body">
                            Fecha. {{ $date_email }}<br>
                            From. {{ $fi[0]->email }}.<br>
                            Receta. (No especificado aún).<br>
                            <div id="spoiler{{ $fi[0]->id }}" style="display: none;" class="cut2">
                              <br>
                              <!--Imprimo correo ya sea texto plano o tipo html-->
                              @php
                                $bod = quoted_printable_decode($fi[0]->text_email);
                                echo $bod;
                              @endphp          
                            </div>
                                                          <a href="javascript:void(0)" id="a{{ $fi[0]->id }}" onclick="if(document.getElementById('spoiler{{ $fi[0]->id }}') .style.display=='none') {document.getElementById('spoiler{{ $fi[0]->id }}') .style.display=''; document.getElementById('a{{ $fi[0]->id }}').innerHTML ='...Ver menos';}else{document.getElementById('spoiler{{ $fi[0]->id }}') .style.display='none'; document.getElementById('a{{ $fi[0]->id }}').innerHTML ='Ver más...';}">Ver más...</a><br>
                        @if(count($fi) == 1)                                
                            @php
                            $part = pathinfo($fi[0]->url);
                              if($part['extension'] == "rar" || $part['extension'] == "tar" || $part['extension'] == "tar.gz"){
                                $validate = 1;
                              }else{
                                $validate = 0;
                              }
                            @endphp <br>

                            @if($validate == 0)
                            <a class="btn btn-default btn-flat btn-sm external" data-toggle="modal" href="{{ $fi[0]->url }}" data-id="myModal{{$fi[0]->id}}" data-target="#myModal{{$fi[0]->id}}">Ver estudio</a>

                            @else
                              @if($agent->isMobile())
                                <label class="text-red" style="font-size: 11px;"> *Este archivo solo tiene opción de reenvío</label>
                              @else
                               <a class="btn btn-default btn-flat btn-sm" href="{{ $fi[0]->url }}">Descargar estudio</a>
                              @endif 

                            @endif

                            <!-- Modal for file view -->
                                      <div class="modal fade" id="myModal{{$fi[0]->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="height: 900px;">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                          <div class="modal-header">
                                           <span style="font-size: 15px;"><b> {{ $fi[0]->details }} </b></span>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                          </div>
                                            <div class="modal-body results">
                                            </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                      </div><!-- /.modal -->
                            <!-- End modal for file view -->

                           @else
                                                       <a class="btn btn-default btn-flat btn-sm" data-toggle="modal" data-id="myModal{{$fi[0]->id}}" data-target="#myModal{{$fi[0]->id}}" onclick="$('.x.active.external').click();">Ver estudio</a>
                                
                                <div class="modal fade" id="myModal{{$fi[0]->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="height: 900px;">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                          <div class="modal-header">
                                            @php
                                            $cont = count($fi);
                                            @endphp
                                           <span style="font-size: 15px;"><b>Se adjuntaron #{{ $cont }} archivos</b></span>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                          </div>
                                            <div class="modal-body">
                                                <div class="nav-tabs-custom">
                                                        <ul class="nav nav-tabs">
                                                          <li class="dropdown">
                                                            <a class="dropdown-toggle men" data-toggle="dropdown" href="#" aria-expanded="false">
                                                              <label><span class="spt">Seleccione: </span>&nbsp;<i class="fa fa-angle-down" style="font-size: 18px;"></i></label>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                          @foreach($fi as $f)    
                                                           @if($loop->iteration == 1)
                                                            <li><a href="{{ $f->url }}" data-toggle="tab" data-target="#t{{ $f->id}}" class="x active external" onclick="$('.dropdown-toggle.men span.spt').text($(this).text());">{{ $f->details}}</a></li>
                                                           @else
                                                            <li><a href="{{ $f->url }}" data-toggle="tab" data-target="#t{{ $f->id}}" class="external"  onclick="$('.dropdown-toggle.men span.spt').text($(this).text());">{{ $f->details}}</a></li>
                                                           @endif
                                                          
                                                          @endforeach
                                                            </ul>
                                                          </li>
                                                        </ul>
                                                        <div class="tab-content">
                                                         @foreach($fi as $f)    
                                                         @if($loop->iteration == 1)
                                                          <div class="tab-pane active" id="t{{ $f->id}}">
                                                         @else
                                                          <div class="tab-pane" id="t{{ $f->id}}">   
                                                         @endif   
                                                                       <div class="modal-body dos iframe-container results">
                                                                       </div>
                                                          </div>
                                                          @endforeach
                                                        </div>
                                                        <!-- /.tab-content -->
                                                      </div>

                                            </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                      </div><!-- /.modal -->

                  
                           @endif
                          </div>
                        </div>
                      </li>

                      @endforeach

            <!-- end li to imbox-->
           @foreach($test_result->sortBy('created_at') as $test)
            <li>
              <i class="fa fa-file bg-aqua"></i>

              <div class="timeline-item">
                        <span class="time">
                           <div class="btn-group"> 
                              <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><div class="btn-block"><i class="text-muted fa fa-ellipsis-v" style="font-weight: 800 !important"></i></div></a>
                              <ul class="dropdown-menu dropdown-menu-right" role="menu" style="float: left !important;">
                                <li><a onclick="send('{{ $test->id }}');" href="javascript:void(0)">Reenviar a correo personal</a></li>
                              </ul>
                            </div>
                        </span>
                <h3 class="timeline-header cut"><a href="javascript:void(0)">{{ $test->name }}</a></h3>

                <div class="timeline-body">
                  Fecha. {{ $test->date_email }}<br>
                  Prescribe. {{ $test->doc}}.<br>
                  Receta. {{ $test->folio}}.<br>
                  Detalles:<br>
                  {{ $test->details }}<br>

                  <a class="btn btn-default btn-flat btn-sm external" data-id="myModal{{$test->id}}"  data-toggle="modal" href="{{ $test->url }}" data-target="#myModal{{$test->id}}">Ver estudio</a>
                  <a class="btn btn-secondary btn-sm btn-flat modal-chat" data-toggle="modal" data-target="#chat-form-modal">Comentarios</a>
                  <div class="modal-chat fade2 modal" id="chat-form-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                         <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                             <h4 class="modal-title"> <i class="fa fa-comments"></i> Ventana de Conversación</h4>
                             </div>
                          <div class="modal-body">
                                <input type="hidden" class="middr" value="{{ $test->doctor }}">
                                <input type="hidden" class="midfield" value="{{ $test->id }}">
                                <input type="hidden" class="mname" value="{{ $test->name }}">
                                <input type="hidden" class="mtable" value="diagnostic_test_result">
                             @include('conversations.conversationform')
                         </div>
                          </div>  
                       </div>
                    </div>    

                            <div class="modal fade" id="myModal{{$test->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                 <span style="font-size: 15px;"><b> {{ $test->name }} </b></span>
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                  <div class="modal-body iframe-container results">
                                  </div>
                                  </div><!-- /.modal-content -->
                              </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                                                    <!-- /.modal -->

                </div>
              </div>
            </li>
            @endforeach
             <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
         </ul>  
          </div>
        </div>
      </div>  
      @endif
         <br>
          <div class="box-header direct-chat header2" id="header2">
                <h3 class="box-title">
                          Historia clínica<a href="{{ url('clinicHistory/edit/0')}}" class="btn"><i class="fa fa-pencil text-muted"></i></a>  
                 </h3>
                <button type="button" class="btn pull-right" title="" data-widget="chat-pane-toggle">
                 <span class="fa fa-filter text-muted"></span></button>
              <div class="direct-chat-contacts plus">
                       <div class="btn-group pull-right">
                            <button id="familiares" type="button" class="btn bg-blue btn-flat" title="Antecedentes Familiares"><i class="fa fa-users"></i></button>   
                            <button id="morbidos" type="button"  class="btn bg-gray btn-flat" title="Antecedentes Mórbidos"><i class="fa fa-stethoscope"></i></button>
                            <button id="alergias" type="button" class="btn bg-black btn-flat" title="Alergias"> <i class="fa fa-medkit"></i></button> 
                            <button id="habitos" type="button" class="btn bg-green btn-flat" title="Hábitos"><i class="fa fa-coffee"></i></button>
                            <button id="all" type="button" class="btn btn-default btn-flat" title="Ver todo"><b>Ver Todo</b></button>   
                      </div>
              </div>
     

           </div><br/>
              <div class="box-body content">
                <div class="row">
                  <div class="col-md-12">
           <ul class="timeline">   
            @php
            $t1 = 0; 
            $t2 = 0; 
            $t3 = 0;
            $t4 = 0;
            $t5 = 0;                         
            @endphp
      @foreach($clinic_history->sortBy('type') as $clinic)

            <!-- timeline time label -->
            @if($clinic->type == 'Antecedentes Familiares')
             @php $t1++; @endphp
             @if($t1 == 1)
            <li class="time-label familiares">
                  <span class="bg-blue">
                   {{ $clinic->type }} 
                  </span>
            </li>
            @endif
            <!-- /.timeline-label -->
            <!-- timeline item -->

            <li class="familiares">
              <i class="fa fa-users bg-blue"></i>

              <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::parse($clinic->updated_at)->diffForHumans() }}</span>

                <h3 class="timeline-header"><a data-toggle="tooltip" title="{{ $clinic->text_help}}" href="javascript:void(0)">{{ $clinic->question }}</a></h3>
                <div class="timeline-body">
                   @php $a = json_decode($clinic->answer); @endphp
                  @foreach($a as $answer)
                      <div class="callout callout-success" style="color: #000 !important;">
                        <h5>{{ $answer }}</h5>
                      </div>
                  @endforeach
                 <a href="edit/{{ $clinic->question_id}}" class="down btn"><i class="fa fa-pencil text-muted"></i></a>
                </div>
              </div>
            </li>
            @endif
             @if($clinic->type == 'Antecedentes Morbidos')
             @php $t2++; @endphp
             @if($t2 == 1)
            <li class="time-label morbidos">
                  <span class="bg-gray">
                   Antecedentes Mórbidos
                  </span>
            </li>
            @endif
            <!-- /.timeline-label -->
            <!-- timeline item -->

            <li class="morbidos">
              <i class="fa fa-stethoscope bg-gray"></i>

              <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::parse($clinic->updated_at)->diffForHumans() }}</span>

                <h3 class="timeline-header"><a data-toggle="tooltip" title="{{ $clinic->text_help}}" href="javascript:void(0)">{{ $clinic->question }}</a></h3>
                <div class="timeline-body">
                   @php $a = json_decode($clinic->answer); @endphp
                  @foreach($a as $answer)
                      <div class="callout callout-success" style="color: #000 !important;">
                        <h5>{{ $answer }}</h5>
                      </div>
                  @endforeach
                  <a href="edit/{{ $clinic->question_id}}" class="down btn"><i class="fa fa-pencil text-muted"></i></a>
                </div>
              </div>
            </li>
            @endif
           @if($clinic->type == 'Alergias')
           @php $t3++; @endphp
             @if($t3 == 1)
            <li class="time-label alergias">
                  <span class="bg-black">
                   Alergias
                  </span>
            </li>
            @endif
            <!-- /.timeline-label -->
            <!-- timeline item -->

            <li class="alergias">
              <i class="fa fa-medkit bg-black"></i>

              <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::parse($clinic->updated_at)->diffForHumans() }}</span>

                <h3 class="timeline-header"><a data-toggle="tooltip" title="{{ $clinic->text_help}}" href="javascript:void(0)">{{ $clinic->question }}</a></h3>
                <div class="timeline-body">
                   @php $a = json_decode($clinic->answer); @endphp
                  @foreach($a as $answer)
                      <div class="callout callout-success" style="color: #000 !important;">
                        <h5>{{ $answer }}</h5>
                      </div>
                  @endforeach
                </div>
                <a href="edit/{{ $clinic->question_id}}" class="down btn"><i class="fa fa-pencil text-muted"></i></a>
              </div>
            </li>
            @endif
           @if($clinic->type == 'Habitos')
            @php $t4++; @endphp
             @if($t4 == 1)
            <li class="time-label habitos">
                  <span class="bg-green">
                   Hábitos
                  </span>
            </li>
            @endif
            <!-- /.timeline-label -->
            <!-- timeline item -->

            <li class="habitos">
              <i class="fa fa-coffee bg-green"></i>

              <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::parse($clinic->updated_at)->diffForHumans() }}</span>

                <h3 class="timeline-header"><a data-toggle="tooltip" title="{{ $clinic->text_help}}" href="javascript:void(0)">{{ $clinic->question }}</a></h3>
                <div class="timeline-body">
                   @php $a = json_decode($clinic->answer); @endphp
                  @foreach($a as $answer)
                      <div class="callout callout-success" style="color: #000 !important;">
                        <h5>{{ $answer }}</h5>
                      </div>
                  @endforeach
                 <a href="edit/{{ $clinic->question_id}}" class="down btn"><i class="fa fa-pencil text-muted"></i></a> 
                </div>
              </div>
            </li>
            @endif
            <!-- END timeline item -->
            @endforeach

              <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
        </ul>     
      </div>
     </div>   
    </div> 
    <script type="text/javascript">
            function visib(){
              if($('#eye').hasClass('fa-eye-slash') == true){
                        $('#eye').removeClass('fa-eye-slash');
                        $('#eye').addClass('fa-eye');
                        $('.expbody').css("display","");

                  }else{
                      $('#eye').removeClass('fa-eye');
                      $('#eye').addClass('fa-eye-slash');
                      $('.expbody').css("display","none");

                  }
            }
            function send(id){
                            $.ajax(
                                    {
                                      type: "GET",    
                                      url: "{{ url('clinicHistory/reSender') }}/" + id, 
                                      success: function(result){
                                        $('#headeralert').html('<div class="alert alert-success alert-dismissible" id="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color:white !important;">×</button><h5><i class="icon fa fa-info"></i>Mensaje enviado a:</h5>{{ $email }}</div>');
                                            $('#alert').fadeTo(5000, 500).fadeOut(500, function(){
                                              $('#alert').fadeOut(500);
                                            });   
                                      }
                                    })             
                                }   

    </script>
@endif


				<script>

        function hide(){
              $('.alert').fadeOut(500);
            };
        

           if(window.location.href == "{{ url('clinicHistory/index') }}"){      
                window.onscroll = function() {myFunction()};
                var header = document.getElementById("header2");
                var sticky = header.offsetTop;
            if($('.box-header').hasClass('header1')){      
                var header1 = document.getElementById("header1");
                var sticky1 = header1.offsetTop;
             }   
        function myFunction() {
            
            if (window.pageYOffset >= sticky) {
                  if($('.box-header').hasClass('header1')){  
                    header1.classList.remove("sticky");
                     $('#header1').css('width','');
                   }
                    header.classList.add("sticky");
                  
            if("@php echo $agent->isMobile(); @endphp"){
                      $('.sticky').css('width','96%');
               }else{ 
                  if ($('body').hasClass('sidebar-collapse')){
                        $('.sticky').css('width','96%');
                      }else{
                         $('.sticky').css('width','82%');
                      }
                    }
                  } else {
                     header.classList.remove("sticky");
                     $('#header2').css('width','');
                  }
          if($('.box-header').hasClass('header1')){        
             if($('#eye').hasClass('fa-eye-slash') == true){
                header1.classList.remove("sticky");
                     $('#header1').css('width','');
                        header.classList.add("sticky");
             }else{
            if (window.pageYOffset >= sticky1) {
                    header1.classList.add("sticky");
              if("@php echo $agent->isMobile(); @endphp"){
                          $('.sticky').css('width','96%');
                 }else{ 
                  if ($('body').hasClass('sidebar-collapse')){
                        $('.sticky').css('width','96%');
                      }else{
                         $('.sticky').css('width','82%');
                      }
                    }
                  } else {
                    header1.classList.remove("sticky");
                     $('#header1').css('width','');
                  }
                 }
                } 
              }
            }

         window.onload = function(){
          var clinic_history = @php echo $clinic_history; @endphp;

              for(var k = 0; k < clinic_history.length; k++){
              var t = "step" + (k + 1);
                if(clinic_history[k]['question_id'] == $('#'+t+ ' .quesId').val()){
                var answer = JSON.parse(clinic_history[k]['answer']);
                  for(var i = 0; i < answer.length; i++){
                  

                  var ids = $('#'+t+' input').map(function() {
                   var tro =  answer[i].split(" ");
                   var minus = answer[i].indexOf("(");
                    if(tro.length == 3 && minus != -1){
                        var result = tro[0] + '_' + tro[1];
                        var result2 = tro[2].replace("(", "").replace(")", "");
                         if($(this).val() == result){
                                  $(this).click();
                                   return result2;
                                  }
    
                                 } 
                    if(tro.length == 2 && minus != -1){
                        var result = tro[0];
                        var result2 = tro[1].replace("(", "").replace(")", "");
                         if($(this).val() == result){
                                  $(this).click();
                                   return result2;
                                  }
    
                                 } 
                       else{
                             if($(this).val() == "Si" && answer[i] != "No"){
                                   $(this).prop('checked', true);
                                    $(this).siblings('div').css("display", "block");
                                    $(this).siblings('div').html('<textarea class="form-control" rows="2" placeholder="Especifique" id="text'+ answer[i]+'">'+ answer[i] +'</textarea>');
                                   return answer[i];
                                  }
                                  if($(this).val() == answer[i].replace(/ /gi,"_")){
                                    $(this).prop('checked', true);
                                   return $(this).val();
                                 } 
                               }  
                                }).get();
                  $('#'+t+' input:radio').map(function() {
                          if( $(this).val() == ids){
                          $(this).click();
                                  }  
                     }).get();             
                  }
                }
              }
            }


				$(document).ready(function(){

            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#exp li").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
              });
                      $("#familiares").click(function () {

                            var x = document.getElementsByClassName("habitos");
                            var i;
                            for (i = 0; i < x.length; i++) {
                                x[i].style.display = 'none';
                            }
                            var y = document.getElementsByClassName("alergias");
                            var i;
                            for (i = 0; i < y.length; i++) {
                                y[i].style.display = 'none';
                            }

                            var z = document.getElementsByClassName("morbidos");
                            var i;
                            for (i = 0; i < z.length; i++) {
                                z[i].style.display = 'none';
                            }

                            var u = document.getElementsByClassName("familiares");
                            var i;
                            for (i = 0; i < u.length; i++) {
                                u[i].style.display = 'block';
                            }
                          });      

                          $("#morbidos").click(function () {
                        

                            var x = document.getElementsByClassName("habitos");
                            var i;
                            for (i = 0; i < x.length; i++) {
                                x[i].style.display = 'none';
                            }
                            var y = document.getElementsByClassName("alergias");
                            var i;
                            for (i = 0; i < y.length; i++) {
                                y[i].style.display = 'none';
                            }

                            var z = document.getElementsByClassName("familiares");
                            var i;
                            for (i = 0; i < z.length; i++) {
                                z[i].style.display = 'none';
                            }

                            var u = document.getElementsByClassName("morbidos");
                            var i;
                            for (i = 0; i < u.length; i++) {
                                u[i].style.display = 'block';
                            }
                            });  

                          $("#alergias").click(function () {
                        
                            var x = document.getElementsByClassName("habitos");
                            var i;
                            for (i = 0; i < x.length; i++) {
                                x[i].style.display = 'none';
                            }
                            var y = document.getElementsByClassName("familiares");
                            var i;
                            for (i = 0; i < y.length; i++) {
                                y[i].style.display = 'none';
                            }

                            var z = document.getElementsByClassName("morbidos");
                            var i;
                            for (i = 0; i < z.length; i++) {
                                z[i].style.display = 'none';
                            }
                            var u = document.getElementsByClassName("alergias");
                            var i;
                            for (i = 0; i < u.length; i++) {
                                u[i].style.display = 'block';
                            }

                            });  

                          $("#habitos").click(function () {
                        
                            var x = document.getElementsByClassName("alergias");
                            var i;
                            for (i = 0; i < x.length; i++) {
                                x[i].style.display = 'none';
                            }
                            var y = document.getElementsByClassName("familiares");
                            var i;
                            for (i = 0; i < y.length; i++) {
                                y[i].style.display = 'none';
                            }

                            var z = document.getElementsByClassName("morbidos");
                            var i;
                            for (i = 0; i < z.length; i++) {
                                z[i].style.display = 'none';
                            }
                            var u = document.getElementsByClassName("habitos");
                            var i;

                            for (i = 0; i < u.length; i++) {
                                u[i].style.display = 'block';

                            }
                            });  

                            $("#all").click(function () {
                        
                            var x = document.getElementsByClassName("alergias");
                            var i;
                            for (i = 0; i < x.length; i++) {
                                x[i].style.display = 'block';
                            }
                            var y = document.getElementsByClassName("familiares");
                            var i;
                            for (i = 0; i < y.length; i++) {
                                y[i].style.display = 'block';
                            }

                            var z = document.getElementsByClassName("morbidos");
                            var i;
                            for (i = 0; i < z.length; i++) {
                                z[i].style.display = 'block';
                            }
                            var u = document.getElementsByClassName("habitos");
                            var i;
                            for (i = 0; i < u.length; i++) {
                                u[i].style.display = 'block';
                            }
                                

                            });              


                    $('input[type=checkbox]').change(function() {
                               if(this.checked) {

                                              var value2 = $(this).val();
                                              var parent = $('#p'+value2).val();
                                              var thi = $(this);
                                              var n = $(this).parents('.tab-pane').attr("id");
                                              if(parent > 0){
                                              var parent_answer = JSON.parse($('#'+value2).val());

                                              for(var i=0; i < parent_answer.length; i++){

                                                if(parent_answer[i].replace(" ","_")  == value2){
                                                  var ques = @php echo $questions_parent; @endphp;
                                                 for(var z=0; z < ques.length; z++){
                                                  if(ques[z]['id'] == parent){
                                                    var xanswer = JSON.parse(ques[z]['answer']);
                                                     for(var x=0; x < xanswer.length; x++){

                                                     if(xanswer[x] == "texto"){
                                                        thi.siblings('div').css("display", "block");
                                                        thi.siblings('div').html('<textarea class="form-control" rows="2" placeholder="Especifique" id="'+ n + value2 + xanswer[x]+'"></textarea>');
                         
                                                      } else{
                                                        thi.siblings('div').css("display", "block");
                                                        thi.siblings('div').append('<div class="checkbox checkbox-primary"><input id="'+ n + value2 + xanswer[x]+ '" name="'+ n + value2 + '" type="radio" value="'+xanswer[x]+'"><label for="'+ n + value2 + xanswer[x]+ '">'+xanswer[x]+'</label></div>');
                                                      }
                                                          }
                                                      }
                                                  }
                                                }
                                              }
                                            }
                                         }
                                         else{
                                          $(this).prop("checked", false);
                                          $(this).siblings('div').html('');
                                          $(this).siblings('div').css("display", "none");
                                         }

                      });

                    $('input[type=radio]').change(function() {


                                              var value2 = $(this).val();
                                              var parent = $('#p'+value2).val();
                                              var thi = $(this);
                                              var n = $(this).parents('.tab-pane').attr("id");
                                              
                                              if(parent > 0){
                                              var parent_answer = JSON.parse($('#'+value2).val());

                                              for(var i=0; i < parent_answer.length; i++){

                                                if(parent_answer[i].replace(" ","_")  == value2){
                                                  var ques = @php echo $questions_parent; @endphp;
                                                 for(var z=0; z < ques.length; z++){
                                                  if(ques[z]['id'] == parent){
                                                    var xanswer = JSON.parse(ques[z]['answer']);
                                                     for(var x=0; x < xanswer.length; x++){

                                                     if(xanswer[x] == "texto"){
                                                        thi.siblings('div').css("display", "block");
                                                        thi.siblings('div').html('<textarea class="form-control" rows="2" placeholder="Especifique" id="'+ n + value2 + xanswer[x]+'"></textarea>');
                         
                                                      } 
                                                          }
                                                      }
                                                  }
                                                } else{
                                                           $('input[type=radio]').siblings('div').html('');
                                                           $('input[type=radio]').siblings('div').css("display", "none");
                                                      }
                                              }
                                            } 


                      });

  $('.external').on('click', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var modalid = $(this).attr('data-id');
        var ext = url.split('.').pop();
        $(".modal-body.results").html("");
        $(".modal-body.dos.results").html("");
        //If is image view
        var h = window.screen.availHeight - 150;
        var h2 = window.screen.availHeight - 250;
        $('.modal-body').height("");
        if(ext == 'png' || ext == 'jpg' || ext == 'svg' || ext == 'gif' || ext == 'JPEG'){
        $(".modal-body.results").append('<div align="center"><img src="'+url+'" class="img-responsive"></img></div>');

        }
        //If is video format
        else if(ext == 'mp4' || ext == 'mov' || ext == 'flv' || ext == 'avi' || ext == '3gp'){
          //Flv especific
           /* if(ext == 'flv'){
                  $(".modal-body.results").append('<iframe width="100%" height="100%" frameborder="0" scrolling="yes" allowtransparency="true"><video width="540" height="340" controls autoplay><source src="'+ url +'" type="video/x-flv; codecs="'"On2 VP6, Sorenson Spark, Screen video, Screen video 2, H.264"'"></video></iframe>');
            }*/
            if(ext == 'mp4' || ext == 'mov'){
                    $(".modal-body.results").append('<iframe align="middle" width="100%" height="100%" frameborder="0" scrolling="yes" allowtransparency="true" class="iframe"><video width="540" height="340" controls autoplay><source src="'+ url +'" type="video/'+ ext +'"></video></iframe>');
                        }  

                        var $video  = $('video'),
                            $window = $(window); 

                        $(window).resize(function(){
                            var height = $window.height();
                            $video.css('height', height);

                            var videoWidth = $video.width(),
                                windowWidth = $window.width(),
                            marginLeftAdjust =   (windowWidth - videoWidth) / 2;

                            $video.css({
                                'height': height, 
                                'marginLeft' : marginLeftAdjust
                            });
                        }).resize();       
            if(ext == 'avi' || ext == '3gp'){
                                $(".modal-body.results").append('<iframe align="middle" width="100%" height="100%" frameborder="0" scrolling="yes" allowtransparency="true"><embed src="'+ url +'" type="video/x-msvideo" class="video"></embed></iframe>');

                       var $video  = $('.video'),
                            $window = $(window); 

                        $(window).resize(function(){
                            var height = $window.height();
                            $video.css('height', height);

                            var videoWidth = $video.width(),
                                windowWidth = $window.width(),
                            marginLeftAdjust =   (windowWidth - videoWidth) / 2;

                            $video.css({
                                'height': height, 
                                'marginLeft' : marginLeftAdjust
                            });
                        }).resize();            

                    } 
              }
                //Solo si es PDF
        //$(".modal-body.results").append('<object data="'+url+'" type="application/pdf" width="100%" height="100%"><embed src="'+url+'" type="application/pdf" /></object>');
        else{
         // var onload = '$(this).style.display = "inline-block";document.getElementById("loa").style.display = "none";';
        $('.modal-body').height(h + "px");
        $('.modal-body.dos').height(h2 + "px");
        /*$(".modal-body.results").append('<span id="loa">cargando...</span><iframe align="middle" width="100%" height="100%" frameborder="0" scrolling="yes" allowtransparency="true" src="https://docs.google.com/gview?url='+url+'&embedded=true"" onload="'+ onload +'" style="display:none;"></iframe>');*/
       $(".modal-body.results").append('<iframe align="middle" width="100%" height="100%" frameborder="0" scrolling="yes" allowtransparency="true" src="https://docs.google.com/gview?url='+url+'&embedded=true""></iframe>');
       }
    });
 
    $('#myModal').on('show.bs.modal', function () {
    
        $(this).find('.modal-dialog').css({
                  width:'40%x', //choose your width
                  height:'100%', 
                  'padding':'0'
           });
         $(this).find('.modal-content').css({
                  height:'100%', 
                  'border-radius':'0',
                  'padding':'0'
           });
         $(this).find('.modal-body').css({
                  width:'auto',
                  height:'100%', 
                  'padding':'0'
           });
    })


					$('.next').click(function(){

					  var nextId = $(this).parents('.tab-pane').next().attr("id");
					  $('[href=#'+nextId+']').tab('show');
            var tab = $(this).parents('.tab-pane').attr("id");
                         var values = $('#'+tab+' input').map(function() {
                          if($(this).is(':checkbox') && this.checked){

                                  var check2 = this.value.replace(/_/gi, " ");
                                if($('#'+tab+' input:radio').is(':checked')){
                                    check2 =  this.value.replace(/_/gi, " ") + ' (' + $('#'+tab+' input:radio:checked').val() + ')';
                                } 
                                    
                                  }
                          if($(this).is(':radio')){
                                if($(this).is(':checked') && $('#'+tab+' input:radio:checked').val() == "Si"){
                                   var check2 =  $('#'+tab+' textarea').val();
                                } 
                                if($(this).is(':checked') && $('#'+tab+' input:radio:checked').val() == "No"){
                                   var check2 =    $('#'+tab+' input:radio:checked').val();
                                } }
                                return check2; // obtienes el valor de todos los checkboxes
                                  
                          }).get();


            var ques = $('#'+tab+ ' .quesId').val();
            var ansId = $('#'+tab+ ' .ansId').val();

                      $.ajaxSetup({
                                  headers: {
                                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                  }
                              });

                                     $.ajax({     
                                       type: "POST",                 
                                        url: '{{ url("clinicHistory/save") }}',  
                                        data: { "answers" : JSON.stringify(values), 
                                                "question" : ques,
                                                "ansId"    : ansId
                                      }, 
                                        dataType: 'json',                
                                       success: function(data)             
                                       {
                                        console.log(data);
                                       }
                                   });
					  return false;
					  
					});
					$('.prev').click(function(){

					  var prevId = $(this).parents('.tab-pane').prev().attr("id");
					  $('[href=#'+prevId+']').tab('show');
					  return false;
					  
					});

					$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
					  
					  //update progress
					  var step = $(e.target).data('step');
					  var percent = (parseInt(step) / @php echo count($questions); @endphp) * 100;
					  console.log(@php echo count($questions); @endphp);
					  
					  $('.progress-bar').css({width: percent + '%'});
					  $('.progress-bar').text(parseInt(percent) + "%");
					  
					  //e.relatedTarget // previous tab
					  
					});

					$('.first').click(function(){

					  $('#wiz a:first').tab('show')

					});
          $('.finish').click(function(){

                        var tab = $(this).parents('.tab-pane').attr("id");

                         var values = $('#'+tab+' input').map(function() {
                          if($(this).is(':checkbox') && this.checked){

                                  var check2 = this.value.replace(/_/gi, " ");
                                if($('#'+tab+' input:radio').is(':checked')){
                                    check2 =  this.value.replace(/_/gi, " ") + ' (' + $('#'+tab+' input:radio:checked').val() + ')';
                                } 
                                    
                                  }
                          if($(this).is(':radio')){
                                if($(this).is(':checked') && $('#'+tab+' input:radio:checked').val() == "Si"){
                                   var check2 =  $('#'+tab+' textarea').val();
                                } 
                                if($(this).is(':checked') && $('#'+tab+' input:radio:checked').val() == "No"){
                                   var check2 =    $('#'+tab+' input:radio:checked').val();
                                } }
                                return check2; // obtienes el valor de todos los checkboxes
                                  
                          }).get();


                        var ques = $('#'+tab+ ' .quesId').val();
                        var ansId = $('#'+tab+ ' .ansId').val();
                                  $.ajaxSetup({
                                  headers: {
                                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                  }
                              });

                                     $.ajax({     
                                       type: "POST",                 
                                        url: '{{ url("clinicHistory/save") }}',  
                                        data: { "answers" : JSON.stringify(values), 
                                                "question" : ques,
                                                "ansId"    : ansId
                                      }, 
                                        dataType: 'json',                
                                       success: function(data)             
                                       {
                                          
                                        console.log(data);
                                       }
                                   });
                         window.open('{{ url("clinicHistory/cHistory") }}', '_self');

          });

				})
				</script>

@stop
