<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body>
	<img src="{{ $message->embed(public_path() . '/images/logoD.png') }}" width="200" height="200"/>
    <h2>El usuario {{ $user->name }} ha creado un ticket.</h2>
</body>
</html>