<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body>
    <img src="{!! $message->embed(public_path() . '/images/logoD.png') !!}" width="170" height="150" style="background-color: gray; align-self: right;" />
    <br>
    <h2> {!! $name !!} ha confirmado que es tu asistente</h2>  
    <p>
    <strong>Detalles del usuario</strong><br/>
    <strong>Nombre de Usuario:</strong> {!! $username !!} <br/>

    <br/><br/>  
</body>
</html>