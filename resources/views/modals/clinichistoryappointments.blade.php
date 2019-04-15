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
                             <ul class="nav nav-pills nav-stacked">

                                   @foreach($questions as $quest)
                                      @if($quest->createdby == $dr)
                                         <li class="active">
                                            <a href="javascript:void(0)">{{ $quest->question }}  
                                             <ul class="nav nav-pills nav-stacked">
                                                <li>{{ $quest->answer }}</li>
                                             </ul>  
                                            </a>
                                        </li>    
                                      @endif
                                   @endforeach  
                              </ul>     
                      </div>
                    </div> 
                  </div>
              </div>  