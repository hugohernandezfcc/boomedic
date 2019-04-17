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

                       <button type="button" class="close" data-target="#{{ $id }}" data-dismiss="modal" data-toggle="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                         <div align="left"><label>Historia clínica previa cita</label></div>
                      </div>
                          <div class="modal-body" style="padding-top: 0 !important">
                             <ul class="nav nav-pills nav-stacked chistory">

                                   @foreach($questions as $quest)
                                      @if($quest->createdby == $dr)
                                        <li class="active"><a href="javascript:void(0)">{{ $quest->question }}
                                              <br>
                                            @php $an = json_decode($quest->answer); @endphp
                                              <label>Respuestas:</label><br>
                                              <input type="hidden" class="quesId" value="{{ $quest->id }}">

                                              @foreach($an as $answer)
                                                      <div class="checkbox checkbox-primary">
                                                        @php  $a2 = str_replace(" ", "_", $answer); @endphp
                                                          <input type="hidden" id="id{{ $a2 }}" value="{{ $quest->id }}">
                                                          @if($an[0] == "radio")    
                                                             @if($a2 != "radio")
                                                                  <input id="{{ $quest->id }}{{ $loop->iteration }}{{ $answer }}" name="{{ $quest->id }}" type="radio" value="{{ $a2 }}">
                                                                  <label for="{{ $quest->id }}{{ $loop->iteration }}{{ $answer }}">
                                                                      {{ $answer }}
                                                                  </label>
                                                             @endif  
                                                          @else
                                                                  @if($a2 == "texto") 
                                                                    <input id="{{ $quest->id }}{{ $loop->iteration }}" type="textarea" value="{{ $a2 }}" name="resp[]">
                                                                    <label for="{{ $quest->id }}{{ $loop->iteration }}">
                                                                        {{ $answer }}
                                                                    </label>
                                                                    @else
                                                                      @if($a2 != "checkbox")
                                                                        <input id="{{ $quest->id }}{{ $loop->iteration }}" type="checkbox" value="{{ $a2 }}" name="resp[]">
                                                                        <label for="{{ $quest->id }}{{ $loop->iteration }}">
                                                                            {{ $answer }}
                                                                        </label>
                                                                      @endif  
                                                              @endif
                                                         @endif 
                                                      </div>
                                               @endforeach        
                                      @endif
                                   @endforeach  
                                      </a>
                                        </li>
                              </ul>     
                      </div>
                    </div> 
                  </div>
              </div>  