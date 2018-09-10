 @if(session()->get('utype') == "doctor")
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
                          <aside class="control-sidebar control-sidebar-dark" style="overflow: hidden;">
                              <!-- Create the tabs -->
                              <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                                <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-clock-o"></i></a></li><li><a href="#control-sidebar-theme-demo-options-tab" data-toggle="tab"><i class="fa fa-calendar"></i></a></li>

                                <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
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
                                  <!-- /.control-sidebar-menu -->

                                </div><div id="control-sidebar-theme-demo-options-tab" class="tab-pane"><div>
                                  <h4 class="control-sidebar-heading">Citas Próximas</h4>
                                  <h3 class="control-sidebar-heading" id="futureCites2" style="display: none;">Sin citas futuras por ahora</h3>
                                  <ul class="control-sidebar-menu timeline" id="futureCites">
                                     
                                    </ul> 

                                </div></div>
                                <!-- /.tab-pane -->
                                <!-- Stats tab content -->
                                <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
                                <!-- /.tab-pane -->
                                <!-- Settings tab content -->
                                <div class="tab-pane" id="control-sidebar-settings-tab">
                                    <h3 class="control-sidebar-heading">Configuración de permisos</h3>
                                 <div class="box box-solid"> 
                                                <div class="box-group" id="accordion2">

                                                </div>
                                   
                                  </div>         
                                </div>
                                <!-- /.tab-pane -->
                              </div>
                            </aside>
                            <div id="tool"></div>
      <script type="text/javascript">
      $(document).ready(function(){
              $.ajax({
                 type: "GET",                 
                 url: "{{ url('doctor/settingAss') }}",  
                 success: function(result){ 
                  console.log(result);
                      if(result.length > 0){
                          $('#accordion2').html('');
                          for(var z= 0; z < result.length; z++){
                            if(z == 0){
                          $('#accordion2').append('<div class="panel box tit"><a data-toggle="collapse" data-parent="#accordion2" href="#'+ result[z]['idass'] +'" aria-expanded="true"><div class="box-header with-border"><h5 class="box-title tit">'+ result[z]['name'] +'</h5></div></a><div id="'+ result[z]['idass'] +'" class="panel-collapse collapse in" aria-expanded="true"><div class="box-body"><div class="table-responsive"><table class="table table-condensed"><thead><tr><th scope="col">Permisos</th><th scope="col">Ver</th><th scope="col">Editar</th></tr></thead><tbody><tr><td>Perfil</td><td><input type="checkbox" value="" checked></td><td><input type="checkbox" value=""></td></tr><tr><td>Agenda</td><td><input type="checkbox" value="" checked></td><td><input type="checkbox" value=""></td></tr><tr><td>Horarios</td><td><input type="checkbox" value="" checked></td><td><input type="checkbox" value=""></td></tr></tbody></table></div></div></div></div>');
                          }else{
                          $('#accordion2').append('<div class="panel box tit"><a data-toggle="collapse" data-parent="#accordion2" href="#'+ result[z]['idass'] +'"><div class="box-header with-border"><h5 class="box-title tit">'+ result[z]['name'] +'</h5></div></a><div id="'+ result[z]['idass'] +'" class="panel-collapse collapse"><div class="box-body"><div class="table-responsive"><table class="table table-condensed"><thead><tr><th scope="col">Permisos</th><th scope="col">Ver</th><th scope="col">Editar</th></tr></thead><tbody><tr><td>Perfil</td><td><input type="checkbox" value="" checked></td><td><input type="checkbox" value=""></td></tr><tr><td>Agenda</td><td><input type="checkbox" value="" checked></td><td><input type="checkbox" value=""></td></tr><tr><td>Horarios</td><td><input type="checkbox" value="" checked></td><td><input type="checkbox" value=""></td></tr></tbody></table></div></div></div></div>');
                          }
                        }
                      }else{
                        $('#accordion2').html('');
                      }
                  }
                });
       })
      </script>
 @endif
