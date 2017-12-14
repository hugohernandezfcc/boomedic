<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body>
	
    <h2>Saludos {!!$name!!}.</h2>
    

    <p>
    <strong>Detalles del usuario</strong><br/>
    <strong>Nombre de Usuario:</strong> {!!$username!!} <br/>
    <strong>Nombre:</strong> {!!$firstname!!} {!!$lastname!!} <br/>

    <strong>Edad:</strong> {!!$age!!} <br/>
    <strong>Género:</strong> {!!$gender!!} <br/>
    <strong>Ocupación:</strong> {!!$occupation!!} <br/>
    
    <strong>Dirección:</strong> {!!$country!!}, {!!$state!!}, {!!$delegation!!}, {!!$colony!!}, {!!$postalcode!!}, {!!$street!!} {!!$streetnumber!!} {!!$interiornumber!!} <br/>
    <strong>Teléfono:</strong> {!!$mobile!!} <br/>

    <br/><br/>

    <strong>Detalles</strong><br/>

    <strong>Se le notifica que su tarjeta se encuentra próxima a vencer el {{$dateExpM}}/{{$dateExpY}} cómo método de pago para Boomedic.</strong>
    </p>

    
</body>
</html>