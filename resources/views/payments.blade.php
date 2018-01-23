@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

@stop

@section('content')
    
    <br/>
@if($mode == 'listPaymentMethods')    
@include('headerprofile')
@endif

						<!-- Charge Alert whether payment was processed or not -->
							@if(session()->has('message'))

								@if(session()->has('success'))
							    <div class="alert alert-success alert-dismissable fade in" role="alert">
							    	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									    <span aria-hidden="true">&times;</span>
									</button>
									<strong>¡Enhorabuena!</strong><br/><br/>		
							        {{ session()->get('message') }}
							    </div>
							   
								@elseif(session()->has('error'))
								 <div class="alert alert-danger alert-dismissable fade in" role="alert">
								 	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									    <span aria-hidden="true">&times;</span>
									</button>
									<strong>¡Hubo un error en tu pago y no fue procesado!</strong><br/><br/>		
							       @php
							       	$code = session()->get('message');
							       @endphp
							 		<!-- Error codes are defined within the adminlte -->
							        {{ trans('adminlte::adminlte.'.$code) }}
							    </div>
							   @endif

							@endif
						<!-- Here ends the code for the alert -->

	<div class="box">
	  	<div class="box-header with-border">
		    <h3 class="box-title">Métodos de pago</h3>
	  	</div>
		<div class="box-body">

            @if($mode == 'listPaymentMethods')
            	<table id="paymentmethodtable" class="table table-bordered table-striped display nowrap dtr-inline collapse" cellspacing="0" width="100%">
	                <thead>
	                    <tr>
	                    	<th>Tarjeta</th>
	                        <th>Banco </th>
	                        <th>Proveedor </th>
	                        <th>Tipo</th>
	                        <th>Pago</th>
	                        <th> - </th>
	                    </tr>
	                </thead>
	                <tfoot>
	                    <tr>
	                       <th>Tarjeta</th>
	                        <th>Banco </th>
	                        <th>Proveedor </th>
	                        <th>Tipo</th>
	                        <th>Pago</th>
	                        <th> - </th>
	                    </tr>
	                </tfoot>
	                <tbody>
	                    @foreach ($cards as $card)
	                        <tr><form action="PaymentAuthorizations" method="post" id="regForm">
	                        	@if($card->provider != 'Paypal')
	                        	<td>
	                             @php 
	                            $cardfin = substr_replace($card->cardnumber, '••••••••••••', 0, 12)
	                             @endphp
	                            <a href = 'Transactions/{{ $card->id }}' class="btn"> {{ $cardfin }}</a></td>
	                            <td>{{ $card->bank }}</td>
	                            <td>{{ $card->provider }}</td>
	                            <td>{{ $card->credit_debit }}</td>
	          
	                           
	                            <!--  <td><input type="number" name="pay" value="" style="text-align: center;" class="form-control" required> <input type="hidden" name="id" value=" {{$card->id }} "></td> -->

	                            <td align="center">
	                            <div class="input-group-btn">
		          				<!-- Delete button that goes to a destroy type driver for the user to delete badly entered payment methods or that he no longer wants to have -->
		          				<a href = 'delete/{{ $card->id }}' class="btn" onclick ="return confirm('¿Seguro desea eliminar este método de pago?')">
		          				<i class="fa fa-trash text-muted"></i>
		          				</a>
	        					</div>
	                            <!-- <div class="input-group-btn">
	                            
	                            	<button type="submit" class="btn"><i class="fa fa-credit-card text-muted" id="reg"></i></button>
		          		
	        					</div> -->
	        				</td>

	        					 @endif
	        					 @if($card->provider == 'Paypal')
	        					 <td>
	                            <a href = 'Transactions/{{ $card->id }}' class="btn"> {{ $card->cardnumber }}</a></td>
	                            <td>{{ $card->bank }}</td>
	                            <td>{{ $card->provider }}</td>
	                            <td>{{ $card->credit_debit }}</td>
	        					 <
	                            <td align="center">
	                            <div class="input-group-btn">
		          				<!-- Delete button that goes to a destroy type driver for the user to delete badly entered payment methods or that he no longer wants to have -->
		          				<a href = 'delete/{{ $card->id }}' class="btn" onclick ="return confirm('¿Seguro desea eliminar este método de pago?')">
		          				<i class="fa fa-trash text-muted"></i>
		          				</a>
	        					</div>
	                           </td>
	        					@endif
	        					</form>
	                        </tr>
	                        
	                    @endforeach 

	                </tbody>
	            </table><br/><br/>

    <!-- <div class="row">
        <div class="col-md-8 col-md-offset-2">

                    <form action="postPaymentWithpaypal" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label for="amount" class="col-md-4 control-label">Monto</label>
                            <div class="col-md-6">
                                <input id="amount" type="number" class="form-control" name="amount" value="{{ old('amount') }}"  required>
                                @if ($errors->has('amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                        <div class="form-group"><br/>
                            <div align="center">
                                <button type="submit" class="btn btn-secondary btn-block btn-flat">
                                   Pagar con Paypal
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
        </div> -->

</div>
            @elseif($mode == 'createPaymentMethod')
            	<form action="store" method="post" class="form-horizontal">
            		{{ csrf_field() }}
	            	<div class="form-group has-feedback {{ $errors->has('typemethod') ? 'has-error' : '' }}">
	                  	<label for="typemethod" class="col-sm-2 control-label">Tipo de método</label>
	                  	<div class="col-sm-10">
		                  	<select class="form-control" name="typemethod" onchange="showMethodRegister(this.value);">
		                    	<option value="">Seleccionar ...</option>
		                    	<option value="card">Credito / Debito</option>
		                    	<option value="paypal">Paypal</option>
		                  	</select>
	                  	</div>
	                </div>

	               <div id="cardFields" style="display: none;" >
	                	<div class="form-group has-feedback {{ $errors->has('cardnumber') ? 'has-error' : '' }}">
		                    <label for="cardnumber" class="col-sm-2 control-label">No. Tarjeta</label>
		                	<div class="col-sm-10">
		                  		<input type="text" name="cardnumber" class="form-control" id="cardnumber" required>
		                	</div>
		              	</div>
		              			<div class="form-group has-feedback {{ $errors->has('year') ? 'has-error' : '' }}">
				                    <label for="year" class="col-sm-2 control-label">Fecha de Exp.</label>
				        <div class="col-sm-2">
				        <select name="month" class="form-control select1">
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select></div><div class="col-sm-2">
                        <select name="year" class="form-control select1">
                            <option value="17"> 2017</option>
                            <option value="18"> 2018</option>
                            <option value="19"> 2019</option>
                            <option value="20"> 2020</option>
                            <option value="21"> 2021</option>
                             <option value="22"> 2022</option>
                        </select></div><div class="col-sm-3">
                        <select name="CreDeb" class="form-control select1">
                            <option value="Credit">Crédito</option>
                            <option value="Debit">Débito</option>
                        </select>
                   		 </div>
				                    <label class="col-sm-1 control-label" required>CVV</label>
				                	<div class="col-sm-2">
				                  		<input type="text" name="cvv" class="form-control" id="cvv">
				                	</div>
								</div>

	                	<div class="form-group has-feedback {{ $errors->has('bank') ? 'has-error' : '' }}">
		                    <label for="bank" class="col-sm-2 control-label">Banco</label>
		                	<div class="col-sm-10">
		                  		<input type="text" name="bank" class="form-control" id="bank" required>
		                	</div>
		              	</div>

		              	<div class="form-group has-feedback {{ $errors->has('country') ? 'has-error' : '' }}">
		                    <label for="country" class="col-sm-2 control-label">País</label>
			                <div class="col-sm-10" align="left">
				                <select class="form-control select1" name="country" style="width: 100%;">
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
		              	<div class="col-sm-4">
			            	&nbsp;
			            </div>
			       		<div class="col-sm-4">
				    		<button type="submit" class="btn btn-secondary btn-block btn-flat">
				                Guardar
				            </button>
			            </div>
			    		<div class="col-sm-4">
			    			<a href="{{ url()->previous() }}" class="btn btn-default btn-block btn-flat">
				                Cancelar
				            </a>
			            </div>
			            <div class="col-sm-4">
			            	&nbsp;
			            </div>

	                </div>

	                <div id="paypalButton" style="display: none;">
		              <!--      <label for="paypal_email" class="col-sm-2 control-label">Email Paypal</label>
		                	<div class="col-sm-10">
		                  		<input type="text" name="paypal_email" class="form-control" id="paypal_email" required>
		                	</div><br/>

		              	<div class="col-sm-4">
			            	&nbsp;
			            </div>
		                	<div class="col-sm-4">
				    		<button type="submit" class="btn btn-secondary btn-block btn-flat">
				                Guardar
				            </button>
			            </div>
			    		<div class="col-sm-4">
			    			<a href="{{ url()->previous() }}" class="btn btn-default btn-block btn-flat">
				                Cancelar
				            </a>
			            </div>
			            <div class="col-sm-4">
			            	&nbsp;
			            </div> -->

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

			             @if($mode == 'historyTransaction')


			            	 @if($type == 'card')

					     <div style="font-size: 17px;">Transacciones</div>
					    <div style="font-size: 12px; font-style: oblique;">Fecha de Creación: {{ $created }} </div> <br/>
				             <div class="row">
			                	<div class="col-sm-6">
			                		<div class="row">
			                			<div class="col-sm-6" align="left"><b>Tarjeta:</b></div>
			                			<div class="col-sm-6" align="left">{{ $cardnumber }}</div>
			                		</div>
			                	</div>
			                	<div class="col-sm-6">
			                		<div class="row">
			                			<div class="col-sm-6" align="left"><b>Banco:</b></div>
			                			<div class="col-sm-6" align="left">{{ $bank }}</div>
			                		</div>
			                	</div>
			                </div>		
			                <br/>
			                <div class="row"> 
			                <div class="col-sm-6">
			                		<div class="row">
			                			<div class="col-sm-6" align="left"><b>Proveedor:</b></div>
			                			<div class="col-sm-6" align="left">{{ $provider }}</div>
			                		</div>
			                	</div>
			                <div class="row">
			                	<div class="col-sm-6">
			                		<div class="row">
			                			<div class="col-sm-6" align="left"><b>Débito/Crédito:</b></div>
			                			<div class="col-sm-6" align="left">{{ $credit_debit }}</div>
			                		</div>
			                	</div>
			                </div>
			              </div><br/><br/>

			            	<table id="transactions" class="table table-bordered table-striped" cellspacing="0" width="100%">
				                <thead>
				                    <tr>
				                    
				                        <th>Nro. Transacción</th>
				                        <th>Destinatario</th>
				                        <th>Monto</th>
				                        <th>Fecha de Transacción</th>
				                    </tr>
				                </thead>
				                <tbody>
					     	@foreach ($transactions as $transaction)
								     <tr>
						             	<td>{{ $transaction->transaction }} <br/></td>
						             	<td>{{ $transaction->receiver}}<br/></td>
						             	<td>{{ $transaction->amount }}</td>
						             	<td>{{ $transaction->created_at}}</td>
						             </tr>
			             	@endforeach
								<tbody>
				    	 </table>
				    	 @endif

				    	 @if($type == 'Paypal')
				    	 					     <div style="font-size: 17px;">Transacciones</div>
					    <div style="font-size: 12px; font-style: oblique;">Fecha de Creación: {{ $created }} </div> <br/>
				             <div class="row">
			                	<div class="col-sm-6">
			                		<div class="row">
			                			<div class="col-sm-6" align="left"><b>Id Paypal:</b></div>
			                			<div class="col-sm-6" align="left">{{ $cardnumber }}</div>
			                		</div>
			                	</div>
			                	<div class="col-sm-6">
			                		<div class="row">
			                			<div class="col-sm-6" align="left"><b>Email:</b></div>
			                			<div class="col-sm-6" align="left">{{ $paypal_email }}</div>
			                		</div>
			                	</div>
			                </div>		
			                <br/>
			                <div class="row"> 
			                <div class="col-sm-6">
			                		<div class="row">
			                			<div class="col-sm-6" align="left"><b>Proveedor:</b></div>
			                			<div class="col-sm-6" align="left">{{ $provider }}</div>
			                		</div>
			                	</div>
			              </div><br/><br/>

			            	<table id="transactions" class="table table-bordered table-striped" cellspacing="0" width="100%">
				                <thead>
				                    <tr>
				                    
				                        <th>Nro. Transacción</th>
				                        <th>Destinatario</th>
				                        <th>Monto</th>
				                        <th>Fecha de Transacción</th>
				                    </tr>
				                </thead>
				                <tbody>
					     	@foreach ($transactions as $transaction)
								     <tr>
						             	<td>{{ $transaction->transaction }} <br/></td>
						             	<td>{{ $transaction->receiver}}<br/></td>
						             	<td>{{ $transaction->amount }}</td>
						             	<td>{{ $transaction->created_at}}</td>
						             </tr>
			             	@endforeach
								<tbody>
				    	 </table>
				    	 @endif

            @endif

        </div>	  	
	</div>
@stop