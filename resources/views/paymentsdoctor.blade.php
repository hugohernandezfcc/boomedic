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
<div align="right">
<form name='classic' method='POST' action=''>
	{{ csrf_field() }}
<select id="filter" name="filter">
	<option value="{{ \Carbon\Carbon::now()->format('M/Y') }}" selected>{{ \Carbon\Carbon::now()->format('M/Y') }}</option>
	<option value="all">Todos</option>
</select>	
</form>
</div>
<div class="row">
	  	<div class="col-md-6 col-sm-12 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><sup style="font-size: 20px">$</sup><span id="owed">0</span></h3>

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
              <h3><sup style="font-size: 20px">$</sup><span id="paid">0</span></h3>

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
				                        <th class="desktop">Nro. Transacción</th>
				                        <th class="desktop">Fecha</th>
				                        <th class="desktop">Lugar</th>
				                        <th class="all">Paciente</th>
				                        <th class="desktop">Monto</th>
				                        <th class="desktop">Estado</th>
				                    </tr>
				                </thead>

				                <tbody>
					     	@foreach ($transaction->sortByDesc('when') as $tr)

					     	@if(\Carbon\Carbon::parse($tr->when)->format('M/Y') == "Jan/2019")

					     		@if($tr->type_doctor == 'Owed')
					     		<script>
					     			var mount = '{{ $tr->amount }}';
					     			var count = parseFloat(document.getElementById('owed').innerHTML) + parseFloat(mount);
					     			document.getElementById('owed').innerHTML = count.toFixed(2);	
					     		</script>
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
						        <script>
					     			var mount = '{{ $tr->amount }}';
					     			var countpaid = parseFloat(document.getElementById('paid').innerHTML) + parseFloat(mount);
					     			document.getElementById('paid').innerHTML = countpaid.toFixed(2);	
					     		</script>
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
						      @endif    
			             	@endforeach
								<tbody>
				    	 </table>
	  </div>
</div>	  	
@stop