@extends('adminlte::page')

@section('title', 'Boomedic')


@section('content')
<div class="box">
	  		<div class="alert alert-info" style="background-color: #222d32 !important; border-color: #222d32 !important">
		        <h5><i class="icon fa fa-info"></i>Por favor, confirma tu nueva cuenta con el enlace que fue enviado a tu correo</h5><br>
        <div>
            <a style="text-decoration: none;"  href="{{ url('returnverify/') }}" class="btn btn-default btn-flat text-black">
                 Reenviar correo de confirmación
            </a>
        </div>

		    </div> 
		    </div>       				      
 	
@stop