<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body>

    <h2>El dr. {!! $dr !!} te ha cancelado la cita...</h2>
    <hr>
       Motivo: {!! $reason !!} <br>
       Definitivo: {!! $definitive !!}  <br>   

       Opciones 1: 
	       <select>
		       @foreach($array as $a)
		       	@if($loop == 1)
		       	   <option value="null">-Ninguno-</option>
		       	@endif   
		       	   <option value="{!! $a !!}"> {!! $a !!} </option>
		       @endforeach
	       </select>
       <br>

       Opciones 2:
	       <select>
		       @foreach($array2 as $a2)
		       	@if($loop == 1)
		       	   <option value="null">-Ninguno-</option>
		       	@endif   
		       	   <option value="{!! $a2 !!}"> {!! $a2 !!} </option>
		       @endforeach
	       </select>
       <br>

       Opciones 3:
	       <select>
		       @foreach($array3 as $a3)
		       	@if($loop == 1)
		       	   <option value="null">-Ninguno-</option>
		       	@endif   
		       		<option value="{!! $a3 !!}">{!! $a3 !!} </option>
		       @endforeach
	       </select>
</body>
</html>