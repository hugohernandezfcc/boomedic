<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body>
    <img src="{!! $message->embed(public_path() . '/images/logoD.png') !!}" width="170" height="150" style="background-color: gray; align-self: right;" />
    <br>
    <h2>Dr. {!! $name !!} te ha añadido como Asistente</h2>
    

    <p>
    <strong>Detalles del usuario</strong><br/>
    <strong>Nombre de Usuario:</strong> {!! $username !!} <br/>
    <strong>Nombre:</strong> {!! $firstname !!} {!! $lastname !!} <br/>

    <br/><br/>
        <table>
    <tr>
         <td style="background-color: black;border-color: black;border: 2px solid black;padding: 10px;text-align: center;">
            <a style="display: block;color: #ffffff;font-size: 12px;text-decoration: none;"  href="{{ url('doctor/verify/' . $id) }}">
                 Clic para confirmar que eres su asistente
        </td>
    </tr>
</table>

    
</body>
</html>