@extends('adminlte::page')

@section('title', 'Boomedic')


@section('content')
<div class="box">
	  		<div class="alert alert-info">
		        <i class="icon fa fa-info"></i>Por favor confirme la cuenta con el correo enviado
		    <table>
    <tr>
        <td style="background-color: black;border-color: black;border: 2px solid blx¿ck;padding: 10px;text-align: center;">
            <a style="display: block;color: #ffffff;font-size: 12px;text-decoration: none;text-transform: uppercase;"  href="{{ url('returnverify/') }}">
                 Reenviar email de confirmación
            </a>
        </td>
    </tr>
</table>
		    </div> 
		    </div>       				      
 	
@stop