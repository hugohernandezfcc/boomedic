@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')
<style type="text/css">
	.direct-chat-messages {
    height: 300px;
		}
</style>
@stop

@section('content')
	<div class="row">
        <div class="col-lg-3 col-xs-6">
          	<div class="small-box bg-aqua">
	            <div class="inner">
	              	<h3>150</h3>
	              	<p>Proximas citas</p>
	            </div>
	            <div class="icon">
	              	<i class="fa fa-calendar"></i>
	            </div>
	            <a class="small-box-footer">Detalles <i class="fa fa-arrow-circle-right"></i></a>
          	</div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          	<div class="small-box bg-green">
            	<div class="inner">
              		<h3>53<sup style="font-size: 20px">%</sup></h3>
              		<p>Saldos</p>
            	</div>
            	<div class="icon">
              		<i class="ion ion-stats-bars"></i>
            	</div>
            	<a class="small-box-footer">Detalles <i class="fa fa-arrow-circle-right"></i></a>
          	</div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          	<div class="small-box bg-primary">
            	<div class="inner">
              		<h3>44</h3>
              		<p>Expedientes</p>
            	</div>
            	<div class="icon">
              		<i class="ion ion-person-add"></i>
            	</div>
            	<a class="small-box-footer">Detalles <i class="fa fa-arrow-circle-right"></i></a>
          	</div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          	<div class="small-box bg-teal">
            	<div class="inner">
              		<h3>44</h3>
              		<p>Interacciones</p>
            	</div>
            	<div class="icon">
              		<i class="fa fa-comments"></i>
            	</div>
            	<a class="small-box-footer">Detalles <i class="fa fa-arrow-circle-right"></i></a>
          	</div>
        </div>
        <!-- ./col -->
      </div>
		      <div class="row">
			    <div class="col-lg-7">
		        	      @include('conversations.conversationform')
		        </div>
		      </div>  
     <script language="javascript">
    function open_appstore() {
        window.location='https://play.google.com/store';
    }

    function try_to_open_app() {
        setTimeout('open_appstore()', 300);
    }
</script>

<a onClick="javascript:try_to_open_app();" href="yourappurl:">App name</a> 

            <input type="button" class="btn btn-secondary" onClick="javascript:try_to_open_app();" href="boomedic://medicalconsultations" value="Boomedic app" />

<!-- 
	<style type="text/css">
		.info-box .progress .progress-bar {
		    background: #160404;
		}
		.info-box-icon > img {
		    max-width: 75%;
		}
		.bg-green, .callout.callout-success, .alert-success, .label-success, .modal-success .modal-body {
		    background-color: #b8d3c7 !important;
		}
	</style>
	<div>
		<div class="col-sm-4">
			<br/>
			<br/>
			<br/>
			<div class="info-box">
	            <span class="info-box-icon ">
	            	<i class="fa fa-calendar"></i>
	           	</span>
	            <div class="info-box-content">
	              <span class="info-box-text">Citas completadas</span>
	              <span class="info-box-number">32</span>
	            </div>
	            <!- /.info-box-content ->
	        </div>
	        <br/>
	          <div class="info-box">
	            <span class="info-box-icon bg-aqua">
	            	<i class="fa fa-money"></i>
	            </span>
	            <div class="info-box-content">
	              <span class="info-box-text">Saldos</span>
	              <span class="info-box-number">$8,700</span>
	            </div>
	            <!- /.info-box-content ->
	          </div>
	          <br/>
	          <div class="info-box">
	            <span class="info-box-icon bg-yellow">
	            	<i class="fa fa-h-square"></i>
	            </span>
	            <div class="info-box-content">
	              <span class="info-box-text">Expedientes</span>
	              <span class="info-box-number">19</span>
	            </div>
	            <!- /.info-box-content ->
	          </div>
	          <br/>
	          <div class="info-box">
	            <span class="info-box-icon bg-red">
	            	<i class="fa fa-calendar"></i>
	            </span>
	            <div class="info-box-content">
	              <span class="info-box-text">Citas canceladas</span>
	              <span class="info-box-number">7</span>
	            </div>
	            <!- /.info-box-content ->
	          </div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label for="selectWorkPlace" > Citas del día: </label>
            	<select class="form-control" name="selectWorkPlace" id="selectWorkPlace" size="1">
            	  	@foreach($workplaces as $workplace)
            	  		<option value="{{$workplace->id}}">{{$workplace->workplace}}</option>
            	  	@endforeach
            	</select>
          	</div>
          	<div id="listMedicalAppointment">
	          	@foreach($medAppoints as $cite)
		          	<div class="info-box ">
				        <span class="info-box-icon">
				        	<img src="{{$cite->profile_photo}}" class="img-circle" alt="User Image">
				        </span>
				        <div class="info-box-content">
				          	<span class="info-box-number">{{$cite->firstname}} {{$cite->lastname}}</span>
				          	<span class="info-box-text">{{$cite->age}} de edad / {{$cite->gender}}</span>
				          	<div class="progress">
				            	<div class="progress-bar" style="width: 20%"></div>
				          	</div>
				          	<a href="#" class="small-box-footer">Ver detalle <i class="fa fa-arrow-circle-right"></i></a>
				        </div>
				    </div>
				    <br/>
			    @endforeach
		    </div> 
		</div>
		<div class="col-sm-4">
			<div class="row">
				<div class="col-sm-9">
					<h3>5 Resultados recibidos</h3>
				</div>
				<div class="col-sm-3">
					<br/>
					<button type="button" class="btn btn-block btn-default">
						<i class="fa fa-refresh"></i>
					</button>
				</div>
			</div>
          	<div id="listMedicalExam">
	          	@foreach($medAppoints as $cite)
		          	<div class="info-box ">
				        <span class="info-box-icon bg-green">
				        	<img src="{{$cite->profile_photo}}" class="img-circle" alt="User Image">
				        </span>
				        <div class="info-box-content">
				          	<span class="info-box-text">Estudio de sangre</span>
				          	<span class="info-box-text">{{$cite->firstname}} {{$cite->lastname}} </span>
				          	<a href="#" class="small-box-footer">Ver detalle <i class="fa fa-arrow-circle-right"></i></a>
				        </div>
				    </div>
				    <br/>
				    @if($cite->firstname == "Rebbeca")
				    	@php break; @endphp
				    @endif
			    @endforeach
		    </div>
		</div>
	</div>
    <script type="text/javascript">
    	$(function () {
            $('select').select2({
                width: "100%",
            });
            var height;
			height = window.screen.availHeight;
			height = window.screen.availHeight-290;
			document.getElementById('listMedicalAppointment').setAttribute("style","height:" + height + "px;overflow-y: auto;");
			document.getElementById('listMedicalExam').setAttribute("style","height:" + height + "px;overflow-y: auto;");
         });
    </script> -->
	
@stop