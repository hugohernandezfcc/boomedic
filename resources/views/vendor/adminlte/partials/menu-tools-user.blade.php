 @if(session()->get('utype') != "doctor")
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
                            <script type="text/javascript">
                                            $.ajax(
                                                    {
                                                      type: "GET",    
                                                      url: "{{ url('clinicHistory/medicationAll') }}", 
                                                      success: function(result){
                                                        var med = result;
                                                        if(result.length == 0){
                                                          $('#activemed').html('<li style="color:white;">No hay tratamientos Activos</li>');
                                                          $('#allmed').html('<li style="color:white;">No hay tratamientos guardados</li>');
                                                        }else{
                                                          var countact = 0;
                                                          var countfin = 0;
                                                          var prescription_gray = "{{ asset('prescription_gray.png') }}";
                                                          var prescription_red = "{{ asset('prescription_red.png') }}";
                                                          var prescription_green = "{{ asset('prescription_green.png') }}";

                                                            for (var date in result){
                                                                if (result.hasOwnProperty(date)) {
                                                                $('#allmed').append('<li class="time-label"><span class="bg-gray">'+ moment(date).format("DD-MM-YYYY") +'</span></li>');
                                                                   for(var z = 0; z < result[date].length; z++){
                                                                     if(result[date][z]['active'] == 'Not Confirmed'){

                                                                      $('#allmed').append('<li><a class="pointer"><img src="'+ prescription_red +'" class="bg-gray menu-icon"><div class="menu-info"><h4 class="control-sidebar-subheading" style="font-size:12px !important;">'+ result[date][z]['name_medicine'] +'</h4><p>'+ result[date][z]['frequency_days'] +'día(s), ' + result[date][z]['posology'] +'</p></div></a></li>');
                                                                      countfin++;
                                                                     }

                                                                    if(result[date][z]['active'] == 'Finished'){
                                                                      $('#allmed').append('<li><a class="pointer"><img src="'+ prescription_gray +'" class="bg-gray menu-icon"><div class="menu-info"><h4 class="control-sidebar-subheading" style="font-size:12px !important;">'+ result[date][z]['name_medicine'] +'</h4><p>'+ result[date][z]['frequency_days'] +'día(s), ' + result[date][z]['posology'] +'</p></div></a></li>');

                                                                      
                                                                      countfin++;
                                                                     }

                                                                    if(result[date][z]['active'] == 'Confirmed'){
                                                                      $('#treatmenttool').append('<div class="modal fade" role="dialog" id="'+ result[date][z]['id'] +'"><div class="modal-dialog modal-sm"><div class="modal-content"><div class="modal-header" ><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><div align="left"><label>Tratamiento en curso</label></div></div><div class="modal-body"><div class="box box-primary"><div class="box-header with-border"><i class="fa fa-briefcase-medical"></i><b>'+ result[date][z]['name_medicine'] +'</b></div><div class="box-body">Posología: <span class="text-muted">'+ result[date][z]['frequency_days'] +'día(s), ' + result[date][z]['posology']+'</span><br/>Inicio: <span class="text-muted">'+ result[date][z]['start_date'] +'</span><br/>Próxima dosis: <span class="text-muted">'+ result[date][z]['next_time']  +'</span></div></div></div></div></div></div>');

                                                                      $('#activemed').append('<li class="time-label"><span class="bg-gray">Inicio '+ moment(result[date][z]['start_date']).format("DD-MM-YYYY") +'</span></li>');

                                                                      $('#activemed').append('<li><a class="pointer" data-target="#'+ result[date][z]['id'] +'" data-toggle="modal"><img src="'+ prescription_green +'" class="bg-gray menu-icon"><div class="menu-info"><h4 class="control-sidebar-subheading" style="font-size:12px !important;">'+ result[date][z]['name_medicine'] +'</h4><p>'+ result[date][z]['frequency_days'] +'día(s), ' + result[date][z]['posology'] +'</p></div></a></li>');
                                                                      countact++;
                                                                     }
                                                                   }
                                                                }
                                                            }
                                                            if(countact == 0){
                                                                $('.displayactive').show();
                                                            }else{
                                                                $('#activemed').append('<li><i class="fa fa-clock-o bg-gray"></i></li>');
                                                            }
                                                            if(countfin == 0){
                                                                $('.displayall').show();
                                                            }else{
                                                                 $('#allmed').append('<li><i class="fa fa-clock-o bg-gray"></i></li>');

                                                            }


                                                        }
                                                       }
                                                    });
                            </script>

                              <!-- Create the tabs -->
                              <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                                <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-check-circle"></i></a></li>
                                <li><a href="#control-sidebar-theme-demo-options-tab" data-toggle="tab"><i class="fa fa-file-text"></i></a></li>
                              </ul>
                              <!-- Tab panes -->
                              <div class="tab-content">
                                <!-- Home tab content -->
                                <div class="tab-pane active" id="control-sidebar-home-tab">
                                  <h4 class="control-sidebar-heading">Tratamiento Activo</h4>
                                  <div class="control-sidebar-heading displayactive" style="display: none; color:white;">No hay tratamientos Activos</div>
                                    <ul class="control-sidebar-menu timeline" id="activemed">

                                    </ul>         

                                </div>
                                <div id="control-sidebar-theme-demo-options-tab" class="tab-pane"><div>
                                  <h4 class="control-sidebar-heading">Todos los tratamientos</h4>
                                   <div class="control-sidebar-heading displayall" style="display: none; color:white;">No hay tratamientos anteriores o sin iniciar</div>
                                       <ul class="control-sidebar-menu timeline" id="allmed">
                                        </ul> 
                                </div></div>
                                <!-- /.tab-pane -->
                                <!-- Stats tab content -->
                              </div>

                            </aside>
                              <div id="treatmenttool"></div>
 @endif
