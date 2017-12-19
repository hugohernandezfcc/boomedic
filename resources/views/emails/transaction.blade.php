<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body style="background-color: #696363">
	<img src="{{ $message->embed(public_path() . '/images/logoD.png') }}" width="170" height="150" style="background-color: black; align-self: right" />
    
    <h2>¡Ha realizado un pago exitoso en nuestra plataforma!</h2>
    

    <p>
    <strong>Detalles del usuario</strong><br/>
    <strong>Nombre de Usuario:</strong> {!!$username!!} <br/>
    <strong>Nombre:</strong> {!!$firstname!!} {!!$lastname!!} <br/>

  
    <br/><br/>

    <strong>Detalles del Pago</strong><br/>

    <strong>Número de Transaction:</strong> {!!$number!!} <br/>
    <strong>Monto:</strong> {!!$amount!!}
    </p>

    
</body>
</html>