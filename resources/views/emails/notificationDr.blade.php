<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body>
   <!-- <h2>Hola {{ $doctor }}, alguien a querido registrar una cita en tu consultorio, pero no tienes horarios agregados. </h2>
    <br/>
    <p>
    <strong>Detalles del paciente</strong><br/>
    <strong>Nombre:</strong> {!!$patient!!} <br/>
    <strong>Edad:</strong> {!!$age!!} <br/>
    <strong>Género:</strong> {!!$gender!!} <br/>
 	</p>
    <h4>Agrega tus horarios, haz clic aquí:</h4>-->
    Esto es una prueba de custom url para apps
<table>
    <tr>
         <td style="background-color: black;border-color: black;border: 2px solid black;padding: 10px;text-align: center;">
            <a style="display: block;color: #ffffff;font-size: 12px;text-decoration: none;text-transform: uppercase;" href="http://sbx00.herokuapp.com/medicalconsultations">
                 url normal
            </a></td>
           <td><a style="display: block;color: #ffffff;font-size: 12px;text-decoration: none;text-transform: uppercase;" href="boomedic://">
                Boomedic custom link
            </a></td><td>
            <a style="display: block;color: green;font-size: 12px;text-decoration: none;text-transform: uppercase;" href="whatsapp://">
                whatsapp
            </a>
         </td>
    </tr>
</table>
</body>
</html>