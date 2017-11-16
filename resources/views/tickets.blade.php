@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

@stop

@section('content')

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
	                    <!-- @foreach ($allTickets as $ticket)
	                        <tr>	                        
	                            <td>{{ $ticket->subject }}</td>
	                            <td>{{ $ticket->status }}</td>
	                            <td>{{ $ticket->ticketDescription }}</td>
	                        </tr>
	                    @endforeach  -->

	                </tbody>
	            </table>
	        @elseif($mode == 'createTicket')

	        	<!-- <form action="/supportTicket/store/{{$userId}}" method="post" class="form-horizontal">
	    			{{ csrf_field() }}

	    			<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
	                    <label for="ticketDescription" class="col-sm-2 control-label">Descripción</label>
	                	<div class="col-sm-10">
	                  		<input type="text" name="ticketDescription" class="form-control" id="ticketDescription" value="{{ $ticketDescription }}">
	                	</div>
	              	</div>


	              	<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
	                    <label for="subject" class="col-sm-2 control-label">Asunto</label>
	                	<div class="col-sm-10">
	                  		<input type="text" name="subject" class="form-control" id="subject" value="{{ $subject }}">
	                	</div>
	              	</div>
	            </form> -->

	            {!! Form::open(['route' => 'supportTicket.store', 'method' => 'POST']) !!}

			    <div class="form-group">
			        {!! Form::label('subject', 'Asunto') !!}<br>
			        {!! Form::text('subject', null, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
			    </div>

			    <!-- <div class="form-group">
			        {!! Form::label('ticketDescription', 'Descripción') !!}<br>
			        {!! Form::text('ticketDescription', null, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
			    </div> -->

			    <div class="form-group">
			        {!! Form::submit('Enviar', ['class' => 'btn btn-primary']) !!}
			    </div>

				{!! Form::close() !!}

            @endif

        </div>	  	
	</div>

@stop