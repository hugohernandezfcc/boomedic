@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')
@stop

@section('content')

  	<div class="box-header">
	    <h3 class="box-title">Historial</h3>
  	</div>


  	<div class="box-body">
	  <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
		  	 @if($array->isEmpty())
					
			<li>
              <i class="fa fa-warning bg-red"></i>

              <div class="timeline-item">
                <h3 class="timeline-header no-border"> No tiene historial registrado en estos últimos días. </h3>
              </div>
            </li>
					
					
			@else 
			<form name="form" action="" onSubmit="enviarDatos(); return false">
			<input type="text" id="val" name="val" value=""/>
			<div class="btn-group">
			<button class="btn bg-blue" title="Mostrar solo soporte" onclick="changeValue('Medical Appointments')"> <i class="fa fa-user-md"></i></button>	
			<button class="btn bg-black" title="Mostrar solo citas" onclick="changeValue('Support Tickets')"><i class="fa fa-wrench "></i></button>
			<button class="btn bg-yellow" title="Mostrar solo actualización de usuario" onclick="changeValue('Payment')"> <i class="fa fa-credit-card-alt"></i></button>	
			<button class="btn bg-green" title="Métodos de pagos registrados" onclick="changeValue('User')"><i class="fa fa-user "></i></button>		
			</div>
			</form>
	 <br/><br/><br/>
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
            <li>
              <i class="fa fa-user-md bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header no-border"><a href="{{ url('/medicalconsultations') }}">Cita registrada</a></h3>
                <div class="timeline-body">
                	<b>Fecha asignada:</b> {{ \Carbon\Carbon::parse($items['when'])->format('d-m-Y h:i A') }} <br/>
                	<b>Estado:</b> {{ $items['status']}} <br/>
                	<b>Lugar:</b> {{ $items['workplace']}} 
                </div>
              </div>
            </li>
            @endif

            @if($items['Type'] == 'Support Ticket')
            <li>
              <i class="fa fa-wrench bg-black"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header no-border"><a href="{{ url('supportTicket/index') }}">Ticket de Soporte creado:</a></h3>
                <div class="timeline-body">
                	<b>Asunto:</b> {{ $items['des']}} 
                </div>
              </div>
            </li>
            @endif

           @if($items['Type'] == 'User')
            <li>
              <i class="fa fa-user bg-green"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header no-border"><a href="{{ url('/user/edit/complete') }}">Se realizaron cambios en el perfíl</a> 
                </h3>
              </div>
            </li>
            @endif
            <!-- END timeline item -->
            <!-- timeline item -->
            @if($items['Type'] == 'Payment Method')
            <li>
              <i class="fa fa-credit-card-alt bg-yellow"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>

                <h3 class="timeline-header"><a href="#">Se agregó un método de Pago</a></h3>

                <div class="timeline-body">
                	<b>Tipo:</b> {{ $items['typemethod'] }} 
                	@if( $items['typemethod'] != 'Paypal')
	                @php
	                            $cardfin = substr_replace($items['cardnumber'], '••••••••••••', 0, 12);
	                            echo $cardfin;

	                @endphp

	                @endif
                </div>
                <div class="timeline-footer">
                  <a class="btn btn-warning btn-flat btn-xs" href="{{ url('/payment/index') }}">Ver más</a>
                  <a class="btn btn-warning btn-flat btn-xs" href="{{ url('/payment/Transactions') }}/{{ $items['id'] }}">Ver Transacciones realizadas con este método</a>
                </div>
              </div>
            </li>
            @endif

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
            <li>
              <i class="fa fa-user-md bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header no-border"><a href="{{ url('/medicalconsultations') }}">Cita registrada</a></h3>
                <div class="timeline-body">
                	<b>Fecha asignada:</b> {{ \Carbon\Carbon::parse($items['when'])->format('d-m-Y h:i A') }} <br/>
                	<b>Estado:</b> {{ $items['status']}} <br/>
                	<b>Lugar:</b> {{ $items['workplace']}} 
                </div>
              </div>
            </li>
            @endif
            
            @if($items['Type'] == 'Support Ticket')
            <li>
              <i class="fa fa-wrench bg-black"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header no-border"><a href="{{ url('supportTicket/index') }}">Ticket de Soporte creado:</a></h3>
                <div class="timeline-body">
                	<b>Asunto:</b> {{ $items['des']}} 
                </div>
              </div>
            </li>
            @endif

           @if($items['Type'] == 'User')
            <li>
              <i class="fa fa-user bg-green"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header no-border"><a href="{{ url('/user/edit/complete') }}">Se realizaron cambios en el perfíl</a> 
                </h3>
              </div>
            </li>
            @endif
            <!-- END timeline item -->
            <!-- timeline item -->
            @if($items['Type'] == 'Payment Method')
            <li>
              <i class="fa fa-credit-card-alt bg-yellow"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>

                <h3 class="timeline-header"><a href="#">Se agregó un método de Pago</a></h3>

                <div class="timeline-body">
                	<b>Tipo:</b> {{ $items['typemethod'] }} 
                	@if( $items['typemethod'] != 'Paypal')
	                @php
	                            $cardfin = substr_replace($items['cardnumber'], '••••••••••••', 0, 12);
	                            echo $cardfin;

	                @endphp

	                @endif
                </div>
                <div class="timeline-footer">
                  <a class="btn btn-warning btn-flat btn-xs" href="{{ url('/payment/index') }}">Ver más</a>
                  <a class="btn btn-warning btn-flat btn-xs" href="{{ url('/payment/Transactions') }}/{{ $items['id'] }}">Ver Transacciones realizadas con este método</a>
                </div>
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
            <li>
              <i class="fa fa-user-md bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header no-border"><a href="{{ url('/medicalconsultations') }}">Cita registrada</a></h3>
                <div class="timeline-body">
                	<b>Fecha asignada:</b> {{ \Carbon\Carbon::parse($items['when'])->format('d-m-Y h:i A') }}<br/>
                	<b>Estado:</b> {{ $items['status']}} <br/>
                	<b>Lugar:</b> {{ $items['workplace']}} 
                </div>
              </div>
            </li>
            @endif

            @if($items['Type'] == 'Support Ticket')
            <li>
              <i class="fa fa-wrench bg-black"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header no-border"><a href="{{ url('supportTicket/index') }}">Ticket de Soporte creado:</a></h3>
                <div class="timeline-body">
                	<b>Asunto:</b> {{ $items['des']}} 
                </div>
              </div>
            </li>
            @endif

           @if($items['Type'] == 'User')
            <li>
              <i class="fa fa-user bg-green"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header no-border"><a href="{{ url('/user/edit/complete') }}">Se realizaron cambios en el perfíl</a> 
                </h3>
              </div>
            </li>
            @endif
            <!-- END timeline item -->
            <!-- timeline item -->
            @if($items['Type'] == 'Payment Method')
            <li>
              <i class="fa fa-credit-card-alt bg-yellow"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>

                <h3 class="timeline-header"><a href="#">Se agregó un método de Pago</a></h3>

                <div class="timeline-body">
                	<b>Tipo:</b> {{ $items['typemethod'] }} 
                	@if( $items['typemethod'] != 'Paypal')
	                @php
	                            $cardfin = substr_replace($items['cardnumber'], '••••••••••••', 0, 12);
	                            echo $cardfin;

	                @endphp

	                @endif
                </div>
                <div class="timeline-footer">
                  <a class="btn btn-warning btn-flat btn-xs" href="{{ url('/payment/index') }}">Ver más</a>
                  <a class="btn btn-warning btn-flat btn-xs" href="{{ url('/payment/Transactions') }}/{{ $items['id'] }}">Ver Transacciones realizadas con este método</a>
                </div>
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
            <li>
              <i class="fa fa-user-md bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header no-border"><a href="{{ url('/medicalconsultations') }}">Cita registrada</a></h3>
                <div class="timeline-body">
                	<b>Fecha asignada:</b> {{ \Carbon\Carbon::parse($items['when'])->format('d-m-Y h:i A') }} <br/>
                	<b>Estado:</b> {{ $items['status']}} <br/>
                	<b>Lugar:</b> {{ $items['workplace']}} 
                </div>
              </div>
            </li>
            @endif

            @if($items['Type'] == 'Support Ticket')
            <li>
              <i class="fa fa-wrench bg-black"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header no-border"><a href="{{ url('supportTicket/index') }}">Ticket de Soporte creado:</a></h3>
                <div class="timeline-body">
                	<b>Asunto:</b> {{ $items['des']}} 
                </div>
              </div>
            </li>
            @endif

           @if($items['Type'] == 'User')
            <li>
              <i class="fa fa-user bg-green"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header no-border"><a href="{{ url('/user/edit/complete') }}">Se realizaron cambios en el perfíl</a> 
                </h3>
              </div>
            </li>
            @endif
            <!-- END timeline item -->
            <!-- timeline item -->
            @if($items['Type'] == 'Payment Method')
            <li>
              <i class="fa fa-credit-card-alt bg-yellow"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>

                <h3 class="timeline-header"><a href="#">Se agregó un método de Pago</a></h3>

                <div class="timeline-body">
                	<b>Tipo:</b> {{ $items['typemethod'] }} 
                	@if( $items['typemethod'] != 'Paypal')
	                @php
	                            $cardfin = substr_replace($items['cardnumber'], '••••••••••••', 0, 12);
	                            echo $cardfin;

	                @endphp

	                @endif
                </div>
                <div class="timeline-footer">
                  <a class="btn btn-warning btn-flat btn-xs" href="{{ url('/payment/index') }}">Ver más</a>
                  <a class="btn btn-warning btn-flat btn-xs" href="{{ url('/payment/Transactions') }}/{{ $items['id'] }}">Ver Transacciones realizadas con este método</a>
                </div>
              </div>
            </li>
            @endif

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
            <li>
              <i class="fa fa-user-md bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header no-border"><a href="{{ url('/medicalconsultations') }}">Cita registrada</a></h3>
                <div class="timeline-body">
                	<b>Fecha asignada:</b> {{ \Carbon\Carbon::parse($items['when'])->format('d-m-Y h:i A') }} <br/>
                	<b>Estado:</b> {{ $items['status']}} <br/>
                	<b>Lugar:</b> {{ $items['workplace']}} 
                </div>
              </div>
            </li>
            @endif

            @if($items['Type'] == 'Support Ticket')
            <li>
              <i class="fa fa-wrench bg-black"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header no-border"><a href="{{ url('supportTicket/index') }}">Ticket de Soporte creado:</a></h3>
                <div class="timeline-body">
                	<b>Asunto:</b> {{ $items['des']}} 
                </div>
              </div>
            </li>
            @endif

           @if($items['Type'] == 'User')
            <li>
              <i class="fa fa-user bg-green"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header no-border"><a href="{{ url('/user/edit/complete') }}">Se realizaron cambios en el perfíl</a> 
                </h3>
              </div>
            </li>
            @endif
            <!-- END timeline item -->
            <!-- timeline item -->
            @if($items['Type'] == 'Payment Method')
            <li>
              <i class="fa fa-credit-card-alt bg-yellow"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>

                <h3 class="timeline-header"><a href="#">Se agregó un método de Pago</a></h3>

                <div class="timeline-body">
                	<b>Tipo:</b> {{ $items['typemethod'] }} 
                	@if( $items['typemethod'] != 'Paypal')
	                @php
	                            $cardfin = substr_replace($items['cardnumber'], '••••••••••••', 0, 12);
	                            echo $cardfin;

	                @endphp

	                @endif
                </div>
                <div class="timeline-footer">
                  <a class="btn btn-warning btn-flat btn-xs" href="{{ url('/payment/index') }}">Ver más</a>
                  <a class="btn btn-warning btn-flat btn-xs" href="{{ url('/payment/Transactions') }}/{{ $items['id'] }}">Ver Transacciones realizadas con este método</a>
                </div>
              </div>
            </li>
            @endif

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
            <li>
              <i class="fa fa-user-md bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header no-border"><a href="{{ url('/medicalconsultations') }}">Cita registrada</a></h3>
                <div class="timeline-body">
                	<b>Fecha asignada:</b> {{ \Carbon\Carbon::parse($items['when'])->format('d-m-Y h:i A') }} <br/>
                	<b>Estado:</b> {{ $items['status']}} <br/>
                	<b>Lugar:</b> {{ $items['workplace']}} 
                </div>
              </div>
            </li>
            @endif

            @if($items['Type'] == 'Support Ticket')
            <li>
              <i class="fa fa-wrench bg-black"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header no-border"><a href="{{ url('supportTicket/index') }}">Ticket de Soporte creado:</a></h3>
                <div class="timeline-body">
                	<b>Asunto:</b> {{ $items['des']}} 
                </div>
              </div>
            </li>
            @endif

           @if($items['Type'] == 'User')
            <li>
              <i class="fa fa-user bg-green"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header no-border"><a href="{{ url('/user/edit/complete') }}">Se realizaron cambios en el perfíl</a> 
                </h3>
              </div>
            </li>
            @endif
            <!-- END timeline item -->
            <!-- timeline item -->
            @if($items['Type'] == 'Payment Method')
            <li>
              <i class="fa fa-credit-card-alt bg-yellow"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>

                <h3 class="timeline-header"><a href="#">Se agregó un método de Pago</a></h3>

                <div class="timeline-body">
                	<b>Tipo:</b> {{ $items['typemethod'] }} 
                	@if( $items['typemethod'] != 'Paypal')
	                @php
	                            $cardfin = substr_replace($items['cardnumber'], '••••••••••••', 0, 12);
	                            echo $cardfin;

	                @endphp

	                @endif
                </div>
                <div class="timeline-footer">
                  <a class="btn btn-warning btn-flat btn-xs" href="{{ url('/payment/index') }}">Ver más</a>
                  <a class="btn btn-warning btn-flat btn-xs" href="{{ url('/payment/Transactions') }}/{{ $items['id'] }}">Ver Transacciones realizadas con este método</a>
                </div>
              </div>
            </li>
            @endif

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
            <li>
              <i class="fa fa-user-md bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header no-border"><a href="{{ url('/medicalconsultations') }}">Cita registrada</a></h3>
                <div class="timeline-body">
                	<b>Fecha asignada:</b> {{ \Carbon\Carbon::parse($items['when'])->format('d-m-Y h:i A') }} <br/>
                	<b>Estado:</b> {{ $items['status']}} <br/>
                	<b>Lugar:</b> {{ $items['workplace']}} 
                </div>
              </div>
            </li>
            @endif
            
            @if($items['Type'] == 'Support Ticket')
            <li>
              <i class="fa fa-wrench bg-black"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header no-border"><a href="{{ url('supportTicket/index') }}">Ticket de Soporte creado:</a></h3>
                <div class="timeline-body">
                	<b>Asunto:</b> {{ $items['des']}} 
                </div>
              </div>
            </li>
            @endif

           @if($items['Type'] == 'User')
            <li>
              <i class="fa fa-user bg-green"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>
                <h3 class="timeline-header no-border"><a href="{{ url('/user/edit/complete') }}">Se realizaron cambios en el perfíl</a> 
                </h3>
              </div>
            </li>
            @endif
            <!-- END timeline item -->
            <!-- timeline item -->
            @if($items['Type'] == 'Payment Method')
            <li>
              <i class="fa fa-credit-card-alt bg-yellow"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>

                <h3 class="timeline-header"><a href="#">Se agregó un método de Pago</a></h3>

                <div class="timeline-body">
                	<b>Tipo:</b> {{ $items['typemethod'] }} 
                	@if( $items['typemethod'] != 'Paypal')
	                @php
	                            $cardfin = substr_replace($items['cardnumber'], '••••••••••••', 0, 12);
	                            echo $cardfin;

	                @endphp

	                @endif
                </div>
                <div class="timeline-footer">
                  <a class="btn btn-warning btn-flat btn-xs" href="{{ url('/payment/index') }}">Ver más</a>
                  <a class="btn btn-warning btn-flat btn-xs" href="{{ url('/payment/Transactions') }}/{{ $items['id'] }}">Ver Transacciones realizadas con este método</a>
                </div>
              </div>
            </li>
            @endif

            @endforeach
         @endif  
            @endif
            <!-- END timeline item -->
            
			<br/>
			@if($mode != 'more')
            <div align="right">
              <a href="{{ url('/history/moredays') }}" class="btn btn-secondary btn-flat btn-xs"> Ver más del histórico </a>
          	</div>
          	@endif
          	@if($mode == 'more')
           <div align="right">
              <a href="{{ url('/history/index') }}" class="btn btn-secondary btn-flat btn-xs"> Volver </a>
          	</div>
          	
          	@if($arraynow->isEmpty() && $array1->isEmpty() && $array2->isEmpty() && $array3->isEmpty() && $array4->isEmpty() && $array5->isEmpty() && $array6->isEmpty())
          	<div align="center">
              No hay más histórico registrado en los días anteriores.
          	</div>
          	@endif
          	@endif
          	<li>
              <i class="fa fa-clock-o bg-gray"></i>

            </li>
            
          </ul>

          </div>
        <!-- /.col -->

      </div>

 	</div>
 <script type="text/javascript">
		   function changeValue(o){
		     document.getElementById('val').value= o;
		    }

    	function objetoAjax(){
		var xmlhttp = false;
		try {
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
 
			try {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (E) {
				xmlhttp = false; }
		}
 
		if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		  xmlhttp = new XMLHttpRequest();
		}
		return xmlhttp;
	}


function enviarDatos(){
 
        //Recogemos los valores introducimos en los campos de texto
		vari = document.form.val.value;
		ajax = objetoAjax();
 
		//Abrimos una conexión AJAX pasando como parámetros el método de envío, y el archivo que realizará las operaciones deseadas
		ajax.open("POST", "history/filter", true);
 
		//cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
		//Llamamos al método setRequestHeader indicando que los datos a enviarse están codificados como un formulario. 
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
 
		//enviamos las variables a 'consulta.php' 
		ajax.send("&val="+vari); 
 
}
</script>	
 	
@stop