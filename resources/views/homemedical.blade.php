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
				          	<span class="info-box-text">{{$cite->firstname}} {{$cite->lastname}}</span>
				          	<span class="info-box-number">{{$cite->age}} de edad</span>
				          	<div class="progress">
				            	<div class="progress-bar" style="width: 20%"></div>
				          	</div>
				          	<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				        </div>
				    </div>
				    <br/>
			    @endforeach
		    </div>
		</div>
		<div class="col-sm-8">

		</div>
	</div>

    <script type="text/javascript">
    	$(function () {
            $('select').select2({
                width: "100%",
            });

            var height;
			height = window.screen.availHeight;
			height = window.screen.availHeight-315;
			document.getElementById('listMedicalAppointment').setAttribute("style","height:" + height + "px;overflow-y: auto;");

         });
    </script>
	
@stop