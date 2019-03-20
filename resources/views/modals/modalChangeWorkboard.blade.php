 <div class="modal fade" role="dialog" id="modalAppo">
    <div class="modal-dialog modal-sm">
      <!--Modal cita reagendada-->
              <div class="modal-content">

                <div class="modal-header" >
                  <!-- Tachecito para cerrar -->
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <div align="left"><label>¡Algunos pacientes  se habían registrado en el horario anterior!</label></div>
                </div>
                <form enctype="multipart/form-data" action="{{ url('drAppointments/cancelAppointment') }}" method="post">
                    <div class="modal-body">
                        <div id="bodyappo"></div><br>
                        <div align="right"><button class="btn btn-secondary btn-flat">Confirmar</button></div>
                    </div>

                </form>    
                </div>

      </div> 
  </div>

