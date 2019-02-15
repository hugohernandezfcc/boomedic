<!DOCTYPE html>
<html lang="es">
	<head>
	    <meta charset="utf-8">
		    <style type="text/css">

					.custom-select {
					    -webkit-appearance: none;
					    -moz-appearance: none;
					    appearance: none;
					    height: 45px;
					    width: 300px;
					    padding: 10px 38px 10px 16px;
					    transition: border-color .1s ease-in-out,box-shadow .1s ease-in-out;
					    border: 1px solid #ddd;
					    border-radius: 25px;
					}
					.custom-select:hover {
					    border: 1px solid #999;
					}
					.custom-select:focus {
					    border: 1px solid #999;
					    box-shadow: 0 3px 5px 0 rgba(0,0,0,.2);
					    outline: none;
					}
					/* remove default arrow in IE */
					select::-ms-expand {
					    display:none;
					}
					.custom-select {
					    font-family: 'Source Sans Pro', sans-serif;
					    font-size: 16px;
					}
		    </style>
	</head>
	<body>

	    <h2>El dr. {!! $dr !!} te ha cancelado la cita...</h2>
	    <hr>
	       Motivo: {!! $reason !!} <br>
	       Definitivo: {!! $definitive !!}  <br>   


	<div align="center">
	    <select class="custom-select">
	    <optgroup label="Próximos días después de la cita">  	
			       @foreach($array as $a)
			       	   <option value="{!! $a !!}"> {!! $a !!} </option>
			       @endforeach
	     </optgroup>


	    <optgroup label="Semana siguiente mismo horario">  
			       @foreach($array2 as $a2) 
			       	   <option value="{!! $a2 !!}"> {!! $a2 !!} </option>
			       @endforeach
		</optgroup>	       
	    <optgroup label="El resto del día de la cita">  
			       @foreach($array3 as $a3)
			       		<option value="{!! $a3 !!}">{!! $a3 !!} </option>
			       @endforeach
		</optgroup>	       
		</select>
	</div>	       
	</body>
</html>