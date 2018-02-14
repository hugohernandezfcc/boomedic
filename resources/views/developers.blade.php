@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

@stop

@section('content')
<style type="text/css">

.modal-header, h4, .close {
          color:black;
          text-align: center;
          font-size: 100%;
          font-weight: bold;
      }
</style>
<br/>

<div class="lockscreen-item" style="margin: 10px 0 30px auto;">

	    <!-- lockscreen credentials (contains the form) -->
	    <div class="lockscreen-credentials">
	      	<div class="input-group">
	        	<div class="form-control" align="left"><label id="labeltext">Agregar</label></div>
	        	<div class="input-group-btn" id="div_profile">
		          	<button class="btn btn-default" type="button" data-toggle="modal" data-target="#modalAddApp">
		    			<i class="fa fa-plus text-muted" ></i>
					</button>
	        	</div>
	      	</div>
	    </div>
	    <!-- /.lockscreen credentials -->
</div>

<div class="box">
  	<div class="box-header with-border">
	    <h3 class="box-title">Desarrolladores</h3>
  	</div>
  	<div class="box-body">
	  
	  	<div class="alert alert-info">
		    <i class="icon fa fa-info"></i>Aqui puedes crear tus Applicaciones para poder utilizar nuestra API mediante su Id de cliente y cliente secreto que se proporcionan a continuación. Recuerde consultar nuestra documentación para poder realizar su integración.
		</div>

		<table id="ClientsApi" class="table table-bordered table-striped" cellspacing="0" width="100%">
	                <thead>
	                    <tr>
	                    	<th>Nombre</th>
	                        <th>Id de Cliente </th>
	                        <th>Cliente Secreto </th>
	                        <th>Url de Redireccionamiento</th>
	                        <th> - </th>
	                    </tr>
	                </thead>
	                
	                
	    </table><br/><br/>


	</div>


    <div class="modal fade" id="modalAddApp" style="display: none;">
        <div class="modal-dialog">
           	<div class="modal-content">
              	<div class="modal-header">
              		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    	<span aria-hidden="true">&times;</span>
                	</button>
                	<h4 class="modal-title">Nueva App</h4>
              	</div>
              	<div class="modal-body">
              		<div class="input-group input-group-sm">
              			<div class="col-sm-5">
              				<label>Nombre de la Aplicación:</label>
                        </div>
                        <div class="col-sm-7">
                        	<input id="appName" type="textbox" class="form-control">
                    	</div>
                    	<div class="col-sm-5">
                        	<label>URL de Redireccionamiento:</label>
                    	</div>
                    	<div class="col-sm-7">
                    		<input id="appURL" type="textbox" class="form-control">
                    	</div>
                    </div>
              	</div>
             
              	<div class="modal-footer">
                	<button type="button" class="btn btn-default pull-right" data-dismiss="modal">
                		Guardar
                	</button>
              	</div>
            </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
    </div>	
@stop