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
	        	<div class="input-group-btn">
		          	<button type="submit" class="btn">
		          		<i class="fa fa-plus text-muted"></i>
		          	</button>
	        	</div>
	      	</div>
	    </form>
	    <!-- /.lockscreen credentials -->

	</div>


	<div class="box">
	  	<div class="box-header with-border">
		    <h3 class="box-title">Métodos de pago</h3>
	  	</div>
		<div class="box-body">

            @if($mode == 'listPaymentMethods')
            	<table id="paymentmethodtable" class="table table-bordered table-striped" cellspacing="0" width="100%">
	                <thead>
	                    <tr>
	                        <th>Tipo </th>
	                        <th>Proveedor </th>
	                        <th>Terminación </th>
	                    </tr>
	                </thead>
	                <tfoot>
	                    <tr>
	                        <th>Tipo </th>
	                        <th>Proveedor </th>
	                        <th>Terminación </th>
	                    </tr>
	                </tfoot>
	                <tbody>
	                    @foreach ($cards as $card)
	                        <tr>
	                            <td>{{ $card->typemethod }}</td>
	                            <td>{{ $card->provider }}</td>
	                            <td>{{ $card->cardnumber }}</td>
	                        </tr>
	                    @endforeach 
	                </tbody>
	            </table>
            @elseif($mode == 'createPaymentMethod')
            	<form action="/user/update/" method="post" class="form-horizontal">

	            	<div class="form-group has-feedback {{ $errors->has('typemethod') ? 'has-error' : '' }}">
	                  	<label for="typemethod" class="col-sm-2 control-label">Tipo de método</label>
	                  	<div class="col-sm-10">
		                  	<select class="form-control" name="typemethod" onchange="showMethodRegister(this.value);">
		                    	<option value="">Seleccionar ...</option>
		                    	<option value="card">Credito / Debido</option>
		                    	<option value="paypal">Paypal</option>
		                  	</select>
	                  	</div>
	                </div>

	                <div id="cardFields" style="display: none;" >
	                	<div class="form-group has-feedback {{ $errors->has('cardnumber') ? 'has-error' : '' }}">
		                    <label for="cardnumber" class="col-sm-2 control-label">No. Tarjeta</label>
		                	<div class="col-sm-10">
		                  		<input type="text" name="cardnumber" class="form-control" id="cardnumber">
		                	</div>
		              	</div>
		              	<div class="row" style="width: 90%;" >
		              		<div class="col-sm-6">
		              			<div class="form-group has-feedback {{ $errors->has('dateexpired') ? 'has-error' : '' }}">
				                    <label for="dateexpired" class="col-sm-2 control-label">Fecha de Exp.</label>
				                	<div class="col-sm-10">
				                  		<input type="text" name="dateexpired" class="form-control" id="dateexpired">
				                	</div>
				              	</div>
		              		</div>
		              		<div class="col-sm-6">
		              			<div class="form-group has-feedback {{ $errors->has('cvv') ? 'has-error' : '' }}">
				                    <label for="cvv" class="col-sm-2 control-label">CVV</label>
				                	<div class="col-sm-10">
				                  		<input type="text" name="cvv" class="form-control" id="cvv">
				                	</div>
				              	</div>
		              		</div>
		              	</div>
		              	<div class="form-group has-feedback {{ $errors->has('country') ? 'has-error' : '' }}">
		                    <label for="country" class="col-sm-2 control-label">País</label>
			                <div class="col-sm-10" align="left">
				                <select class="form-control select2" name="country" style="width: 100%;">
				                  <option selected="selected">Estados Unidos</option>
				                  <option>México</option>
				                  <option>Brasil</option>
				                  <option>Canada</option>
				                  <option>Guatemala</option>
				                  <option>Paraguay</option>
				                  <option>Venezuela</option>
				                </select>
			                </div>
		              	</div>
	                </div>

	                <div id="paypalButton" style="display: none;">
	                	PAYPALMethod
	                </div>

	                <script type="text/javascript">
	                	
	                	function showMethodRegister(argument) {
	                		if(argument == 'card'){
								document.getElementById('cardFields').style.display = "block";
	                			document.getElementById('paypalButton').style.display = "none";

	                		}else if(argument == 'paypal'){
	                			document.getElementById('paypalButton').style.display = "block";
								document.getElementById('cardFields').style.display = "none";
	                		}
	                	}

	                </script>

                </form>
            @endif

        </div>	  	
	</div>
@stop