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
                           