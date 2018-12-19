@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')
    <section class="content">

      	<div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-default">
            <div class="box-body box-profile">

            	@if($photo == '')
		    	 		<img class="profile-user-img img-responsive img-circle" src="https://s3.amazonaws.com/abiliasf/profile-42914_640.png" alt="User Image"  style="width:150px; height: 150px;">
					@else
						@php 
						  $imagen = getimagesize($photo);    //Sacamos la información
				          $width = $imagen[0];              //Ancho
				          $height = $imagen[1];  

				          if($height > '500' || $width > '500'){
				            $height = $height / 2.8;
				            $width = $width / 2.8;
				        }
				        if($height > '800' || $width > '800'){
				            $height = $height / 4;
				            $width = $width / 4;
				        }
				      if($height > '800' || $width > '1200'){
				            $height = $height / 6;
				            $width = $width / 6;
				        }


				          if($height < '400' || $width < '400'){
				            $height = $height / 1.6;
				            $width = $width / 1.6;
				        }

						@endphp
						<img class="profile-user-img img-responsive img-circle" src="{{ $photo }}?{{ \Carbon\Carbon::now()->format('h:i') }}" style="width:{{ $width }}px; height: {{ $height }}px;" >			
			    	@endif 

              	

              	<h3 class="profile-username text-center">{{ $firstname }}</h3>

              	@if($gender == "female")
              		<p class="text-muted text-center">{{ trans('adminlte::adminlte.female') }}</p>
	            @endif
	            @if($gender == "male")
	            	<p class="text-muted text-center">{{ trans('adminlte::adminlte.male') }}</p>
	            @endif
	            @if($gender == "other")
	            	<p class="text-muted text-center">{{ trans('adminlte::adminlte.other') }}</p>
	            @endif

              

	            <ul class="list-group list-group-unbordered">
	                <li class="list-group-item">
	                 	<b>Familiares</b> <a class="pull-right">2</a>
	                </li>
	                <li class="list-group-item">
	                  	<b>No. de citas</b> <a class="pull-right">1</a>
	                </li>
	                <li class="list-group-item">
	                  	<b>No. métodos de pago</b> <a class="pull-right">5</a>
	                </li>
	            </ul>

              <a href="#" class="btn btn-secondary btn-block btn-flat"><b>Proximas citas</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Información adicional</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Educación</strong>

              <p class="text-muted">
              	@if(empty($scholarship) && empty($occupation))
                	<a href="#">Agregar información</a>
                @elseif(empty($scholarship) && !empty($occupation))
                	<a href="#">Agregar Escolaridad</a> / {{ $occupation }}
                @elseif(!empty($scholarship) && empty($occupation))
                	{{ $scholarship }} / <a href="#">Agregar ocupación</a>
                @endif
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Dirección</strong>
 
              	<p class="text-muted">
	              	@if(empty($colony) && empty($state))
	                	<a href="#">Agregar dirección</a>
	                @elseif(empty($colony) && !empty($state))
	                	<a href="#">Agregar colonia</a>, {{$state}} {{$country}}
	                @elseif(!empty($colony) && empty($state))
	                	{{ $colony }}, <a href="#">Agregar estado</a> {{$country}}
	                @endif
				</p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Prescripción médica actual</strong>

              <p>
                <span class="label label-info">TBD</span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        	<div class="col-md-9">
        		hugo
        	</div>
    	</div>
    </section>
@stop
