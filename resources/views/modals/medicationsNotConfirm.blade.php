                                       <div class="modal fade" role="dialog" id="medications">
                                            <div class="modal-dialog modal-sm">

                                              <div class="modal-content">

                                                <div class="modal-header" >
                                                  <!-- Tachecito para cerrar -->

                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                   <div align="left"><label>Tienes un tratamiento que debes iniciar</label></div>
                                                </div>
                                                    <div class="modal-body" style="padding-top: 0 !important">
                                                       <div class="wizard">
                                                                <div class="wizard-inner">
                                                                   
                                                                    <ul class="nav nav-tabs" role="tablist">

                                                                        <li role="presentation" class="active">
                                                                            <a href="#step_1" data-toggle="tab" aria-controls="step1" role="tab" title="Tratamientos" id="tab2">
                                                                                <span class="round-tab">
                                                                                    <i class="fa fa-list-alt"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li role="presentation" class="disabled" id="conf" onclick="actionNext();" >
                                                                            <a href="#complete2" data-toggle="tab" aria-controls="complete2" role="tab" title="Resumen" >
                                                                                <span class="round-tab">
                                                                                    <i class="glyphicon glyphicon-ok"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>

                                                                    <div class="tab-content">
                                                                      
                                                                        <div class="tab-pane active" role="tabpanel" id="step_1">
                                                                        
                                                                             <ul class="nav nav-pills nav-stacked">
                                                                                        @php
                                                                                             $color = 0;
                                                                                        @endphp
                                                                                        
                                                                              @foreach($medication as $date => $medications)
                                                                                    @foreach($medications as $med)
                                                                                     @if($loop->first)
                                                                                       <br/><span style="font-size: 15px;">Cita: {{ $med->ndoctor }} - {{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}
                                                                                              </span><br/>
                                                                                     @endif

                                                                                     @php
                                                                                       if($color != 999){
                                                                                           if(count($medication) < 4)
                                                                                              $color = $color + 333;
                                                                                           else
                                                                                              $color = $color + 111;   
                                                                                        }  
                                                                                     @endphp

                                                                                        <li class="active"><a href="javascript:void(0)" style="border-left-color: #{!! $color !!} !important;"><span style="font-size: 12px;">{{ $med->name_medicine }}
                                                                                              <input type="hidden" name="rec[]" class="formrecipe" value="{{ $med->id }}">

                                                                                                       <div class="pull-right"> <label class="switch" style="margin-right: 0;">
                                                                                                          <input id="check{{ $med->id }}" class="switchtrue" type="checkbox" onclick="switchOn('{{ $med->id }}');"/>
                                                                                                            <span class="slider round"></span>
                                                                                                        </label></div>
                                                                                              <ul>
                                                                                                  <li>{{ $med->frequency_days }} día(s), {{ $med->posology }}</li>
                                                                                              </ul>
                                                                                               <div id="{{ $med->id }}" style="display: none;">
                                                                                                  <input type="datetime-local" class="form-control formrecipe" data-name="{{ $med->name_medicine }}" data-id="{{ $med->id }}" name="date[]" value="{{ \Carbon\Carbon::now()->timezone('America/Mexico_City')->format('Y-m-d\TH:i:s') }}">
                                                                                               </div>
                                                                                              </span></a>
                                                                                        </li>
                                                                                    @endforeach
                                                                               @endforeach     
                                                                              </ul>  <br> 
                                                                          
                                                                              <div align="right"><button onclick="actionNext();" id="nextconfirm" title="Confirmar" class="btn btn-secondary btn-flat next-step" disabled="disabled">Siguiente</button></div>
                                                                                                     
                                                                         </div> 

                                                                        <div class="tab-pane" role="tabpanel" id="complete2">
                                                                              <span style="font-size: 16px;">Resumen del tratamiento que inicias</span><br/><br/>
                                                                               <div id="resumen_check">
                                                                                <script type="text/javascript">
                                                                                  function actionNext(){
                                                                                    $('#resumen_check').html('');
                                                                                       $('.formrecipe').each(function() {
                                                                                          if($('#check' + $(this).attr('data-id')).is(':checked')){ 
                                                                                            $('#resumen_check').append('<label>'+ $(this).attr('data-name') +': </label><br>' + $(this).val()+ '<br>');
                                                                                              }

                                                                                       });
                                                                                     }
                                                                                </script>
                                                                               </div>   
                                                                              <br>
                                                                              <div align="right"><a onclick="confirmRecipe();"class="btn btn-secondary btn-flat">Registrar Inicio</a></div>
                                                                        </div>
                                                                  </div>  
                                                     </div> 

                                                </div>
                                              </div> 
                                            </div>
                                        </div>  

   <script type="text/javascript">
                function confirmRecipe(){
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    var recipeId = [];
                    var count = 0;
                     $('.formrecipe').each(function() {
                      if($('#check' + $(this).attr('data-id')).is(':checked')){ 
                            recipeId.push({"id": $(this).attr('data-id'), "date": $(this).val()});
                            count++;
                          }

                        });

                     console.log(recipeId);

                           $.ajax({     
                             type: "POST",                 
                             url: "{{ url('clinicHistory/confirmMedication') }}",  
                              data: { 'dat' : JSON.stringify(recipeId) }, 
                              dataType: 'json',                
                             success: function(data)             
                             {
                                 location.reload(true);
                                 console.log(data);       
                             }
                         });
                    }
          function switchOn(id){

             if($('.switchtrue:checked').length > 0){
                $('#conf').removeClass('disabled');
                $('#nextconfirm').removeAttr('disabled');
              }else{
                $('#conf').addClass('disabled');
                $('#nextconfirm').attr('disabled', 'disabled');
              }

           if($('#check' + id).is(':checked')){ 
              $('#' + id).show();
             }else{ 
                $('#' + id).hide();
              }
          }          
   </script>                                     