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
			<select id="filter" name="filter" class="form-control" onchange="changeSelect()">
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

	  					<table id="paytable" class="display responsive nowrap table" cellspacing="0" width="100%">
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
                                       

				    	 </table>
	  </div>
</div>	 
<script type="text/javascript">
                function changeSelect(){
                              
                                  $('#paytable .tbody').remove();
                                  $('#paytable').append('<tbody class="tbody"></tbody>');
                                  $('#owed').html('0');
                                  $('#paid').html('0');

                                var transaction = @php echo $transaction->sortByDesc('when'); @endphp;

                                for(var z=0; z < transaction.length; z++){
                                  if(document.getElementById('filter').value == 'all'){ 
                                                if(transaction[z]['type_doctor'] == 'Owed'){
                                               
                                                  var mount = transaction[z]['amount'];
                                                  var count = parseFloat(document.getElementById('owed').innerHTML) + parseFloat(mount);
                                                  document.getElementById('owed').innerHTML = count.toFixed(2); 
                                               
                                                $('#paytable .tbody').append('<tr><td></td>'
                                                      +'<td style="color: red;">'+ transaction[z]['transaction'] +'<br/></td>'
                                                      +'<td style="color: red;">'+ transaction[z]['when'] +'</td>'
                                                      +'<td style="color: red;">'+ transaction[z]['place'] +'</td>'
                                                      +'<td style="color: red;">'+ transaction[z]['name'] +'</td>'
                                                      +'<td style="color: red;">'+ transaction[z]['amount'] +'</td>'
                                                      +'<td>Pendiente</td></tr>');
                                                }
                                                
                                                if(transaction[z]['type_doctor'] == 'Paid'){
                                               
                                                  var mountpaid = transaction[z]['amount'];
                                                  var countpaid = parseFloat(document.getElementById('paid').innerHTML) + parseFloat(mountpaid);
                                                  document.getElementById('paid').innerHTML = countpaid.toFixed(2); 
                                          
                                               
                                                   $('#paytable .tbody').append('<tr><td></td>'
                                                      +'<td style="color: green;">'+ transaction[z]['transaction'] +'<br/></td>'
                                                      +'<td style="color: green;">'+ transaction[z]['when'] +'</td>'
                                                      +'<td style="color: green;">'+ transaction[z]['place'] +'</td>'
                                                      +'<td style="color: green;">'+ transaction[z]['name'] +'</td>'
                                                      +'<td style="color: green;">'+ transaction[z]['amount'] +'</td>'
                                                      +'<td>Pendiente</td></tr>');
                                                

                                                   }
                                      }else{
                                  
                                  if(moment(transaction[z]['when']).format("MM/YYYY") == document.getElementById('filter').value){ 

                                    if(transaction[z]['type_doctor'] == 'Owed'){
                                   
                                      var mount = transaction[z]['amount'];
                                      var count = parseFloat(document.getElementById('owed').innerHTML) + parseFloat(mount);
                                      document.getElementById('owed').innerHTML = count.toFixed(2); 
                                   
                                       $('#paytable .tbody').append('<tr><td></td>'
                                          +'<td style="color: red;">'+ transaction[z]['transaction'] +'<br/></td>'
                                          +'<td style="color: red;">'+ transaction[z]['when'] +'</td>'
                                          +'<td style="color: red;">'+ transaction[z]['place'] +'</td>'
                                          +'<td style="color: red;">'+ transaction[z]['name'] +'</td>'
                                          +'<td style="color: red;">'+ transaction[z]['amount'] +'</td>'
                                          +'<td>Pendiente</td></tr>');
                                    }
                                    
                                    if(transaction[z]['type_doctor'] == 'Paid'){
                                   
                                      var mountpaid = transaction[z]['amount'];
                                      var countpaid = parseFloat(document.getElementById('paid').innerHTML) + parseFloat(mountpaid);
                                      document.getElementById('paid').innerHTML = countpaid.toFixed(2); 
                              
                                   
                                       $('#paytable .tbody').append('<tr><td></td>'
                                          +'<td style="color: green;">'+ transaction[z]['transaction'] +'<br/></td>'
                                          +'<td style="color: green;">'+ transaction[z]['when'] +'</td>'
                                          +'<td style="color: green;">'+ transaction[z]['place'] +'</td>'
                                          +'<td style="color: green;">'+ transaction[z]['name'] +'</td>'
                                          +'<td style="color: green;">'+ transaction[z]['amount'] +'</td>'
                                          +'<td>Pendiente</td></tr>');
                                    

                                       }
                                      }

                                    }
                                  }
                                     }   
    $(function () {

        changeSelect();
       $('#paytable').DataTable({
      
                language: {
                        'processing':     'Procesando...',
                        'lengthMenu':     'Mostrar _MENU_ registros',
                        'zeroRecords':    'No se encontraron resultados',
                        'emptyTable':     'Ningún dato disponible en esta tabla',
                        'info':           'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
                        'infoEmpty':      'Mostrando registros del 0 al 0 de un total de 0 registros',
                        'infoFiltered':   '(filtrado de un total de _MAX_ registros)',
                        'infoPostFix':    '',
                        'search':         'Buscar:',
                        'url':            '',
                        'infoThousandsi':  ',',
                        'loadingRecords': 'Cargando...',
                        'paginate': {
                            'first':    'Primero',
                            'last':     'Último',
                            'next':     'Siguiente',
                            'previous': 'Anterior'
                        },
                        "aria": {
                            'sortAscending':  ': Activar para ordenar la columna de manera ascendente',
                            'sortDescending': ': Activar para ordenar la columna de manera descendente'
                        }
                    },
                'lengthChange': false,
        responsive: {
            details: {
                type: 'column',
                target: 0
            }
        },
        columnDefs: [ {
            className: 'control',
            orderable: false,
            targets:   0
        } ]
            });
                $('select').select2();

              });
</script> 	
@stop