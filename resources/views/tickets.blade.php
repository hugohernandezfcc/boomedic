@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

@stop

@section('content')

<<<<<<< HEAD
=======
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
	    <form class="lockscreen-credentials" action="/emailInbound/create" method="get">
	    	{{ csrf_field() }}
	      	<div class="input-group">
	        	<div class="form-control">Escribir</div>
	        	<input type="hidden" name="id" value="{{ $userId }}">
	        	<div class="input-group-btn">
		          	<button type="submit" class="btn">
		          		<i class="fa fa-pencil text-muted"></i>
		          	</button>
	        	</div>
	      	</div>
	    </form>
	    <!-- /.lockscreen credentials -->
	</div>

>>>>>>> 4ef6d6fe68fd4c63e595c5d9b9ed8604ce11d800

@include('headerprofile')

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
	    		<div class="form-group has-feedback">	
	    			<label for="cause" class="col-sm-2 control-label">Causa</label>
	    			 <div class="col-sm-10">
				        <select name="cause" class="form-control select1">
                            <option value="01">Error "No es posible determinar mi ubicación"</option>
                            <option value="02">La app no está sonando</option>
                            <option value="03">La app se congela o se cierra en iOS</option>
                            <option value="04">Uso de otras aplicaciones o recepción de llamadas mientras está en línea</option>
                        </select></div></div>

	    			<div class="form-group has-feedback">
	    				<label for="subject" class="col-sm-2 control-label">Asunto</label>
	                	<div class="col-sm-10">
	                  		<input type="text" name="subject" class="form-control" id="subject"  required="true">
	                	</div>
	              	</div>

	              	<div class="form-group has-feedback ">
	                    <label for="ticketDescription" class="col-sm-2 control-label">Descripción</label>
	                	<div class="col-sm-10">
	                  		<textarea name="ticketDescription" class="form-control" id="ticketDescription" rows="4" style="overflow:hidden;" required="true"></textarea>
	                	</div>
	              	</div>
	              	<br>
	              	<div class="form-group has-feedback">
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

		    @elseif($mode == 'sendEmail')

	        	<form action="/emailInbound/sendEmail/{{$userId}}" method="post" class="form-horizontal">
	    			{{ csrf_field() }}

	    			<div class="form-group has-feedback ">
	    				<label for="subject" class="col-sm-2 control-label">Asunto</label>
	                	<div class="col-sm-10">
	                  		<input type="text" name="subject" class="form-control" id="subject" >
	                	</div>
	              	</div>

	              	<div class="form-group has-feedback ">
	                    <label for="emailBody" class="col-sm-2 control-label">Texto</label>
	                	<div class="col-sm-10">
	                  		<input type="text" name="emailBody" class="form-control" id="emailBody" >
	                	</div>
	              	</div>

	              	<div class="col-sm-4">
			    		<button type="submit" class="btn btn-secondary btn-block btn-flat">
			                Enviar
			            </button>
		            </div>
		    		<div class="col-sm-4">
		    			<a href="{{ url()->previous() }}" class="btn btn-default btn-block btn-flat">
			                Cancelar
			            </a>
		            </div>

		        </form>

            @endif

        </div>	  	
	</div>

@stop