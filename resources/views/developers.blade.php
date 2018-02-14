@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

@stop

@section('content')
<style type="text/css">

.modal-headerD, .closeD {
          color:black;
          text-align: center;
          font-size: 100%;
          font-weight: bold;
      }
</style>
<br/>

<div class="lockscreen-item" style="margin: 10px 0 30px auto;">
	<div class="input-group">
	    <div class="form-control" align="center"><label id="labeltext">Agregar</label></div>
	    <div class="input-group-btn" id="div_profile2">
		<button class="btn btn-default" type="button" data-toggle="modal" data-target="#modalAddApp">
		    <i class="fa fa-plus text-muted" id="i_button2"></i>
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

            <div id="AddClient" class="modal fade" role="dialog" style="display: none;">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">   
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <label>Prueba de Modal</label>
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

        <div class="modal fade" id="modalAddApp" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Nueva App</h4>
              </div>
              <div class="modal-body">
               <div class="label-group">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Estacionamiento">
                      Estacionamiento
                    </label>
                  </div>

                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Ambulancias">
                      Ambulancias
                    </label>
                  </div>

                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Cafetería">
                      Cafetería
                    </label>
                  </div>
                 <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Elevador">
                     Elevador
                    </label>
                  </div>
                   <div class="checkbox">
                    <label>
                      <input type="checkbox" name="Wifi">
                     Wifi
                    </label>
                  </div>
                </div>
              </div>
             
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><i class="fa fa-check"></i></button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>	
@stop