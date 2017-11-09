@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

@stop

@section('content')
   


    <br/>


	<div class="lockscreen-item" style="margin: 10px 0 30px auto;">
	    <!-- lockscreen image -->
	    <div class="lockscreen-image">
	      <img src="https://adminlte.io/themes/AdminLTE/dist/img/user1-128x128.jpg" alt="User Image">
	    </div>
	    <!-- /.lockscreen-image -->

	    <!-- lockscreen credentials (contains the form) -->
	    <form class="lockscreen-credentials" action="create" method="get">
	    	{{ csrf_field() }}
	      	<div class="input-group">
	        	<div class="form-control">{{ $username }}</div>
	        	<input type="hidden" name="id" value="{{ $userId }}">

	      	</div>
	    </form>
	    <!-- /.lockscreen credentials -->
	</div>

	<div class="box">
	  	<div class="box-header with-border">
		    <h3 class="box-title">Facturar servicios</h3>
	  	</div><br/>
	  	<div class="box-header with-border"  style="text-align: center;">
		    <h3 class="box-title">Datos del Receptor</h3>
	  	</div>
		<div class="box-body">

            
            @if($mode == 'Index')
            	<form id="FOO" method="POST" action="PDFBilling" target="_blank">
            	
               		<div class="row">
	                  	<label class="col-sm-2 control-label">Razón Social</label>
		 					<div class="col-sm-4">
		                  		<input type="text" name="businessName" class="form-control" id="businessName">
		                	</div>
	                  	     	<label class="col-sm-1 control-label">RFC</label>
	                  	
		 					<div class="col-sm-2">
		                  		<input type="text" name="RFC" class="form-control" id="RFC">
		                	</div>
		                	 	<label class="col-sm-1 control-label">País</label>
		 					<div class="col-sm-2">
		                  		<input type="text" name="Country" class="form-control" id="Country">
		                	</div>
	                  	</div><br/>
	                  	      		<div class="row">
	                  	<label class="col-sm-2 control-label">Código Postal</label>
		 					<div class="col-sm-1">
		                  		<input type="text" name="PostalCode" class="form-control" id="PostalCode">
		                	</div>
	                  	     	<label class="col-sm-1 control-label">Estado</label>
	                  	
		 					<div class="col-sm-2">
		                  		<input type="text" name="state" class="form-control" id="state">
		                	</div>
		                	 	<label class="col-sm-1 control-label">Municipio</label>
		 					<div class="col-sm-2">
		                  		<input type="text" name="municipality" class="form-control" id="municipality">
		                	</div>
		                	 	<label class="col-sm-1 control-label">Calle</label>
		 					<div class="col-sm-2">
		                  		<input type="text" name="street" class="form-control" id="street">
		                	</div>
	                  	</div><br/>
	                  	      		<div class="row">
	                  	<label class="col-sm-2 control-label">Colonia</label>
		 					<div class="col-sm-3">
		                  		<input type="text" name="colony" class="form-control" id="colony">
		                	</div>
	                  	     	<label class="col-sm-1 control-label">No Interior</label>
		 					<div class="col-sm-2">
		                  		<input type="text" name="noIn" class="form-control" id="noIn">
		                	</div>
		                	 	<label class="col-sm-1 control-label">No Exterior</label>
		 					<div class="col-sm-2">
		                  		<input type="text" name="noExt" class="form-control" id="noExt">
		                	</div>
	                  		</div>
	                  		<br/><br/>
							  	<div class="box-header with-border"  style="text-align: center;">
								    <h3 class="box-title">Datos de la Factura</h3>
							  	</div><br/>
							<div class="row">
	                  	<label class="col-sm-2 control-label">Lugar de Expedición</label>
		 					<div class="col-sm-2">
		                  		<input type="text" name="invoiceExpedition" class="form-control" id="invoiceExpedition">
		                	</div>
	                  	     	<label class="col-sm-1 control-label">Método de Pago</label>
	                  	
		 					<div class="col-sm-3">
		                  		<select name="paymentMethod" class="form-control select1">
                            <option value="Pago en una sola exhibición">Pago en una sola exhibición</option>
                            <option value="Pago inicial y parcialidades">Pago inicial y parcialidades</option>
                            <option value="Pago en parcialidades o diferido">Pago en parcialidades o diferido</option>
                        		</select>
		                	</div>
		                	 	<label class="col-sm-1 control-label">Forma de Pago</label>
		 						<div class="col-sm-3">
		                  		<select name="paymentform" class="form-control select1">
                            <option value="Transferencia electrónica de fondos">Transferencia electrónica de fondos</option>
                            <option value="Tarjeta de crédito">Tarjeta de crédito</option>
                            <option value="Tarjeta de débito">	Tarjeta de débito</option>
                            <option value="	Dinero electrónico">Dinero electrónico</option>
                        		</select>
		                	</div>
	                  	</div><br/>
	                  	<div class="row">
	                  	     	<label class="col-sm-1 control-label">Tipo de Cambio</label>
	                  	
		 					<div class="col-sm-3">
		                  		<select name="currency" class="form-control select1">
                            <option value="MXN">MXN</option>
                            <option value="USD">USD</option>
                        		</select>
		                	</div>
	                  	</div><br/> 
	                  	 	<div class="row">
	                  	     	<label class="col-sm-1 control-label">Clave del Servicio</label>
	                  		<div class="col-sm-2">
		                  		<input type="text" name="clave" class="form-control" id="clave">
		                	</div>
		                		<label class="col-sm-1 control-label">Descripción del Servicio</label>
	                  		<div class="col-sm-5">
		                  		<input type="text" name="desc" class="form-control" id="desc">
		                	</div>
		                	<label class="col-sm-1 control-label">Monto</label>
	                  		<div class="col-sm-2">
		                  		<input type="text" name="monto" class="form-control" id="monto">
		                	</div>
		                </div><br/>
		                <div class="row">
	                  	     	<label class="col-sm-1 control-label">Clave del Servicio</label>
	                  		<div class="col-sm-2">
		                  		<input type="text" name="clave2" class="form-control" id="clave2">
		                	</div>
		                		<label class="col-sm-1 control-label">Descripción del Servicio</label>
	                  		<div class="col-sm-5">
		                  		<input type="text" name="desc2" class="form-control" id="desc2">
		                	</div>
		                	<label class="col-sm-1 control-label">Monto</label>
	                  		<div class="col-sm-2">
		                  		<input type="text" name="monto2" class="form-control" id="monto2">
		                	</div>
		                </div><br/>
		                <div class="row">
	                  	     	<label class="col-sm-1 control-label">Clave del Servicio</label>
	                  		<div class="col-sm-2">
		                  		<input type="text" name="clave3" class="form-control" id="clave3">
		                	</div>
		                		<label class="col-sm-1 control-label">Descripción del Servicio</label>
	                  		<div class="col-sm-5">
		                  		<input type="text" name="desc3" class="form-control" id="desc3">
		                	</div>
		                	<label class="col-sm-1 control-label">Monto</label>
	                  		<div class="col-sm-2">
		                  		<input type="text" name="monto3" class="form-control" id="monto3">
		                	</div>
		                </div><br/><br/>



	                  	<div class="form-group" style="text-align: center;"> <!-- Submit Button -->
					      <button type="submit" class="btn btn-primary" style="background-color: #3E3D3D;">Facturar</button>
					    </div>
                </form>
            @endif

        </div>	  	
	</div>
@stop