<div class="modal fade" role="dialog" id="modalfamily">
    <div class="modal-dialog">

      	<div class="modal-content">


        <div class="modal-header" style="padding-bottom: 1px !important;">
         	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            	<span aria-hidden="true">&times;</span>
          	</button>
          	<div align="left"><label>Información de Familiar</label></div>
        </div>

        <div class="register-box-body">


            <div align="form-group" style="margin-bottom: 6px;">
				<a class="btn btn-default btn-flat btn-block" id="inac">No es un usuario de la App</a>
			</div>
			<div align="form-group">
				<a class="btn btn-default btn-flat btn-block" id="inac2">Si es un usuario activo de la App</a>
			</div>



             <form action="{{ url('/user/saveFamily') }}" id="formulatio" method="post" style="display: none;">
             	{{ csrf_field() }}
             	<input type="hidden" name="val" id="val" value="false">
                <div class="form-group has-feedback">	
					<input type="text" name="name" id="sea" class="form-control" placeholder="Nombre Completo" required>
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				   </div>
				    <input type="hidden" name="idfam" id="idfam" required>
					<div id="resp" class="form-group text-muted"></div>
					 <div class="form-group has-feedback">	
					<select class="form-control select2" id="relationship" name="relationship" size="1">
						<option value="0" default>--Seleccione parentesco--</option>
						<option value="father">Padre</option>
						<option value="mother">Madre</option>
						<option value="son">Hijo(a)</option>
						<option value="siblings">Hermano(a)</option>
						<option value="grandparents">Abuelo(a)</option>
						<option value="uncles">Tío(a)</option>
						<option value="wife">Esposa</option>
						<option value="husband">Esposo</option>
					</select>
					</div> 
					<div id="reg" style="display: none;">
	                <div class="form-group has-feedback">
	                    <input type="email" name="email" class="form-control" placeholder="{{ trans('adminlte::adminlte.email') }}">
	                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	                </div>

	                <div class="form-group has-feedback">
	                    <input type="date" name="birthdate" class="form-control" placeholder="{{ trans('adminlte::adminlte.birthdate') }}">
	                    <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
	                </div>

	                <div class="form-group has-feedback">
	                  <select class="form-control select2" name="gender" size="1">
	                  	<option value="female">Femenino</option>
	                  	<option value="male">Masculino</option>
	                  	<option value="other">Otro</option>
	                  </select>
	                </div>
					</div>	
					<div align="right">
					<button  type="button" class="btn btn-default btn-flat" id="back"><i class="fa fa-arrow-left text-muted"></i>&nbsp; Regresar</button>
					<button  type="submit" class="btn btn-default btn-flat" id="sav"><i class="fa fa-plus text-muted"></i>&nbsp; Agregar Familiar</button>
					</div>
				</form>
			</div>
      </div> 
    </div>
</div>

<script type="text/javascript">
	$('#modalfamily [data-dismiss=modal]').on('click', function (e) {
			document.getElementById('formulatio').style.display = "none";
			document.getElementById('inac2').style.display = "block";
			document.getElementById('inac').style.display = "block";

	})
	$('#back').on('click', function(e) {
			document.getElementById('formulatio').style.display = "none";
			document.getElementById('inac2').style.display = "block";
			document.getElementById('inac').style.display = "block";

	})
	$('#inac').on('click', function(e) {
			 e.preventDefault();
			    document.getElementById('formulatio').style.display = "block";
			 	document.getElementById('reg').style.display = "block";
			 	document.getElementById('inac2').style.display = "none";
			 	document.getElementById('inac').style.display = "none";
			 	document.getElementById("formulatio").reset();
			 	$("#sav").removeAttr("disabled");
			 	document.getElementById("val").value ="true";
			 	document.getElementById('resp').style.display = "none";

		});
	$('#inac2').on('click', function(e) {
			 e.preventDefault();
			 document.getElementById('formulatio').style.display = "block";
			 	document.getElementById('reg').style.display = "none";
			 	document.getElementById('inac').style.display = "none";
			 	document.getElementById('inac2').style.display = "none";
			 	document.getElementById("formulatio").reset();
			 	$("#sav").attr("disabled", "disabled");
			 	document.getElementById("val").value ="false";
			 	document.getElementById('resp').style.display = "inline";
			 	document.getElementById("resp").innerHTML = "";

		})
</script>

