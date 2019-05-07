@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content')
	<div class="box">
		  		<div class="alert alert-info" style="background-color: #222d32 !important; border-color: #222d32 !important">
			        <h5><i class="icon fa fa-info"></i>Bienvenido a Boomedic {{ $name }}. Confirma tu cuenta con el enlace que fue enviado a tu correo para continuar y disfrutar de todos los beneficios de la App.</h5><br>
			        <div>
			            <a style="text-decoration: none;"  href="{{ url('returnverify/') }}" class="btn btn-default btn-flat text-black">
			                 Reenviar correo de confirmación
			            </a>
			        </div>
			    </div> 
	</div>       				      
@stop