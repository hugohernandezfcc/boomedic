@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

@stop

@section('content')
<style type="text/css">

.modal-headerD, h4, .close {
          color:black;
          text-align: center;
          font-size: 100%;
          font-weight: bold;
      }
</style>
<br/>

<div class="lockscreen-item" style="margin: 10px 0 30px auto;">
	<div class="input-group">
	    <div class="form-control" align="left"><label id="labeltext">Agregar</label></div>
	    <div class="input-group-btn" id="div_profile2">
		<button class="btn btn-default btn-circle" type="button">
		    <i class="fa fa-plus text-muted" id="i_button2" data-target="#AddClient"></i>
		</button>
	   	</div>
	</div>
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

	<!-- Modal Busqueda por lugar -->

            <div id="AddClient" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-headerD">   
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <label for="Busqueda">Prueba de Modal</label>
                  </div>
                  <!--<div class="modal-body">
                        <div class="input-group input-group-sm">
                          <input id="address" type="textbox" value="" class="form-control">
                          <span class="input-group-btn">
                          <input id="submit" type="button" class="btn btn-secondary btn-block btn-flat" value="Buscar"></span>
                       </div>
                            <br/>                    
                          <div id ="ubi" class="input-group input-group-sm" style="display:none">
                          <input id="ubication" type="button" class="btn btn-secondary btn-block btn-flat" value="Volver a ubicación" onclick="initMap()">
                          </div>
                  </div>-->
                </div>
              </div>
            </div>  	
@stop