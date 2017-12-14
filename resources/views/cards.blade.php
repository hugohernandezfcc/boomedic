@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content')

<div class="box">
	  	<div class="box-header with-border">
		    <h3 class="box-title">Estado de Formas de Pago</h3>
	  	</div>
		<div class="box-body">

           
            	<table id="cardsExpired" class="table table-bordered table-striped" cellspacing="0" width="100%">
	                <thead>
	                    <tr>
	                    	<th>Tarjeta</th>
	                        <th>Banco </th>
	                        <th>Proveedor </th>
	                        <th>Fecha de Expiración</th>
	                    </tr>
	                </thead>
	                <tfoot>
	                    <tr>
	                    	<th>Tarjeta</th>
	                        <th>Banco </th>
	                        <th>Proveedor </th>
	                        <th>Fecha de Expiración</th>
	                    </tr>
	                </tfoot>
	                <tbody>
	                    @foreach ($allCards as $card)
	                        <tr>
	                        	<td><?php 
	                            $cardfin = substr_replace($card->cardnumber, '••••••••••••', 0, 12)
	                             ?>
	                             	{{ $cardfin }}
	                             </td>
	                            <td>{{ $card->bank }}</td>
	                            <td>{{ $card->provider }}</td>
	                            <td>{{ $card->month }}/{{ $card->year }}</td>
	                        </tr>
	                    @endforeach 

	                </tbody>
	            </table>
	        
        </div>	  	
	</div>

	
@stop