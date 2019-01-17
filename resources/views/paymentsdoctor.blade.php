@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')
<style type="text/css">
	      table.dataTable>tbody>tr.child ul.dtr-details {
        margin-left: 65px;
      }
      
</style>
@stop

@section('content')
<div class="row">
	  	<div class="col-md-6 col-sm-12 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><sup style="font-size: 20px">$</sup>{{ $owed }}</h3>

              <p>Pendiente</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">
              Mes Actual
            </a>
          </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><sup style="font-size: 20px">$</sup>{{ $paid }}</h3>

              <p>Pagado</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">
              Mes Actual
            </a>
          </div>
        </div>
</div>        
       <div class="box">
	  <div class="box-header with-border">
	      <h3 class="box-title">Histórico de Saldos</h3>  
	  </div> 

	  <div class="box-body content">
	  					<table id="paymentmethodtable" class="display responsive nowrap table" cellspacing="0" width="100%">
				                <thead>
				                    <tr>
				                    	 <th></th>
				                        <th class="all">Nro. Transacción</th>
				                        <th class="desktop">Fecha</th>
				                        <th class="desktop">Lugar</th>
				                        <th class="desktop">Paciente</th>
				                        <th class="desktop">Monto</th>
				                        <th class="desktop">Estado</th>
				                    </tr>
				                </thead>

				                <tbody>
					     	@foreach ($transaction->sortByDesc('when') as $tr)
					     		@if($tr->type_doctor == 'Owed')
								     <tr>
								     	<td></td>
						             	<td style="color: red;">{{ $tr->transaction }} <br/></td>
						             	<td style="color: red;">{{ $tr->when }}</td>
						             	<td style="color: red;">{{ $tr->place }}</td>
						             	<td style="color: red;">{{ $tr->name }}</td>
						             	<td style="color: red;">{{ $tr->amount }}</td>
						             	<td>Pendiente</td>
						             </tr>
						        @endif  
						        @if($tr->type_doctor == 'Paid')
								     <tr>
								     	<td></td>
						             	<td style="color: green;">{{ $tr->transaction }} <br/></td>
						             	<td style="color: green;">{{ $tr->when }}</td>
						             	<td style="color: green;">{{ $tr->place }}</td>
						             	<td style="color: green;">{{ $tr->name }}</td>
						             	<td style="color: green;">{{ $tr->amount }}</td>
						             	<td>Pagado</td>
						             </tr>
						        @endif        
			             	@endforeach
								<tbody>
				    	 </table>
	  </div>
</div>	  	
@stop