<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body>
	<img src="{{ $message->embed(public_path() . '/images/logoD.png') }}" width="170" height="150" style="align-self: right" />
    
    <h2>¡Ha realizado un pago exitoso en nuestra plataforma!</h2>
    
    <br/>
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