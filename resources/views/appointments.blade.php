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
                    <span class="info-box-icon bg-black"><i class="fa fa-calendar"></i></span>
                      <div class="info-box-content">
                        <b>{{ $app->workplace}}</b><br/>
                       <span class="text-black">{{ $app->country }}, {{ $app->state }}, {{ $app->colony }}, {{ $app->delegation }}, {{ $app->street }} {{ $app->streetNumber }}. CP: {{ $app->postalcode }}</span><a href = "{{ url('doctor/delete') }}/{{ $labor->id }}" class="btn" onclick ="return confirm('¿Seguro desea eliminar esta cita?')"><i class="fa fa-trash text-muted"></i></a>
                                  
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4" style="padding-right: 0; padding-left: 0;">
              <img border="0" src="//maps.googleapis.com/maps/api/staticmap?center={{ $app->latitude }},{{ $app->longitude }}&amp;zoom=15&amp;size=400x90&amp;key=AIzaSyCKh6YcZQgwbcbUBCftcAQq7rfL5bLW_6g" alt="ubicación"  style="width:100%; "> 
              </div></div>  <br/>    
      
      @endforeach
      <div class="col-sm-6">&nbsp;</div>
                <div class="col-sm-6">
                    <a href="{{ url('/medicalconsultations') }}" class="btn btn-secondary btn-block btn-flat">
                            Volver al inicio
                        </a>
                      </div>
    </div>

 	
@stop