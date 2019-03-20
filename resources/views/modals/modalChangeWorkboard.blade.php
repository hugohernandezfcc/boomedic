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
                    <div class="modal-body" id="bodyappo">

                    </div>
                </div>

      </div> 
  </div>

  <script type="text/javascript">
       var appo = @php echo $appo; @endphp;
    if(appo != null &&  appo.length > 0){
      $('#modalAppo').modal()
      console.log('citas ' + JSON.stringify(appo));
      for(var r = 0; r < appo.length; r++){
        $('#bodyappo').append('<div>Paciente: '+ appo[r]['name'] +'<br>Cita: '+ appo[r]['when'] +'</div>');
      }
    }
  </script>