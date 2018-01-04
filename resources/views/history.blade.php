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
                <h3 class="timeline-header no-border"> No tiene historial registrado hasta ahora.</h3>
              </div>
            </li>
					
					
			@else 	

          @foreach($array as $items) 
            <!-- timeline time label -->
          @if(\Carbon\Carbon::parse($items['created_at'])->format('d-m-Y') == \Carbon\Carbon::now()->format('d-m-Y') || \Carbon\Carbon::parse($items['created_at'])->format('d-m-Y') == \Carbon\Carbon::now()->format('d-m-Y'))

            <li class="time-label">
                  <span class="bg-green">
                    {{ \Carbon\Carbon::parse($items['created_at'])->format('d-m-Y') }}
                  </span>
            </li>

            @endif

          @if(\Carbon\Carbon::parse($items['created_at'])->format('d-m-Y') == \Carbon\Carbon::now()->subDays(1)->format('d-m-Y') || \Carbon\Carbon::parse($items['created_at'])->format('d-m-Y') == \Carbon\Carbon::now()->subDays(1)->format('d-m-Y'))
            <li class="time-label">
                  <span class="bg-blue">
                    {{ \Carbon\Carbon::parse($items['created_at'])->format('d-m-Y') }}
                  </span>
            </li>

            @endif
            
            @if($items['Type'] == 'Support Ticket')
            <li>
              <i class="fa fa-wrench bg-black"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{  $items['time'] }}</span>

                <h3 class="timeline-header no-border"><a href="#">Ticket de Soporte creado</a> 
                	{{ $items['created_at'] }}
                 <br/>
                	
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

                <h3 class="timeline-header"><a href="#">{{ $items['Type'] }}</a>{{ $items['created_at'] }}</h3>

                <div class="timeline-body">
                  Take me to your leader!
                  Switzerland is small and neutral!
                  We are more like Germany, ambitious and misunderstood!
                </div>
                <div class="timeline-footer">
                  <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                </div>
              </div>
            </li>
            @endif

            @endforeach

            @endif
            <!-- END timeline item -->
            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
            
          </ul>

          </div>
        <!-- /.col -->

      </div>

 	</div>
 	
 	
@stop