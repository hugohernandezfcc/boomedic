@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

@stop

@section('content')

@if($mode == 'listTickets')

 @if(count($allTickets) == 0)
                                    @include('empty.emptyData', 
                                            [
                                              'emptyc' => 'buttom',
                                              'title'  => 'casos',
                                              'icon'   => 'adminlte.empty-box'
                                            ]
                                          )
		@else
		  @include('headerprofile')
	<div class="box">
	  	<div class="box-header with-border">
		    <h3 class="box-title">Estado de Casos</h3>
	  	</div>
		<div class="box-body">
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
	                        </tr>
	                    @endforeach 

	                </tbody>
	            </table>
	      </div>	  	
		</div>    
	     @endif 
	        @elseif($mode == 'createTicket')
	   <div class="box">
	  	<div class="box-header with-border">
		    <h3 class="box-title">Estado de Casos</h3>
	  	</div>
		<div class="box-body">

	        	<form action="/supportTicket/store" method="post" class="form-horizontal">
	    			{{ csrf_field() }}
	    		<div class="form-group has-feedback">	
	    			<label for="cause" class="col-sm-2 control-label">Causa</label>
	    			 <div class="col-sm-10">
				        <select name="cause" class="form-control select2">
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
		 </div>	  	
	</div>
            @endif

@stop