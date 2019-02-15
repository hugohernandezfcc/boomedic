@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

<style type="text/css">

.content{
    overflow-y: auto;
  }

  .timeline>li {
    margin-right: 0 !important;
}

.timeline>li>.timeline-item {
   margin-right: 0 !important;
}
</style>

@stop

@section('content')

  	<div class="box-header">
	    <h3 class="box-title">Citas registradas</h3>
  	</div>


  	<div class="box-body">

              @foreach($app->sortBy('when') as $app)  
              
                <div class="form-group">
                  <div class="col-sm-8" style="padding-right: 0; padding-left: 0;">
                    @if($app->status == 'Registered')
                        <div class="info-box bg-gray">
                        <div class="info-box-icon-2"><img src="{{ $app->profile_photo }}" class="img-circle" alt="User Image" style="height: 55px;"><br/>Dr. {{ $app->name }}</div>
                          <div class="info-box-content">
                            <b>Asistir {{ \Carbon\Carbon::parse($app->when)->format('d-m-Y h:i A') }}</b><br/>
                           Especialidad: {{ $app->specialty }}<br/>
                           Lugar: {{ $app->workplace}}<br/>
                           Dirección: {{ $app->country }}, {{ $app->state }}, {{ $app->colony }}, {{ $app->delegation }}, {{ $app->street }} {{ $app->streetNumber }}. CP: {{ $app->postalcode }}
                          </div>
                        </div>
                    @else
                       <div class="info-box bg-red">
                        <div class="info-box-icon-2"><img src="{{ $app->profile_photo }}" class="img-circle" alt="User Image" style="height: 55px;"><br/>Dr. {{ $app->name }}</div>
                          <div class="info-box-content">
                            <b>Asistir {{ \Carbon\Carbon::parse($app->when)->format('d-m-Y h:i A') }}</b><br/>
                           Especialidad: {{ $app->specialty }}<br/>
                           Lugar: {{ $app->workplace}}<br/>
                           Dirección: {{ $app->country }}, {{ $app->state }}, {{ $app->colony }}, {{ $app->delegation }}, {{ $app->street }} {{ $app->streetNumber }}. CP: {{ $app->postalcode }}
                          </div>
                        </div>
                    @endif    
                      </div>
                      <div class="col-sm-4" style="padding-right: 0; padding-left: 0;">
                  <img border="0" src="//maps.googleapis.com/maps/api/staticmap?center={{ $app->latitude }},{{ $app->longitude }}&amp;markers=color:black%7Clabel:%7C{{ $app->latitude }},{{ $app->longitude }}&amp;zoom=15&amp;size=400x90&amp;key={{ env('GOOGLE_KEY') }}" alt="ubicación"  style="width:100%; height: 91px;"> 
                  </div></div>  
      
          @endforeach
                <br/>
                <div class="pull-right">
                    <a href="{{ url('/medicalconsultations') }}" class="btn btn-secondary btn-block btn-flat">
                            Volver al inicio
                        </a>
                      </div>
    </div>

 	
@stop