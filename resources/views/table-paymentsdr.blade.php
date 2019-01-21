
	<tbody>

		@foreach ($transaction->sortByDesc('when') as $tr)
		@if(\Carbon\Carbon::parse($tr->when)->format('m/Y') == $filter)
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