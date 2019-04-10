<div class="modal fade" role="dialog" id="modalfamily2">
<div class="modal-dialog modal-sm">

  <div class="modal-content">

    <div class="modal-header" >
      <!-- Tachecito para cerrar -->
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <div align="left"><label>Información del Familiar</label></div>
    </div>
        <div class="modal-body">
        <div align="center"><img src="" id="userp" class="img-circle" alt="User Image" style="height: 100px;"></img><br><br><b><div id="namep"></div></b></div><br>
        <form id="init1" style="display: none;" action="{{ url('/user/loginSon') }}" method="post">
        	<input type="hidden" name="id" id="idpa">
				<button type="submit" id="init" class="btn btn-secondary btn-flat btn-block" style="display: none;">Iniciar Sesión</button>
		</form>
        </div>
    </div>
  </div> 
</div>