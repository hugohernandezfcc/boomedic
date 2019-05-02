<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body>
    <img src="{!! $message->embed(public_path() . '/images/logoD.png') !!}" width="170" height="150" style="background-color: gray; align-self: right;" />
    <br>
    <h2>Dr. {!! $name !!} ha cambiado algunos de tus permisos como asistente</h2>
    

    <p>
    <strong>Detalles del usuario</strong><br/>
    <strong>Nombre de Usuario:</strong> {!! $username !!} <br/>
    <strong>Email:</strong> {!! $email !!} <br/>

    <br/>

    
</body>
</html>