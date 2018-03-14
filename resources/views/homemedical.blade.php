@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

@stop

@section('content')
	
	<style type="text/css">
		.info-box .progress .progress-bar {
		    background: #160404;
		}

		.info-box-icon > img {
		    max-width: 75%;
		}

	</style>

	<div>
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
				<div class="col-sm-10">
					<h2>5 Resultados recibidos</h2>
				</div>
				<div class="col-sm-2">
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
    </script>
	
@stop