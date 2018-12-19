@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

	<style type="text/css">
		.dropzone {
		     min-height: 10px !important; 
		    border-style: dotted  !important;
		    /* background: white; */
		     padding: 0 !important;
		}
		.dropzone .dz-message {
		    margin: 1em 0 !important;
		}
		.modal-content-2 {
		    position: relative;
		    background-color: transparent;
		    -webkit-background-clip: padding-box;
		    background-clip: padding-box;
		    color: white;
		    margin-top: 50%;
		    width: 100%;

		}
	    #mapAddressUser{
	        position: relative;
	        width: 95%;
	        z-index: 30;
	    }

		.cut{
		  text-overflow:ellipsis;
		  white-space:nowrap; 
		  overflow:hidden; 
		}
	</style>

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
	<script type="text/javascript">

			Dropzone.options.myAwesomeDropzone = { 
			 
			 // set following configuration
			 	paramName: "file",
			    maxFiles: 1,
			    acceptedFiles: "image/*",
			    addRemoveLinks: true,
			    dictRemoveFile: "Eliminar",
			    dictCancelUpload: "Cancel",
			    dictDefaultMessage: "Arraste y suelte una nueva foto de perfil...",
			     success: function(file, response){
				        //alert(response);
				 $('#loadingmodal').modal({backdrop: 'static', keyboard: false})
				  setTimeout(function(){ 
				  	$('#loadingmodal').modal('toggle');
				  	window.location.reload(true);
				  },21000);
				     	}
			    //autoProcessQueue : false 
			 };
			 var val = "@php echo session()->get('val'); @endphp";
			 		if(val == "true"){

			 		setTimeout(function() {
			 			$('#modal').modal({backdrop: 'static', keyboard: false})
					}, 1000);	
				}

				    
	</script>



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
                <span class="label label-info">{{$current_prescription}}</span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Mimebro desde</strong>
              <p>{{$created_at}}</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        	<div class="col-md-9">
        		<div class="nav-tabs-custom">
		            <ul class="nav nav-tabs">
		              	<li class="active"><a href="#activity" data-toggle="tab">Detalle</a></li>
		              	<li><a href="#family" data-toggle="tab">Familia</a></li>
		              	<li><a href="#address" data-toggle="tab">Dirección</a></li>
		            </ul>
		            <div class="tab-content">
		         	    <div class="active tab-pane" id="activity">
		         	    	
		         	    	<div class="row">
                          
	                            <div class="col-sm-2" align="left"><b>Correo:</b></div>
	                            <div class="col-sm-10 cut" align="left">{{ $email }}</div>
	                         
	                        </div>
	                        <div class="row">
	                          
	                            <div class="col-sm-2" align="left"><b>Nombre de usuario:</b></div>
	                            <div class="col-sm-10 cut" align="left">{{ $username }}</div>
	                         
	                        </div>
	                        <div class="row">
	                          
	                            <div class="col-sm-2" align="left"><b>Edad:</b></div>
	                            <div class="col-sm-10" align="left">{{ $age }}</div>
	                         
	                        </div>
	                        <div class="row">
	                         
	                            <div class="col-sm-2" align="left"><b>Ocupación:</b></div>
	                            <div class="col-sm-10 cut" align="left">{{ $occupation }}</div>
	                         
	                        </div>
	                        <div class="row">
	                        
	                            <div class="col-sm-2" align="left"><b>Genero:</b></div>
	                            @if($gender == "female")
	                            	<div class="col-sm-10" align="left">{{ trans('adminlte::adminlte.female') }}</div>
	                            @endif
	                            @if($gender == "male")
	                            	<div class="col-sm-10" align="left">{{ trans('adminlte::adminlte.male') }}</div>
	                            @endif
	                            @if($gender == "other")
	                            	<div class="col-sm-10" align="left">{{ trans('adminlte::adminlte.other') }}</div>
	                            @endif
	                      
	                        </div>
	                        <div class="row">
	                         
	                            <div class="col-sm-2" align="left"><b>Escolaridad:</b></div>
	                            <div class="col-sm-10 cut" align="left">{{ $scholarship }}</div>
	                    
	                        </div>
	                        <div class="row">
	                         
	                            <div class="col-sm-2" align="left"><b>Estado civil:</b></div>
	                              @if($maritalstatus == "single")
	                            <div class="col-sm-10" align="left">{{ trans('adminlte::adminlte.single') }}</div>
	                             @endif
	                            @if($maritalstatus == "married")
	                            <div class="col-sm-10" align="left">{{ trans('adminlte::adminlte.married') }}</div>
	                             @endif	
	                      
	                        </div>
	                        <div class="row">
	                        
	                            <div class="col-sm-2" align="left"><b># Móvil:</b></div>
	                            <div class="col-sm-10 cut" align="left">{{ $mobile }}</div>
	                       
	                        </div>
	                        <div class="row">
	                        
	                            <div class="col-sm-2" align="left"><b>Ultima modificación:</b></div>
	                            <div class="col-sm-10 cut" align="left">{{ $updated_at }}</div>
	                        </div>
		         	    </div>
		         	    <div class="tab-pane" id="family">
		         	    	
		         	    	<!--button modal to add more family members-->
		         	    	<div class="lockscreen-item pull-right" style="width: 210px !important;">
						      	<div class="input-group">
						        	<div class="form-control" align="center"><label id="labeltext">Agregar Familiar</label></div>
						        	<div class="input-group-btn">
							          	<a class="btn btn-default" data-toggle="modal" data-target="#modalfamily">
							          		<i class="fa fa-plus text-muted"></i>
							          	</a>
						        	</div>
						      	</div>
							</div>
							<!--button modal to add more family members-->

	                    	<div id="demo"></div>
	                    	@include('modals.addFamilyMember')

		         	    </div>
		         	    <div class="tab-pane" id="address">Settings123</div>
		         	</div>
		        </div>
        	</div>
    	</div>
    </section>
@stop
