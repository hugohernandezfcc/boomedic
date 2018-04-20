@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

@stop

@section('content')
	<div class="row">
        <div class="col-md-3">
        	
        	<a href="/" class="btn btn-secondary btn-block btn-flat margin-bottom">Crear</a>

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
		                		<i class="fa fa-envelope-o"></i> Sent
		                	</a>
		                </li>
		                <li>
		                	<a href="#">
		                		<i class="fa fa-envelope-o"></i> Sent
		                	</a>
		                </li>
		                <li>
		                	<a href="#">
		                		<i class="fa fa-file-text-o"></i> Drafts
		                	</a>
		                </li>
		                <li>
		                	<a href="#">
		                		<i class="fa fa-filter"></i> Junk <span class="label label-warning pull-right">65</span>
		                	</a>
		                </li>
		                <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>
		            </ul>
		        </div>
		    </div>


		</div>
		<div class="col-md-9">

			djoasdjfoaisdffjaosidfjisdf

		</div>
	</div>


@stop