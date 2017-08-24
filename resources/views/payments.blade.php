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
	    <form class="lockscreen-credentials" action="/user/edit/complete" method="get">
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
        </div>	  	
	</div>
@stop