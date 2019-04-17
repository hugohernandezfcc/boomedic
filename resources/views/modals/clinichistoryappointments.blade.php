 <style type="text/css">
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
 </style>    

          <div class="modal-chat fade2 modal"  id="modalhistoryappointments-{{ $id }}">
                  <div class="modal-dialog modal-sm">

                    <div class="modal-content">

                      <div class="modal-header" >
                        <!-- Tachecito para cerrar -->

                       <button type="button" class="close" data-target="#{{ $id }}" data-dismiss="modal" data-toggle="modal" aria-label="Close" id="btnclosehc">
                          <span aria-hidden="true">&times;</span>
                        </button>
                         <div align="left"><label>Historia clínica previa cita</label></div>
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
                  
                    <b>{{ $questions1->question }}</b>
                    <br>
                  @php $an = json_decode($questions1->answer); @endphp
                    <input type="hidden" class="quesId" value="{{ $questions1->id }}">
                    <input type="hidden" class="ansId" value="{{ $questions1->a }}">

                    @foreach($an as $answer)
                            <div class="checkbox checkbox-primary">
                              @php  $a2 = str_replace(" ", "_", $answer); @endphp
                                <input type="hidden" id="{{ $a2 }}" value="{{ $questions1->parent_answer }}">
                                <input type="hidden" id="p{{ $a2 }}" value="{{ $questions1->parent }}">
                                <input type="hidden" id="id{{ $a2 }}" value="{{ $questions1->id }}">
                                @if($an[0] == "radio")    
                                   @if($a2 != "radio")
                                        <input id="{{ $questions1->id }}{{ $loop->iteration }}{{ $a2 }}" name="{{ $questions1->id }}" type="radio" value="{{ $a2 }}">
                                        <label for="{{ $questions1->id }}{{ $loop->iteration }}{{ $a2 }}">
                                            {{ $answer }}
                                        </label>
                                   @endif  
                                @else
                                        @if($an[0] == "texto") 
                                          <textarea id="{{ $questions1->id }}{{ $loop->iteration }}"  name="{{ $questions1->id }}"></textarea>
                                         @elseif($an[0] == "checkbox")   
                                            @if($a2 != "checkbox")
                                              <input id="{{ $questions1->id }}{{ $loop->iteration }}{{ $a2 }}" type="checkbox" value="{{ $a2 }}" name="resp[]" class="checkbox">
                                              <label for="{{ $questions1->id }}{{ $loop->iteration }}{{ $a2 }}">
                                                  {{ $answer }}
                                              </label>
                                            @endif      
                                        @endif
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
                  
                    <b>{{ $questions1->question }}</b>
                    <br>
                  @php $an = json_decode($questions1->answer); @endphp
                    <input type="hidden" class="quesId" value="{{ $questions1->id }}">
                    <input type="hidden" class="ansId" value="{{ $questions1->a }}">

                    @foreach($an as $answer)
                            <div class="checkbox checkbox-primary">
                              @php  $a2 = str_replace(" ", "_", $answer); @endphp
                                <input type="hidden" id="{{ $a2 }}" value="{{ $questions1->parent_answer }}">
                                <input type="hidden" id="p{{ $a2 }}" value="{{ $questions1->parent }}">
                                <input type="hidden" id="id{{ $a2 }}" value="{{ $questions1->id }}">
                                @if($an[0] == "radio")    
                                   @if($a2 != "radio")
                                        <input id="{{ $questions1->id }}{{ $loop->iteration }}{{ $a2 }}" name="{{ $questions1->id }}" type="radio" value="{{ $a2 }}">
                                        <label for="{{ $questions1->id }}{{ $loop->iteration }}{{ $a2 }}">
                                            {{ $answer }}
                                        </label>
                                   @endif  
                                @else
                                        @if($an[0] == "texto") 
                                          <textarea id="{{ $questions1->id }}{{ $loop->iteration }}"  name="{{ $questions1->id }}"></textarea>
                                         @elseif($an[0] == "checkbox")   
                                            @if($a2 != "checkbox")
                                              <input id="{{ $questions1->id }}{{ $loop->iteration }}{{ $a2 }}" type="checkbox" value="{{ $a2 }}" name="resp[]" class="checkbox">
                                              <label for="{{ $questions1->id }}{{ $loop->iteration }}{{ $a2 }}">
                                                  {{ $answer }}
                                              </label>
                                            @endif      
                                        @endif
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
                      <b>{{ $questions1->question }}</b>
                      <br>
                      @php $an = json_decode($questions1->answer); @endphp
                      <input type="hidden" class="quesId" value="{{ $questions1->id }}">
                      <input type="hidden" class="ansId" value="{{ $questions1->a }}">

                    @foreach($an as $answer)
                            <div class="checkbox checkbox-primary">
                              @php  $a2 = str_replace(" ", "_", $answer); @endphp
                                <input type="hidden" id="{{ $a2 }}" value="{{ $questions1->parent_answer }}">
                                <input type="hidden" id="p{{ $a2 }}" value="{{ $questions1->parent }}">
                                <input type="hidden" id="id{{ $a2 }}" value="{{ $questions1->id }}">
                                @if($an[0] == "radio")    
                                   @if($a2 != "radio")
                                        <input id="{{ $questions1->id }}{{ $loop->iteration }}{{ $a2 }}" name="{{ $questions1->id }}" type="radio" value="{{ $a2 }}">
                                        <label for="{{ $questions1->id }}{{ $loop->iteration }}{{ $a2 }}">
                                            {{ $answer }}
                                        </label>
                                   @endif  
                                @else
                                        @if($an[0] == "texto") 
                                          <textarea id="{{ $questions1->id }}{{ $loop->iteration }}"  name="{{ $questions1->id }}"></textarea>
                                         @elseif($an[0] == "checkbox")   
                                            @if($a2 != "checkbox")
                                              <input id="{{ $questions1->id }}{{ $loop->iteration }}{{ $a2 }}" type="checkbox" value="{{ $a2 }}" name="resp[]" class="checkbox">
                                              <label for="{{ $questions1->id }}{{ $loop->iteration }}{{ $a2 }}">
                                                  {{ $answer }}
                                              </label>
                                            @endif      
                                        @endif
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
                    <b>{{ $questions1->question }}</b>
                    <br>
                        @php $an = json_decode($questions1->answer); @endphp
                      <input type="hidden" class="quesId" value="{{ $questions1->id }}">
                      <input type="hidden" class="ansId" value="{{ $questions1->a }}">

                    @foreach($an as $answer)
                            <div class="checkbox checkbox-primary">
                              @php  $a2 = str_replace(" ", "_", $answer); @endphp
                                <input type="hidden" id="{{ $a2 }}" value="{{ $questions1->parent_answer }}">
                                <input type="hidden" id="p{{ $a2 }}" value="{{ $questions1->parent }}">
                                <input type="hidden" id="id{{ $a2 }}" value="{{ $questions1->id }}">
                                @if($an[0] == "radio")    
                                   @if($a2 != "radio")
                                        <input id="{{ $questions1->id }}{{ $loop->iteration }}{{ $a2 }}" name="{{ $questions1->id }}" type="radio" value="{{ $a2 }}">
                                        <label for="{{ $questions1->id }}{{ $loop->iteration }}{{ $a2 }}">
                                            {{ $answer }}
                                        </label>
                                   @endif  
                                @else
                                        @if($an[0] == "texto") 
                                          <textarea id="{{ $questions1->id }}{{ $loop->iteration }}"  name="{{ $questions1->id }}" class="form-control"></textarea>
                                         @elseif($an[0] == "checkbox")   
                                            @if($a2 != "checkbox")
                                              <input id="{{ $questions1->id }}{{ $loop->iteration }}{{ $a2 }}" type="checkbox" value="{{ $a2 }}" name="resp[]" class="checkbox">
                                              <label for="{{ $questions1->id }}{{ $loop->iteration }}{{ $a2 }}">
                                                  {{ $answer }}
                                              </label>
                                            @endif      
                                        @endif
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
                  </div>
              </div>

  <script type="text/javascript">
  $(document).ready(function(){
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
                              if($(this).val() == answer[i]){
                                    $(this).prop('checked', true);
                                   return $(this).val();
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
                    $('#'+t+' input:checkbox').map(function() {
                          if( $(this).val() == ids){
                          $(this).click();
                                  }  
                     }).get();
                     $('#'+t+' textarea').map(function() {
                          $(this).val() == answer[i];
                                
                     }).get();                  
                  }                  
                  }
                }
            


          $('.next').click(function(){

            var nextId = $(this).parents('.tab-pane').next().attr("id");
            $('[href=#'+nextId+']').tab('show');
            var tab = $(this).parents('.tab-pane').attr("id");
                        if(typeof $('#'+tab+' textarea').val() != "undefined")
                           var values = Array($('#'+tab+' textarea').val());
                        else{
                         var values = $('#'+tab+' input').map(function() {
                          if($(this).is(':checkbox') && this.checked){
                                  var check2 = this.value.replace(/_/gi, " ");
                                    
                                  }
                          if($(this).is(':radio') && this.checked){
                                   var check2 =    $('#'+tab+' input:radio:checked').val();
                                 }
                                return check2; // obtienes el valor de todos los checkboxes
                                  
                          }).get();
                          }

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
                        if(typeof $('#'+tab+' textarea').val() != "undefined")
                           var values = Array($('#'+tab+' textarea').val());
                        else{
                         var values = $('#'+tab+' input').map(function() {
                          if($(this).is(':checkbox') && this.checked){
                                  var check2 = this.value.replace(/_/gi, " ");
                                    
                                  }
                          if($(this).is(':radio') && this.checked){
                                   var check2 =    $('#'+tab+' input:radio:checked').val();
                                 }
                                return check2; // obtienes el valor de todos los checkboxes
                                  
                          }).get();
                          }


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
                                      $('#btnclosehc').click();
                       
          });
        })
  </script>              