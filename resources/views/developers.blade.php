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
	                <!--<tfoot>
	                    <tr>
	                    	<th>Nombre</th>
	                        <th>Id de Cliente </th>
	                        <th>Cliente Secreto </th>
	                        <th>Url de Redireccionamiento</th>
	                        <th> - </th>
	                    </tr>
	                </tfoot>-->
	                <tbody>
	                	@if(!is_null($clients))
	                	@foreach ($clients as $client)
	                        <tr>
	                            <td>{{ $client->name }}</td>
	                            <td align="center">{{ $client->id }}</td>
	                            <td>{{ $client->secret }}</td>
	                            <td>{{ $client->redirect }}</td>

	                            <td align="center">
	                            <div class="input-group-btn">
		          				<!-- Delete button that goes to a destroy type driver for the user to delete badly entered payment methods or that he no longer wants to have 
		          					href = 'delete/{{ $client->id }}' onclick ="return confirm('¿Seguro desea eliminar este método de pago?')"-->
			          				<a class="btn" >
			          				<i class="fa fa-trash text-muted"></i>
			          				</a>
	        					</div>
	        					</td>
	                        </tr>
	                	@endforeach
	                	@endif
	                </tbody>
	                
	                
	    </table><br/><br/>


	</div>

	<!--Modal Crear nuevo cliente-->
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
              		<form class="form-horizontal" role="form" id="form-direction" method="post" action="CreateApp">
	              		<div class="input-group input-group-sm">
	              			<div class="col-sm-5">
	              				<label>Nombre de la Aplicación:</label>
	                        </div>
	                        <div class="col-sm-7">
	                        	<input id="appName" name="appName" type="textbox" class="form-control"><br/><br/>
	                    	</div>
	                    	<div class="col-sm-5">
	                        	<label>URL de Redireccionamiento:</label>
	                    	</div>
	                    	<div class="col-sm-7">
	                    		<input id="appURL" name="appURL" type="textbox" class="form-control">
	                    	</div>
		                    <div style="text-align: right; margin-top:5px" class="col-sm-12">
		                		<button type="submit" class="btn btn-secondary pull-right" data-dismiss="modal">
		                			Guardar
		                		</button>
		                	</div>
	                	</div>
                    </form>
              	</div>
             
            </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
    </div>

@stop