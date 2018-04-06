@extends('adminlte::page')

@section('title', 'Boomedic')


@section('content')
<div class="box">
	  		<div class="alert alert-info" style="background-color: #7d7d7d !important; border-color: #7d7d7d !important">
		        <h5><i class="icon fa fa-info"></i>Por favor confirme la cuenta con el enlace que fue enviado a su correo</h5><br>
        <div align="right">
            <a style="text-decoration: none;"  href="{{ url('returnverify/') }}" class="btn btn-secondary btn-flat">
                 Reenviar email de confirmación
            </a>
        </div>

		    </div> 
		    </div>       				      
 	
@stop