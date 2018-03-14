@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

@stop

@section('content')
	

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

          	<div class="info-box bg-green">
		        <span class="info-box-icon">
		        	<i class="ion ion-ios-heart-outline"></i>
		        </span>

		        <div class="info-box-content">
		          <span class="info-box-text">Mentions</span>
		          <span class="info-box-number">92,050</span>

		          <div class="progress">
		            <div class="progress-bar" style="width: 20%"></div>
		          </div>
		          <span class="progress-description">
		                20% Increase in 30 Days
		              </span>
		        </div>
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
         });
    </script>
	
@stop