<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body>
    <h2>Hola {{ $name }}, gracias por registrarte en <strong>Boomedic</strong> !</h2> Por favor confirma tu correo electrónico, Para ello haz clic aquí:

<table>
    <tr>
         <td style="background-color: black;border-color: black;border: 2px solid black;padding: 10px;text-align: center;">
            <a style="display: block;color: #ffffff;font-size: 12px;text-decoration: none;text-transform: uppercase;"  href="{{ url('emails/verify/' . $confirmation_code) }}">
                 Clic para confirmar tu email
            </a>
        </td>
    </tr>
</table>
</body>
</html>