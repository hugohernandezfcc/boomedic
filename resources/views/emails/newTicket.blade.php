<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body>
	<img src="{{ $message->embed(public_path() . '/images/logoD.png') }}" width="150" height="170" style="background-color: black; align-self: right" />
    <!-- <h2>El usuario {{ $user->name }} ha creado un ticket.</h2> -->
    <h2>El usuario {!!$name!!} ha creado un ticket.</h2>
    

    <h3>Motivos: {!!$description!!}.</h2>

    
</body>
</html>