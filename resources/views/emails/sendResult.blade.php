<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body>

    <h2>Reenvío de examenes médicos</h2>
    From: {{ $from }} <br>
    Asunto: {{ $subject }}<br>
    Fecha: {{ $date }}<br>
    <table>
    <tr>
         <td style="background-color: #ffffff;border-color: black;border: 1px solid black;padding: 5px;text-align: center;">
            <a style="display: block;color: black;font-size: 10px;text-decoration: none;"  href="{{ $url }}">
                 Descargar {{ $filename }}
            </a>
        </td>
    </tr>
    </table>
    
</body>
</html>