@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

@stop

@section('content')

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.textcomplete/1.8.4/jquery.textcomplete.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.js"></script>

	<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-steps/jquery.steps.css') }}">

	<div class="row">
        <div class="col-md-3">
        	
        	<a class="btn btn-secondary btn-block btn-flat margin-bottom" data-toggle="modal" onclick="loadMedicines();" data-target="#prescription-form-modal">Generar receta </a>
        	@include('attentions.prescriptionsform', ['isMobile' => $isMobile])

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
		                		<i class="fa fa-edit"></i> Todas las recetas
		                	</a>
		                </li>
		                <li >
		                	<a href="#">
		                		<i class="fa fa-comments"></i> Comentarios <span class="label label-primary pull-right">0</span>
		                	</a>
		                </li>
		                <li>
		                	<a href="#">
		                		<i class="fa fa-calendar-minus-o"></i> Ultimos 7 días
		                	</a>
		                </li>
		                <li >
		                	<a href="{{ url('prescriptions/settings') }}">
		                		<i class="fa fa-cog"></i> Configurar formato
		                	</a>
		                </li>
		            </ul>
		        </div>
		    </div>

		</div>
		<div class="col-md-9">


    <div id="example-basic">
        <h3>Effects</h3>
        <section>
            <p>Wonderful transition effects.</p>
        </section>
        <h3>Pager</h3>
        <section>
            <p>The next and previous buttons help you to navigate through your content.</p>
        </section>
    </div>

	<script type="text/javascript">
		

	    $("#example-basic").steps({
	        headerTag: "h3",
	        bodyTag: "section",
	        transitionEffect: "slideLeft",
	        cssClass: "wizard",
	        autoFocus: true
	    });


	</script>
			<div class="box" >
			  	<div class="box-header with-border">
				    <h3 class="box-title">Solicitudes de información</h3>
			  	</div>
			  	<div class="box-body">
			  		<ul class="nav nav-stacked">
						<li><a > Hugo hernández </a></li>
						<li><a > Hugo hernández </a></li>
						<li><a > Hugo hernández </a></li>
						<li><a > Hugo hernández </a></li>
						<li><a > Hugo hernández </a></li>
						<li><a > Hugo hernández </a></li>
						<li><a > Hugo hernández </a></li>
						<li><a > Hugo hernández </a></li>
						<li><a > Hugo hernández </a></li>
					</ul>
				</div>
			</div>

		</div>
	</div>


@stop