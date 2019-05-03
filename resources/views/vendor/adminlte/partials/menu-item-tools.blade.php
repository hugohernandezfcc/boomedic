 @if(session()->get('utype') == "doctor" || session()->get('utype') == "assistant")
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
          .control-sidebar-dark {
            color: #333;
          }
          .tit{
            border-top-color: black;
            font-size: 13px !important;
          }
      </style>
<meta name="csrf-token" content="{{ csrf_token() }}">

                    <aside class="control-sidebar control-sidebar-dark" style="overflow: hidden;">
                              <!-- Create the tabs -->
                              <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                                  <li class="active">
                                    <a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-clock-o"></i></a></li>
                                  <li>
                                    <a href="#control-sidebar-theme-demo-options-tab" data-toggle="tab"><i class="fa fa-calendar"></i></a>
                                  </li>
                                   @if(session()->get('utype') != "assistant")
                                  <li>
                                    <a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a>
                                  </li>
                                  @endif
                              </ul>

                              <!-- Tab panes -->
                              <div class="tab-content">
                                    <!-- Home tab content -->
                                    <div class="tab-pane active" id="control-sidebar-home-tab">
                                        <h3 class="control-sidebar-heading">Citas del día: #<span id="numberAppo"></span></h3>
                                        <h3 class="control-sidebar-heading" id="stateCite2" style="display: none;">Sin citas por ahora</h3>
                                          <ul class="control-sidebar-menu" id="stateCite">
                                              <!--Este ul se llena dinámicamente con java script -->
                                          </ul>
                                    </div>

                                    <div id="control-sidebar-theme-demo-options-tab" class="tab-pane">
                                      <div>
                                        <h4 class="control-sidebar-heading">Citas Próximas</h4>
                                        <h3 class="control-sidebar-heading" id="futureCites2" style="display: none;">Sin citas futuras por ahora</h3>
                                          <ul class="control-sidebar-menu timeline" id="futureCites"></ul> 
                                      </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <!-- /.tab-pane -->
                                   @if(session()->get('utype') != "assistant")
                                    <!-- Settings tab content -->
                                    <div class="tab-pane" id="control-sidebar-settings-tab">
                                        <h3 class="control-sidebar-heading">Configuración de permisos</h3>
                                        <div class="box box-solid"> 
                                             <div class="box-group" id="accordion2"></div>
                                        </div>         
                                    </div>

                                   @endif 
                                    <!-- /.tab-pane -->
                              </div>
                    </aside>
                    <div id="tool"></div>
                       <script type="text/javascript">

                                             function  check(a){
                                              
                                                  var id = a.attr('id'); 

                                                  if($(a).prop('checked'))
                                                     $('#'+id+'w').removeAttr('disabled');

                                                  else{
                                                       $('#'+id+'w').attr('disabled','disabled');
                                                       $('#'+id+'w').prop( "checked", false );
                                                  }
                                              }

                                              function attribute(id, atr){
                                                  var result;
                                                   if($('#'+id+atr).prop('checked')){
                                                        if($('#'+id+atr+'w').prop('checked'))
                                                             result = "write";
                                                        else 
                                                             result = "read";   
                                                    }
                                                    else
                                                        result = "none";

                                                        return result;
                                                }

                                              function saveSettings(id){

                                                var profile = attribute(id, "profile");
                                                var calendar = attribute(id, "calendar");
                                                var workboard = attribute(id, "workboard");
                                                var chat = attribute(id, "chat");
                                                var assistant = attribute(id, "assistant");

                                                $.ajaxSetup({
                                                            headers: {
                                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                            }
                                                        });

                                                $.ajax({     
                                                       type: "POST",                 
                                                       url: "{{ url('AssistantController/save') }}/" + id,  
                                                       data: {  "profile" : profile,
                                                                "calendar" : calendar,
                                                                "workboard" : workboard,
                                                                "chat" : chat,
                                                                "assistant" : assistant
                                                              }, 
                                                       dataType: 'json',                
                                                       success: function(data)             
                                                       {  
                                                          if(data != 'Error'){
                                                               $('.notifications').notify({
                                                                  message: { text: "Se guardaron los cambios correctamente para el asistente " + data + ". " }
                                                                }).show();
                                                             }
                                                          else {
                                                               $('.notifications').notify({
                                                                  message: { text: "Ha ocurrido un error, vuelve a intentarlo o levanta un caso si el error persiste." },
                                                                  type:'danger'
                                                                }).show();
                                                             }
                                                        }

                                                      
                                                   });
                                              }
                               window.onload = function(){
                                              $.ajax({
                                                   type: "GET",                 
                                                   url: "{{ url('doctor/settingAss') }}",  
                                                   success: function(result){ 
                                                        if(result.length > 0){
                                                            $('#accordion2').html('');
                                                            for(var z= 0; z < result.length; z++){

                                                              //Profile options                                                                
                                                              var checkRead = (result[z]["profile"] === "read" || result[z]["profile"] === "write") ? 'checked' : '';
                                                              var checkWrite = (result[z]["profile"] === "write") ? 'checked' : 'disabled="disabled"';

                                                              var profile = '<tr><td>Perfil</td><td><input type="checkbox" id="'+ result[z]["idass"] +'profile" onclick="check($(this));" '+ checkRead +'></td><td><input type="checkbox" id="'+ result[z]["idass"] +'profilew" '+ checkWrite +'></td></tr>';

                                                              //Calendar options  
                                                              checkRead = (result[z]["calendar"] === "read" || result[z]["calendar"] === "write") ? 'checked' : '';
                                                              checkWrite = (result[z]["calendar"] === "write") ? 'checked' : 'disabled="disabled"';

                                                              var calendar = '<tr><td>Agenda</td><td><input type="checkbox" onclick="check($(this));" id="'+ result[z]["idass"] +'calendar" '+ checkRead +'></td><td><input type="checkbox" id="'+ result[z]["idass"] +'calendarw" '+ checkWrite +'></td></tr>';

                                                              //Workboard options  
                                                              checkRead = (result[z]["workboard"] === "read" || result[z]["workboard"] === "write") ? 'checked' : '';
                                                              checkWrite = (result[z]["workboard"] === "write") ? 'checked' : 'disabled="disabled"';

                                                              var workboard = '<tr><td>Horarios</td><td><input type="checkbox" id="'+ result[z]["idass"] +'workboard" onclick="check($(this));" '+ checkRead +'></td><td><input type="checkbox" id="'+ result[z]["idass"] +'workboardw" '+ checkWrite +'></td></tr>';

                                                              //Chat options  
                                                              checkRead = (result[z]["chat"] === "read" || result[z]["chat"] === "write") ? 'checked' : '';
                                                              checkWrite = (result[z]["chat"] === "write") ? 'checked' : 'disabled="disabled"';

                                                              var chat = '<tr><td>Chat</td><td><input type="checkbox" id="'+ result[z]["idass"] +'chat" onclick="check($(this));" '+ checkRead +'></td><td><input type="checkbox" id="'+ result[z]["idass"] +'chatw" '+ checkWrite +'></td></tr>';

                                                              //Chat options  
                                                              checkRead = (result[z]["assistant"] === "read" || result[z]["assistant"] === "write") ? 'checked' : '';
                                                              checkWrite = (result[z]["assistant"] === "write") ? 'checked' : 'disabled="disabled"';

                                                              var assistant = '<tr><td>Asistentes</td><td><input type="checkbox" id="'+ result[z]["idass"] +'assistant" onclick="check($(this)); '+ checkRead +'"></td><td><input type="checkbox" id="'+ result[z]["idass"] +'assistantw" '+ checkWrite +'></td></tr>';                                                              

                                                            $('#accordion2').append('<div class="panel box tit"><a data-toggle="collapse" data-parent="#accordion2" href="#'+ result[z]['idass'] +'"><div class="box-header with-border"><h5 class="box-title tit">'+ result[z]['name'] +'</h5></div></a><div id="'+ result[z]['idass'] +'" class="panel-collapse collapse"><div class="box-body"><div class="table-responsive"><table class="table table-condensed"><thead><tr><th scope="col">Permisos</th><th scope="col">Ver</th><th scope="col">Editar</th></tr></thead><tbody>'+ profile + calendar + workboard + chat + assistant +'<tr><td colspan="3"><button class="btn btn-xs btn-secondary pull-right" onclick="saveSettings('+ result[z]["idass"] +');">Guardar</button></td></tr></tbody></table></div></div></div></div>');
                                                          
                                                          }
                                                        }else{
                                                          $('#accordion2').html('');
                                                        }
                                                    }
                                                });
                                                };
                                      </script>

 @endif
