@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

<style type="text/css">

.content{
    overflow-y: auto;
    height: 600px;
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

              @foreach($app->sortByDesc('created_at') as $app)  
      
            <div class="form-group">
              <div class="col-sm-8" style="padding-right: 0; padding-left: 0;">
                    <div class="info-box bg-gray">
                    <div class="info-box-icon-2"><img src="{{ $app->profile_photo }}" class="img-circle" alt="User Image" style="height: 55px;"><br/>Dr. {{ $app->name }}</div>
                      <div class="info-box-content">
                        <b>Asignada {{ \Carbon\Carbon::parse($app->when)->format('d-m-Y h:i A') }}</b><br/>
                       Especialidad: {{ $app->specialty }}<br/>
                       Lugar: {{ $app->workplace}}<br/>
                       Dirección: {{ $app->country }}, {{ $app->state }}, {{ $app->colony }}, {{ $app->delegation }}, {{ $app->street }} {{ $app->streetNumber }}. CP: {{ $app->postalcode }}
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4" style="padding-right: 0; padding-left: 0;">
              <img border="0" src="//maps.googleapis.com/maps/api/staticmap?center={{ $app->latitude }},{{ $app->longitude }}&amp;zoom=15&amp;size=400x90&amp;key=AIzaSyCKh6YcZQgwbcbUBCftcAQq7rfL5bLW_6g" alt="ubicación"  style="width:100%;"> 
              </div></div>  <br/>    
      
      @endforeach
      <div class="form-group">
      <div class="col-sm-6">&nbsp;</div>
                <div class="col-sm-6 pull-right">
                    <a href="{{ url('/medicalconsultations') }}" class="btn btn-secondary btn-block btn-flat">
                            Volver al inicio
                        </a>
                      </div>
                    </div>
    </div>

 	
@stop