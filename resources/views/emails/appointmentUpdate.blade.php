<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body style="background-color: #696363">
	<img src="{{ $message->embed(public_path() . '/images/logoD.png') }}" width="170" height="150" style="background-color: black; align-self: right" />
    
    <h2>Cambio de fecha/horario de la cita médica</h2>
    

    <p>
    Estimado usuario, su cita ha sido cambiada de la fecha {{$previousAppointment->when}} para el {{$previousAppointment->when}} con el doctor {{$doctor->name}}.<br>
    Favor de presentarse el día y la fecha indicada.
    </p>
    <br><br>
    
</body>
</html>