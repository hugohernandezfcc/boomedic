<style type="text/css">


  .timeline>li {
    margin-right: 0 !important;
}

.timeline>li>.timeline-item {
   margin-right: 0 !important;
}
      .direct-chat-contacts {
            height: 55px !important;
            background: transparent !important; 
            top: 75% !important; 
      }
 .timeline>li>.timeline-item>.timeline-header {
    border-bottom: 1px solid #e0e0e0 !important;
}
.timeline-footer {


    padding: 5px 0 0 0;
    border-top: 1px solid #e0e0e0 !important;
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
  .modal-body{
    background: white;
  }      
</style>

        @if($arraynow->isEmpty() && $array1->isEmpty() && $array2->isEmpty() && $array3->isEmpty() && $array4->isEmpty() && $array5->isEmpty() && $array6->isEmpty())
    <div class="box-header">
                          @include('empty.emptyData', 
                                            [
                                              'emptyc' => 'not_buttom',
                                              'title'  => 'más históricos',
                                              'icon'   => 'adminlte.empty-box'
                                            ]
                                          )
                            </div>     
        @else
     <div class="box-header direct-chat" id="header2">
       <button type="button" class="btn pull-right" title="" data-widget="chat-pane-toggle">
                 <span class="fa fa-filter text-muted"></span></button>
              <div class="direct-chat-contacts">
                      <div class="btn-group pull-right">
                      <button id="appointment" type="button" class="btn bg-blue" title="Mostrar solo citas"><i class="fa fa-calendar-check-o"></i></button>   
                      <button id="userli" type="button" class="btn bg-green" title="Mostrar solo actualización de usuario"><i class="fa fa-user "></i></button>
                      <button id="all" type="button" class="btn btn-default" title="Ver todo"><b>Ver todo</b></button>        
                      </div>
              </div>
    </div>
  	<div class="box-body content">

	  <div class="row">
        <div class="col-md-12">
        <div align="center"><label id="response" style="margin-top: 20px; margin-botton: 0 !important"></label></div>
          <!-- The time line -->
          <ul class="timeline">
					
			<!-- Now -->
    @if(!$arraynow->isEmpty())
            <!-- 1 day -->
			<li class="time-label">
                  <span class="bg-gray">
                    {{ \Carbon\Carbon::parse($arraynow[0]['updated_at'])->format('d-m-Y') }}
                  </span>
            </li>
            
          @foreach($arraynow as $items) 
            <!-- timeline time label -->

          @if($items['Type'] == 'Medical Appointments')
            <li class="appointment">
              <i class="fa fa-calendar-check-o bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header"><a href="javascript:void(0)">Cita registrada</a></h3>
                <div class="timeline-body">
                  <b>Fecha asignada:</b> {{ \Carbon\Carbon::parse($items['when'])->format('d-m-Y h:i A') }} <br/>
                  <b>Estado:</b> {{ $items['status']}} <br/>
                  <b>Lugar:</b> {{ $items['workplace']}}<br/>
                </div>
                 <div class="timeline-footer">
                    <a data-target="#modalmap" data-toggle="modal" class="btn btn-secondary btn-xs">Ver mapa</a>
                 </div>
              </div>
            </li>
            <div class="modal fade" id="modalmap" role="dialog">
          <div class="modal-dialog">
          <div class="modal-content">  
                         <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                            <div align="left"><label>Mapa de ubicación</label></div>
                        </div>

            <div class="modal-body">
              <div align="center">
                          <img border="0" src="//maps.googleapis.com/maps/api/staticmap?center={{ $items['latitude'] }},{{ $items['longitude'] }}&amp;markers=color:black%7Clabel:%7C{{ $items['latitude'] }},{{ $items['longitude'] }}&amp;zoom=15&amp;style=element:geometry%7Ccolor:0xf5f5f5&amp;size=400x400&amp;key=AIzaSyCKh6YcZQgwbcbUBCftcAQq7rfL5bLW_6g" alt="ubicación" style="width:100%;">
              </div>            
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
        </div>
            @endif

           @if($items['Type'] == 'User')
            <li class="userli">
              <i class="fa fa-user bg-green"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header"><a href="javascript:void(0)">Se realizaron cambios en el perfíl</a> 
                </h3>
              </div>
            </li>
            @endif
            <!-- END timeline item -->
            <!-- timeline item -->
            @endforeach
         @endif 
 		@if(!$array1->isEmpty())
            <!-- 1 day -->
			<li class="time-label">
                  <span class="bg-gray">
                    {{ \Carbon\Carbon::parse($array1[0]['updated_at'])->format('d-m-Y') }}
                  </span>
            </li>
            
          @foreach($array1 as $items) 
            <!-- timeline time label -->

          @if($items['Type'] == 'Medical Appointments')
            <li class="appointment">
              <i class="fa fa-calendar-check-o bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header"><a href="javascript:void(0)">Cita registrada</a></h3>
                <div class="timeline-body">
                  <b>Fecha asignada:</b> {{ \Carbon\Carbon::parse($items['when'])->format('d-m-Y h:i A') }} <br/>
                  <b>Estado:</b> {{ $items['status']}} <br/>
                  <b>Lugar:</b> {{ $items['workplace']}}<br/>
                </div>
                 <div class="timeline-footer">
                    <a data-target="#modalmap" data-toggle="modal" class="btn btn-secondary btn-xs">Ver mapa</a>
                 </div>
              </div>
            </li>
            <div class="modal fade" id="modalmap" role="dialog">
          <div class="modal-dialog">
          <div class="modal-content"> 
                         <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                            <div align="left"><label>Mapa de ubicación</label></div>
                        </div>
                        </div>
            <div class="modal-body">
              <div align="center">
                          <img border="0" src="//maps.googleapis.com/maps/api/staticmap?center={{ $items['latitude'] }},{{ $items['longitude'] }}&amp;markers=color:black%7Clabel:%7C{{ $items['latitude'] }},{{ $items['longitude'] }}&amp;zoom=15&amp;style=element:geometry%7Ccolor:0xf5f5f5&amp;size=400x400&amp;key=AIzaSyCKh6YcZQgwbcbUBCftcAQq7rfL5bLW_6g" alt="ubicación" style="width:100%;">
              </div>            
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
            @endif
          
           @if($items['Type'] == 'User')
            <li class="userli">
              <i class="fa fa-user bg-green"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header"><a href="javascript:void(0)">Se realizaron cambios en el perfíl</a> 
                </h3>
              </div>
            </li>
            @endif


            @endforeach
         @endif 

         		@if(!$array2->isEmpty())
            <!-- 1 day -->
			<li class="time-label">
                  <span class="bg-gray">
                    {{ \Carbon\Carbon::parse($array2[0]['updated_at'])->format('d-m-Y') }}
                  </span>
            </li>
            
          @foreach($array2 as $items) 
            <!-- timeline time label -->

          @if($items['Type'] == 'Medical Appointments')
            <li class="appointment">
              <i class="fa fa-calendar-check-o bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header"><a href="javascript:void(0)">Cita registrada</a></h3>
                <div class="timeline-body">
                  <b>Fecha asignada:</b> {{ \Carbon\Carbon::parse($items['when'])->format('d-m-Y h:i A') }} <br/>
                  <b>Estado:</b> {{ $items['status']}} <br/>
                  <b>Lugar:</b> {{ $items['workplace']}}<br/>
                </div>
                 <div class="timeline-footer">
                    <a data-target="#modalmap" data-toggle="modal" class="btn btn-secondary btn-xs">Ver mapa</a>
                 </div>
              </div>
            </li>
            <div class="modal fade" id="modalmap" role="dialog">
          <div class="modal-dialog">
          <div class="modal-content">  
                         <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                            <div align="left"><label>Mapa de ubicación</label></div>
                        </div>
            <div class="modal-body">
                  <div align="center">
                          <img border="0" src="//maps.googleapis.com/maps/api/staticmap?center={{ $items['latitude'] }},{{ $items['longitude'] }}&amp;markers=color:black%7Clabel:%7C{{ $items['latitude'] }},{{ $items['longitude'] }}&amp;zoom=15&amp;style=element:geometry%7Ccolor:0xf5f5f5&amp;size=400x400&amp;key=AIzaSyCKh6YcZQgwbcbUBCftcAQq7rfL5bLW_6g" alt="ubicación" style="width:100%;">
                  </div>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
        </div>
            @endif

           @if($items['Type'] == 'User')
            <li class="userli">
              <i class="fa fa-user bg-green"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header"><a href="javascript:void(0)">Se realizaron cambios en el perfíl</a> 
                </h3>
              </div>
            </li>
            @endif


            @endforeach
         @endif   

         		@if(!$array3->isEmpty())
            <!-- 1 day -->
			<li class="time-label">
                  <span class="bg-gray">
                    {{ \Carbon\Carbon::parse($array3[0]['updated_at'])->format('d-m-Y') }}
                  </span>
            </li>
            
          @foreach($array3 as $items) 
            <!-- timeline time label -->

          @if($items['Type'] == 'Medical Appointments')
            <li class="appointment">
              <i class="fa fa-calendar-check-o bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header"><a href="javascript:void(0)">Cita registrada</a></h3>
                <div class="timeline-body">
                  <b>Fecha asignada:</b> {{ \Carbon\Carbon::parse($items['when'])->format('d-m-Y h:i A') }} <br/>
                  <b>Estado:</b> {{ $items['status']}} <br/>
                  <b>Lugar:</b> {{ $items['workplace']}}<br/>
                </div>
                 <div class="timeline-footer">
                    <a data-target="#modalmap" data-toggle="modal" class="btn btn-secondary btn-xs">Ver mapa</a>
                 </div>
              </div>
            </li>
            <div class="modal fade" id="modalmap" role="dialog">
          <div class="modal-dialog">
          <div class="modal-content"> 
                         <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                            <div align="left"><label>Mapa de ubicación</label></div>
                        </div>
            <div class="modal-body">
                 <div align="center">
                          <img border="0" src="//maps.googleapis.com/maps/api/staticmap?center={{ $items['latitude'] }},{{ $items['longitude'] }}&amp;markers=color:black%7Clabel:%7C{{ $items['latitude'] }},{{ $items['longitude'] }}&amp;zoom=15&amp;style=element:geometry%7Ccolor:0xf5f5f5&amp;size=400x400&amp;key=AIzaSyCKh6YcZQgwbcbUBCftcAQq7rfL5bLW_6g" alt="ubicación" style="width:100%;">
                 </div>          
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
        </div>
            @endif


           @if($items['Type'] == 'User')
            <li class="userli">
              <i class="fa fa-user bg-green"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header"><a href="javascript:void(0)">Se realizaron cambios en el perfíl</a> 
                </h3>
              </div>
            </li>
            @endif
            <!-- END timeline item -->
            <!-- timeline item -->

            @endforeach
         @endif  

         		@if(!$array4->isEmpty())
            <!-- 1 day -->
			<li class="time-label">
                  <span class="bg-gray">
                    {{ \Carbon\Carbon::parse($array4[0]['updated_at'])->format('d-m-Y') }}
                  </span>
            </li>
            
          @foreach($array4 as $items) 
            <!-- timeline time label -->

          @if($items['Type'] == 'Medical Appointments')
            <li class="appointment">
              <i class="fa fa-calendar-check-o bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header"><a href="javascript:void(0)">Cita registrada</a></h3>
                <div class="timeline-body">
                  <b>Fecha asignada:</b> {{ \Carbon\Carbon::parse($items['when'])->format('d-m-Y h:i A') }} <br/>
                  <b>Estado:</b> {{ $items['status']}} <br/>
                  <b>Lugar:</b> {{ $items['workplace']}}<br/>
                </div>
                 <div class="timeline-footer">
                    <a data-target="#modalmap" data-toggle="modal" class="btn btn-secondary btn-xs">Ver mapa</a>
                 </div>
              </div>
            </li>
            <div class="modal fade" id="modalmap" role="dialog">
          <div class="modal-dialog">
          <div class="modal-content">  
                         <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                            <div align="left"><label>Mapa de ubicación</label></div>
                        </div>
            <div class="modal-body">
                 <div align="center">
                          <img border="0" src="//maps.googleapis.com/maps/api/staticmap?center={{ $items['latitude'] }},{{ $items['longitude'] }}&amp;markers=color:black%7Clabel:%7C{{ $items['latitude'] }},{{ $items['longitude'] }}&amp;zoom=15&amp;style=element:geometry%7Ccolor:0xf5f5f5&amp;size=400x400&amp;key=AIzaSyCKh6YcZQgwbcbUBCftcAQq7rfL5bLW_6g" alt="ubicación" style="width:100%;">
                 </div>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
        </div>
            @endif


           @if($items['Type'] == 'User')
            <li class="userli">
              <i class="fa fa-user bg-green"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header"><a href="javascript:void(0)">Se realizaron cambios en el perfíl</a> 
                </h3>
              </div>
            </li>
            @endif
            <!-- END timeline item -->
            <!-- timeline item -->

            @endforeach
         @endif  
         		@if(!$array5->isEmpty())
            <!-- 1 day -->
			<li class="time-label">
                  <span class="bg-gray">
                    {{ \Carbon\Carbon::parse($array5[0]['updated_at'])->format('d-m-Y') }}
                  </span>
            </li>
            
          @foreach($array5 as $items) 
            <!-- timeline time label -->
          @if($items['Type'] == 'Medical Appointments')
            <li class="appointment">
              <i class="fa fa-calendar-check-o bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header"><a href="javascript:void(0)">Cita registrada</a></h3>
                <div class="timeline-body">
                  <b>Fecha asignada:</b> {{ \Carbon\Carbon::parse($items['when'])->format('d-m-Y h:i A') }} <br/>
                  <b>Estado:</b> {{ $items['status']}} <br/>
                  <b>Lugar:</b> {{ $items['workplace']}}<br/>
                </div>
                 <div class="timeline-footer">
                    <a data-target="#modalmap" data-toggle="modal" class="btn btn-secondary btn-xs">Ver mapa</a>
                 </div>
              </div>
            </li>
            <div class="modal fade" id="modalmap" role="dialog">
          <div class="modal-dialog">
          <div class="modal-content">  
                         <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                            <div align="left"><label>Mapa de ubicación</label></div>
                        </div>
            <div class="modal-body">
                 <div align="center">
                          <img border="0" src="//maps.googleapis.com/maps/api/staticmap?center={{ $items['latitude'] }},{{ $items['longitude'] }}&amp;markers=color:black%7Clabel:%7C{{ $items['latitude'] }},{{ $items['longitude'] }}&amp;zoom=15&amp;style=element:geometry%7Ccolor:0xf5f5f5&amp;size=400x400&amp;key=AIzaSyCKh6YcZQgwbcbUBCftcAQq7rfL5bLW_6g" alt="ubicación" style="width:100%;">
                 </div>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
        </div>
            @endif

           @if($items['Type'] == 'User')
            <li class="userli">
              <i class="fa fa-user bg-green"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header"><a href="javascript:void(0)">Se realizaron cambios en el perfíl</a> 
                </h3>
              </div>
            </li>
            @endif
            <!-- END timeline item -->
            <!-- timeline item -->
            @endforeach
         @endif  

         		@if(!$array6->isEmpty())
            <!-- 1 day -->
			<li class="time-label">
                  <span class="bg-gray">
                    {{ \Carbon\Carbon::parse($array6[0]['updated_at'])->format('d-m-Y') }}
                  </span>
            </li>
            
          @foreach($array6 as $items) 
            <!-- timeline time label -->

          @if($items['Type'] == 'Medical Appointments')
            <li class="appointment">
              <i class="fa fa-calendar-check-o bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header"><a href="javascript:void(0)">Cita registrada</a></h3>
                <div class="timeline-body">
                  <b>Fecha asignada:</b> {{ \Carbon\Carbon::parse($items['when'])->format('d-m-Y h:i A') }} <br/>
                  <b>Estado:</b> {{ $items['status']}} <br/>
                  <b>Lugar:</b> {{ $items['workplace']}}<br/>
                </div>
                 <div class="timeline-footer">
                    <a data-target="#modalmap" data-toggle="modal" class="btn btn-secondary btn-xs">Ver mapa</a>
                 </div>
              </div>
            </li>
            <div class="modal fade" id="modalmap" role="dialog">
          <div class="modal-dialog">
          <div class="modal-content">  
                         <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                            <div align="left"><label>Mapa de ubicación</label></div>
                        </div>
            <div class="modal-body">
                   <div align="center">
                          <img border="0" src="//maps.googleapis.com/maps/api/staticmap?center={{ $items['latitude'] }},{{ $items['longitude'] }}&amp;markers=color:black%7Clabel:%7C{{ $items['latitude'] }},{{ $items['longitude'] }}&amp;zoom=15&amp;style=element:geometry%7Ccolor:0xf5f5f5&amp;size=400x400&amp;key=AIzaSyCKh6YcZQgwbcbUBCftcAQq7rfL5bLW_6g" alt="ubicación" style="width:100%;">
                  </div>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
        </div>
            @endif

           @if($items['Type'] == 'User')
            <li class="userli">
              <i class="fa fa-user bg-green"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header"><a href="javascript:void(0)">Se realizaron cambios en el perfíl</a> 
                </h3>
              </div>
            </li>
            @endif
            <!-- END timeline item -->
            <!-- timeline item -->

            @endforeach
         @endif  
            <!-- END timeline item -->
            
			<br/>
      @endif
               <li>
                  <i class="fa fa-clock-o bg-gray"></i>
                </li>
              </ul>
          </div>
      </div>

 	</div>

 <script type="text/javascript">

		$("#userli").click(function () {


			var z = document.getElementsByClassName("appointment");
			var i;
			for (i = 0; i < z.length; i++) {
			    z[i].style.display = 'none';
			}

			var u = document.getElementsByClassName("userli");
			var i;
			for (i = 0; i < u.length; i++) {
			    u[i].style.display = 'block';
			}
			if(!u[0]){
			    	document.getElementById("response").innerHTML = "No hay cambios de usuario";
			    }
			    else{
			    	document.getElementById("response").innerHTML = " ";
			    }
			});


		$("#appointment").click(function () {
	

			var z = document.getElementsByClassName("userli");
			var i;
			for (i = 0; i < z.length; i++) {
			    z[i].style.display = 'none';
			}
			var u = document.getElementsByClassName("appointment");
			var i;
			for (i = 0; i < u.length; i++) {
			    u[i].style.display = 'block';
			}
			if(!u[0]){
			    	document.getElementById("response").innerHTML = "No hay citas registradas en este periodo";
			    }
			    else{
			    	document.getElementById("response").innerHTML = " ";
			    }


			});  



			$("#all").click(function () {
	

			var y = document.getElementsByClassName("userli");
			var i;
			for (i = 0; i < y.length; i++) {
			    y[i].style.display = 'block';
			}

			var z = document.getElementsByClassName("appointment");
			var i;
			for (i = 0; i < z.length; i++) {
			    z[i].style.display = 'block';
			}
				
			    	document.getElementById("response").innerHTML = " ";
			    

			});  	     	     
</script>	