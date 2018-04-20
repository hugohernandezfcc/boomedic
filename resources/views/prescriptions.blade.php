@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

@stop

@section('content')
	<div class="row">
        <div class="col-md-3">
        	
        	<a href="/" class="btn btn-secondary btn-block btn-flat margin-bottom">Generar receta</a>

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
		                <li class="active">
		                	<a href="#">
		                		<i class="fa fa-comments"></i> Comentarios <span class="label label-primary pull-right">0</span>
		                	</a>
		                </li>
		                <li>
		                	<a href="#">
		                		<i class="fa fa-calendar-minus-o"></i> Ultimos 7 días
		                	</a>
		                </li>
		                <li>
		                	<a href="#">
		                		<i class="fa fa-edit"></i> Todas las recetas
		                	</a>
		                </li>
		            </ul>
		        </div>
		    </div>


		</div>
		<div class="col-md-9">

			<div class="box" id="{{$information}}" style="display: block;">
			  	<div class="box-header with-border">
				    <h3 class="box-title">Solicitudes de información</h3>
			  	</div>
			  	<div class="box-body">
			  		<ul class="nav nav-stacked">
						<li><a >Hugo hernández </a></li>
						<li><a >Hugo hernández </a></li>
						<li><a >Hugo hernández </a></li>
						<li><a >Hugo hernández </a></li>
						<li><a >Hugo hernández </a></li>
						<li><a >Hugo hernández </a></li>
						<li><a >Hugo hernández </a></li>
						<li><a >Hugo hernández </a></li>
						<li><a >Hugo hernández </a></li>
					</ul>
				</div>
			</div>

		</div>
	</div>


@stop