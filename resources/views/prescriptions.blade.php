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
		                	<i class="fa fa-minus"></i>
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
		                		<i class="fa fa-edit"></i> Todo
		                	</a>
		                </li>
		            </ul>
		        </div>
		    </div>


		</div>
		<div class="col-md-9">

			djoasdjfoaisdffjaosidfjisdf

		</div>
	</div>


@stop