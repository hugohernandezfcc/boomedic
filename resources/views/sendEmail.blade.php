<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body style="background-color: #696363">
	<img src="{{ $message->embed(public_path() . '/images/logoD.png') }}" width="170" height="150" style="background-color: black; align-self: right" />
    
    <h2>El usuario {!!$name!!} envía este correo.</h2>
    

    <p>
    <strong>Detalles del usuario</strong><br/>
    <strong>Nombre de Usuario:</strong> {!!$username!!} <br/>
    <strong>Nombre:</strong> {!!$firstname!!} {!!$lastname!!} <br/>

    <strong>Edad:</strong> {!!$age!!} <br/>
    <strong>Género:</strong> {!!$gender!!} <br/>
    <strong>Ocupación:</strong> {!!$occupation!!} <br/>
    
    <strong>Dirección:</strong> {!!$country!!}, {!!$state!!}, {!!$delegation!!}, {!!$colony!!}, {!!$postalcode!!}, {!!$street!!} {!!$streetnumber!!} {!!$interiornumber!!} <br/>
    <strong>Teléfono:</strong> {!!$mobile!!} <br/>

    </p>

    
</body>
</html>