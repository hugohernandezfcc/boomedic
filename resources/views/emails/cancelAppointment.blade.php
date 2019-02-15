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
       @foreach($array as $a)
       		{!! $a->fecha !!} <br>
       		{!! $a->hora !!}<br>
       @endforeach
    
</body>
</html>