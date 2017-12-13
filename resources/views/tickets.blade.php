@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

@stop

@section('content')

	<div class="lockscreen-item" style="margin: 10px 0 30px auto;">
 <!-- lockscreen image -->
	   <div class="lockscreen-image">
		    	@if($photo == '')
		    	 	<img src="https://s3.amazonaws.com/abiliasf/profile-42914_640.png">
				@else
					<img src="{{ $photo }}">			
		    	@endif 

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
		    <h3 class="box-title">Estado de Casos</h3>
	  	</div>
		<div class="box-body">

            @if($mode == 'listTickets')
            	<table id="paymentmethodtable" class="table table-bordered table-striped" cellspacing="0" width="100%">
	                <thead>
	                    <tr>
	                    	<th>Asunto </th>
	                        <th>Estatus </th>
	                        <th>Descripción </th>
	                    </tr>
	                </thead>
	                <tfoot>
	                    <tr>
	                    	<th>Asunto </th>
	                        <th>Estatus </th>
	                        <th>Descripción </th>
	                    </tr>
	                </tfoot>
	                <tbody>
	                    @foreach ($allTickets as $ticket)
	                        <tr>	                        
	                            <td>{{ $ticket->subject }}</td>
	                            <td>{{ $ticket->status }}</td>
	                            <td>{{ $ticket->ticketDescription }}</td>
	                            <!-- <td align="center">
	                            <div class="input-group-btn">
		          				<a href = 'delete/{{ $ticket->id }}' class="btn" onclick ="return confirm('¿Eliminar ticket?')">
		          				<i class="fa fa-trash text-muted"></i>
		          				</a>
	        					</div> -->
	                            <!-- <div class="input-group-btn">
	                            	<!-- Summit button to process the payment, this points to the PaymentAuthorizations
	                            	<button type="submit" class="btn"><i class="fa fa-credit-card text-muted" id="reg"></i></button> --
		          		
	        					</div> --></td>
	                        </tr>
	                    @endforeach 

	                </tbody>
	            </table>
	        @elseif($mode == 'createTicket')

	        	<form action="/supportTicket/store" method="post" class="form-horizontal">
	    			{{ csrf_field() }}
	    		<div class="row">	
	    			<label for="cause" class="col-sm-2 control-label">Causa</label>
	    			 <div class="col-sm-10">
				        <select name="cause" class="form-control select1">
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
                        </select></div></div>

	    			<div class="form-group has-feedback ">
	    				<label for="subject" class="col-sm-2 control-label">Asunto</label>
	                	<div class="col-sm-10">
	                  		<input type="text" name="subject" class="form-control" id="subject" >
	                	</div>
	              	</div>

	              	<div class="form-group has-feedback ">
	                    <label for="ticketDescription" class="col-sm-2 control-label">Descripción</label>
	                	<div class="col-sm-10">
	                  		<input type="text" name="ticketDescription" class="form-control" id="ticketDescription" >
	                	</div>
	              	</div>
	              	<div class="row">
	              	<div class="col-sm-6">
			    		<button type="submit" class="btn btn-secondary btn-block btn-flat">
			                Guardar
			            </button>
		            </div>
		    		<div class="col-sm-6">
		    			<a href="{{ url()->previous() }}" class="btn btn-default btn-block btn-flat">
			                Cancelar
			            </a>
		            </div>
		        </div>
		        </form>

            @endif

        </div>	  	
	</div>

@stop