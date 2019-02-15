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
       @foreach($array as $a)
       	<br>	{!! $a !!} 
       @endforeach
       <br>
       Opciones 2:
       @foreach($array2 as $a2)
       	<br>	{!! $a2 !!} 
       @endforeach
</body>
</html>