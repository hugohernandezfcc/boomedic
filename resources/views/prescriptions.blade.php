@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

@stop

@section('content')

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.textcomplete/1.8.4/jquery.textcomplete.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.js"></script>

	<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-steps/jquery.steps.css') }}">


	<div class="row">
		<!-- /.col -->
        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                <img class="img-circle" src="https://s3.amazonaws.com/boomedic/2.jpg?03:36" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">Nadia Carmichael</h3>
              <h5 class="widget-user-desc">Lead Developer</h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#">Projects <span class="pull-right badge bg-blue">31</span></a></li>
                <li><a href="#">Tasks <span class="pull-right badge bg-aqua">5</span></a></li>
                <li><a href="#">Completed Projects <span class="pull-right badge bg-green">12</span></a></li>
                <li><a href="#">Followers <span class="pull-right badge bg-red">842</span></a></li>
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
	</div>


	<div class="row">
        <div class="col-md-3">
        	
        	<a class="btn btn-secondary btn-block btn-flat margin-bottom" data-toggle="modal" onclick="loadMedicines();" data-target="#prescription-form-modal">Generar receta </a>
        	@include('attentions.prescriptionsform', ['isMobile' => $isMobile, 'medAppointments' => $medAppointments])

        	@if($isMobile)
				<div class="box box-solid collapsed-box">
			@else
				<div class="box box-solid">
			@endif

		        <div class="box-header with-border">
		            <h3 class="box-title">Opciones</h3>

		            <div class="box-tools">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse">
		                	@if($isMobile)
								<i class="fa fa-plus"></i>
							@else
		                		<i class="fa fa-minus"></i>
							@endif
		                </button>
		            </div>
		        </div>
		        <div class="box-body no-padding">
		            <ul class="nav nav-pills nav-stacked">
		                <li id="allOption" class="active">
		                	<a href="#">
		                		<i class="fa fa-edit"></i> Todas las recetas
		                	</a>
		                </li>
		                <li id="commentOption" >
		                	<a onclick="markerOption('commentOption');">
		                		<i class="fa fa-comments"></i> Comentarios <span class="label label-primary pull-right">0</span>
		                	</a>
		                </li>
		                <li id="lastSevenOption">
		                	<a href="#">
		                		<i class="fa fa-calendar-minus-o"></i> Ultimos 7 días
		                	</a>
		                </li>
		                <li id="settingOption" >
		                	@if(count($prescriptionsList) < 1)
		                	
		                		<a onclick="markerOption('settingOption');">
			                		<i class="fa fa-cog"></i> Configurar formato
			                	</a>

		                	@else
			                	<a href="{{ url('prescriptions/settings') }}">
			                		<i class="fa fa-cog"></i> Configurar formato
			                	</a>
							@endif
		                </li>
		            </ul>
		        </div>
		    </div>

		    <script type="text/javascript">
		    	
		    	/**
		    	 * Function responsable of change class name to DOM element. It with the objective
		    	 * @param  {[type]} currentOption [description]
		    	 * @return {[type]}               [description]
		    	 */
		    	function markerOption(currentOption) {
		    		var options = [ 'allOption', 'commentOption', 'lastSevenOption', 'settingOption'];
					for (var i = options.length - 1; i >= 0; i--) 
						if (options[i] == currentOption) 
							byId(options[i]).className = "active";
						else			
							byId(options[i]).removeAttribute('class');
		    	}
		    </script>
			
			
			

		</div>
		<div class="col-md-9">

			<div class="box" >
			  	<div class="box-header with-border">
				    <h3 class="box-title">Solicitudes de información</h3>
			  	</div>
			  	<div class="box-body">
			  		<ul class="nav nav-stacked">

			  			@if(count($prescriptionsList) < 1)
			  				@include('empty.notContent', 
			  					[
			  						'indicator' => 'NOT_DATA_LIST',
			  						'title'		=> 'Recetas'
			  					]
			  				)
			  			@else
			  				<li><a> Hugo hernández </a></li>
			  			@endif
						
					</ul>
				</div>
			</div>

		</div>
	</div>


@stop