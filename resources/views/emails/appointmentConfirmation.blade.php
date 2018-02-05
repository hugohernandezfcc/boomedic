<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body style="background-color: #696363">
	<img src="{{ $message->embed(public_path() . '/images/logoD.png') }}" width="170" height="150" style="background-color: black; align-self: right" />
    
    <h2>Confirmación de cita</h2>
    

    <p>
    Estimado usuario, su cita ha sido confirmada para la fecha {{$appointment->when}} con el doctor {{$doctor->name}}.<br>
    Favor de presentarse el día y la fecha indicada.
    </p>

    
</body>
</html>