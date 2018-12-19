@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')
    <section class="content">

      	<div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-default">
            <div class="box-body box-profile">
              	<img class="profile-user-img img-responsive img-circle" src="https://s3.amazonaws.com/abiliasf/profile-42914_640.png" alt="User profile picture">

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
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
                B.S. in Computer Science from the University of Tennessee at Knoxville
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted">Malibu, California</p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

              <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-default">Node.js</span>
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
