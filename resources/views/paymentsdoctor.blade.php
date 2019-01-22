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
	<div align="right" class="col-md-3 col-sm-6 col-xs-6 pull-right">
		<form name='classic' method='POST' action=''>
			{{ csrf_field() }}
			<select id="filter" name="filter" class="form-control" onchange='change();'>
				@foreach($dates as $dat)
				@if($loop->first)
				<option value="{{ $dat['when'] }}" selected>{{ $dat['when'] }}</option>
				@else
				<option value="{{ $dat['when'] }}">{{ $dat['when'] }}</option>
				@endif
				@endforeach
				<option value="all">Todos</option>

			</select>	
		</form>
	</div>
</div><br>
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

              <script type="text/javascript">
              function change(){

                  var myVal = document.getElementById('filter').value; 
                  function getvariable(val) {
                  var variable = eval(val);
                  document.write(variable);
                  }
                  @php
                  function obtenervarjavascript($js_var_name) {
                  $x = "<script language='JavaScript'> getvariable('" . $js_var_name . "'); </script>";
                  return $x;
                  }

                  $filter = obtenervarjavascript("myVal");

                  @endphp
										@include('table-paymentsdr', 
                                            [
                                              'filter' => print($filter),
                                              'transaction'  => $transaction
                                            ]
                                          )
                  };
              </script>       

				    	 </table>
	  </div>
</div>	 
<script type="text/javascript">
$(function () {
  change();
            $('select').select2({
                width: "100%",
            });
          });
</script> 	
@stop