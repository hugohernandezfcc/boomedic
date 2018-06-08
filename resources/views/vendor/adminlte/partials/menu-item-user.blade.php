<style type="text/css">
        .animated {
          
          animation-name: parpadeo;
          animation-duration: 1s;
          animation-timing-function: linear;
          animation-iteration-count: infinite;

          -webkit-animation-name:parpadeo;
          -webkit-animation-duration: 1s;
          -webkit-animation-timing-function: linear;
          -webkit-animation-iteration-count: infinite;
        }

        @-moz-keyframes parpadeo{  
          0% { opacity: 1.0; }
          50% { opacity: 0.0; }
          100% { opacity: 1.0; }
        }

        @-webkit-keyframes parpadeo {  
          0% { opacity: 1.0; }
          50% { opacity: 0.0; }
           100% { opacity: 1.0; }
        }

        @keyframes parpadeo {  
          0% { opacity: 1.0; }
           50% { opacity: 0.0; }
          100% { opacity: 1.0; }
        }
</style>
          <!--bar notifictions -->    
                          <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" id="mess">
                              <i class="fa fa-envelope-o"></i>
                              <span class="label label-success" id="messN"></span>
                            </a>
                            <ul class="dropdown-menu">
                              <li class="header" id="countMes"></li>
                              <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu" id="newMess">
                                <li>
                                <div class="col-sm-6" align="center">
                                    <img src="{{ asset(config('adminlte.empty-message')) }}" height="60" width="60">
                                </div><div class="col-sm-6 text-muted" align="center">    
                                    <h5>No tienes mensajes nuevos</h5><br>
                                </div>
                                 </li>
                                </ul>
                              </li>
                            </ul>
                          </li>
                                  <!-- end message -->
                          <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="not">
                              <i class="fa fa-bell-o"></i>
                              <span class="label label-warning" style="background-color: #000000 !important; display: none;" id="notN"></span>
                            </a>
                            <ul class="dropdown-menu">
                              <li class="header" id="countNot"></li>
                              <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu" id="notify">
                                </ul>
                              </li>
                            </ul>
                          </li>
          <!--bar notifictions -->

              <!-- bar perfil user -->
                 <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                  @if($photo == '')
                                        <img src="https://s3.amazonaws.com/abiliasf/profile-42914_640.png" class="user-image" alt="User Image">
                                    @else
                                        <img src="{{ $photo }}?{{ \Carbon\Carbon::now()->format('h:i') }}" class="user-image" alt="User Image">            
                                    @endif 
                                  <span class="hidden-xs">{{ $name }}</span>
                                </a>
                                <ul class="dropdown-menu bg-darken-4">
                                  <!-- User image -->
                                  <li class="user-header" style="background-color: #222;" id="uh">
                                    @if($photo == '')
                                      @if(session()->get('utype') == "doctor")
                                      <img src="https://s3.amazonaws.com/abiliasf/profile-42914_640.png" class="img-circle" alt="User Image" width="100" height="100" onclick="window.location.href='{{ url('/doctor/doctor') }}/{{Auth::id()}}'">
                                       @else
                                         <img src="https://s3.amazonaws.com/abiliasf/profile-42914_640.png" class="img-circle" alt="User Image" width="100" height="100" onclick="window.location.href='{{ url('/user/profile') }}/{{Auth::id()}}'">
                                        @endif
                                    @else
                                    @if(session()->get('utype') == "doctor")
                                       <img src="{{ $photo }}?{{ \Carbon\Carbon::now()->format('h:i') }}" class="img-circle" alt="User Image" width="100" height="100" onclick="window.location.href='{{ url('/doctor/doctor') }}/{{Auth::id()}}'">    
                                       @else
                                       <img src="{{ $photo }}?{{ \Carbon\Carbon::now()->format('h:i') }}" class="img-circle" alt="User Image" width="100" height="100" onclick="window.location.href='{{ url('/user/profile') }}/{{Auth::id()}}'">    
                                        @endif
                                    @endif 

                                    <p>
                                       @if(session()->get('utype') == "doctor")
                                         <a href="{{ url('/doctor/doctor') }}/{{Auth::id()}}" class="text" id="au"> {{ $name }} </a>
                                       @else
                                        <a href="{{ url('/user/profile') }}/{{Auth::id()}}" class="text" id="au"> {{ $name }} </a>
                                        @endif
                                      <small>Miembro desde
                                        @if(\Carbon\Carbon::parse($date)->format('m') == '01') Ene. @endif
                                        @if(\Carbon\Carbon::parse($date)->format('m') == '02') Feb. @endif
                                        @if(\Carbon\Carbon::parse($date)->format('m') == '03') Mar. @endif
                                        @if(\Carbon\Carbon::parse($date)->format('m') == '04') Abr. @endif
                                        @if(\Carbon\Carbon::parse($date)->format('m') == '05') May. @endif
                                        @if(\Carbon\Carbon::parse($date)->format('m') == '06') Jun. @endif
                                        @if(\Carbon\Carbon::parse($date)->format('m') == '07') Jul. @endif
                                        @if(\Carbon\Carbon::parse($date)->format('m') == '08') Ago. @endif
                                        @if(\Carbon\Carbon::parse($date)->format('m') == '09') Sep. @endif
                                        @if(\Carbon\Carbon::parse($date)->format('m') == '10') Oct. @endif
                                        @if(\Carbon\Carbon::parse($date)->format('m') == '11') Nov. @endif
                                        @if(\Carbon\Carbon::parse($date)->format('m') == '12') Dic. @endif
                                        {{ \Carbon\Carbon::parse($date)->format('Y') }}

                                      </small>
                                    </p>

                                  </li>
                                              <!--bARRA DE MENSAJES-->                        

                                  <!-- Menu Footer-->
                                  <li class="user-footer" style="background-color: #222;" id="uf">
                                    <div class="pull-center">
                            @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
                              
                                <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" class="btn btn-default btn-block btn-flat" style="background:white; color:black;">
                                    <i class="fa fa-sign-out"></i> {{ trans('adminlte::adminlte.log_out') }}
                                </a>
                              
                            @else
                              @if(!session()->get('parental'))
                                <a
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                 class="btn btn-default btn-block btn-flat" style="background:white; color: black;">
                                    <i class="fa fa-sign-out"></i> {{ trans('adminlte::adminlte.log_out') }}
                                </a>
                                  @else
                               <a href="{{ url('logoutback') }}" class="btn btn-default btn-block btn-flat" style="background:white; color:black;">
                                    <i class="fa fa-sign-out"></i> {{ trans('adminlte::adminlte.log_out') }}
                                </a>
                                @endif
                                <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
                                    @if(config('adminlte.logout_method'))
                                        {{ method_field(config('adminlte.logout_method')) }}
                                    @endif
                                    {{ csrf_field() }}
                                </form>
                            @endif
                                    </div>
                                  </li>
                                </ul>
                              </li>
                 <!-- End bar perfil user -->              

                <!-- Tools en doctor-->
                 @if(session()->get('utype') == "doctor")              
                    <li>
                        <a data-toggle="control-sidebar"><i class="fa fa-child"></i><span class="label label-warning animated">¡HOLA!</span></a>
                    </li>
                @endif   
                 <!-- Tools en doctor--> 
                           