<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body>
	<img src="{{ $message->embed(public_path() . '/images/logoD.png') }}" width="170" height="150" style="background-color: black; align-self: right" />
    
    <h2>El usuario {!!$name!!} ha creado un ticket.</h2>
    

    <p>
    <strong>Motivo:</strong> {!!$subject!!} <br/>
    <strong>Detalle del ticket:</strong> {!!description!!}
    </p>

    
</body>
</html>