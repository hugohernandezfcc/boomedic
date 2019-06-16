<style type="text/css">
   @if(!$isMobile)
      .modal-dialog {
         width: 70%;
         margin: 30px auto;
      }
   @endif
   .progress-bar {
      background-color: #3E3E3E;
   }
   .wizard > .content {
       display: block;
       min-height: 15em;
       overflow: hidden;
       position: relative;
       width: auto;
   }
   .wizard > .content > .body{
      position: relative;
   }
</style>

<input type="hidden" id="load-medicines" value="" />

<div class="modal fade" id="prescription-form-modal">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"> <i class="fa fa-edit"></i> Receta médica</h4>
         </div>
         <div class="modal-body">

            <div class="row">
               
               <div class="col-md-6">
                  <div style="padding: 3px;">
                     <select class="form-control" id="currentMedicalAppointment" style="width: 100%;">
                        @if(count($medAppointments) == 0)
                           
                           <option value="notUserSelected"> -- No hay citas para prescribir -- </option>

                        @else

                           @foreach($medAppointments as $medApp)
                              <option value="{{$medApp->user}}">
                                 {{$medApp->firstname}} {{$medApp->lastname}} / {{ trans('adminlte::adminlte.' . $medApp->gender) }}  / {{$medApp->age}} años 
                              </option>
                           @endforeach

                        @endif
                     </select>
                  </div>
               </div>

               <div class="col-md-6">
                  <div style="padding: 3px;">
                     <div class="progress-bar" id="progressCompleteRecipe" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="5" style="width: 10%;"> 10% </div>
                  </div>
               </div>

            </div>
            <br />
            <div class="row">
               <div class="col-md-12">
                  
                  <div id="wizardPrescription">
                     <h3>Receta </h3>
                     <section>
                           <!-- The validation is to change the cols number in textarea -->
                           <div class="form-group">
                              @if($isMobile)
                                 <textarea class="form-control" id="receta" rows="8" cols="32" onkeypress="controlledActionsOnTheWrite(this.value);" placeholder="Describe la prescripción médica ..."></textarea>
                              @else
                                 <textarea class="form-control" id="receta" rows="8" cols="34" onkeypress="controlledActionsOnTheWrite(this.value);" placeholder="Describe la prescripción médica ..."></textarea>
                              @endif
                           </div>
                     </section>
                     <h3>PDF </h3>
                     <section>

                        @if($isMobile)
                          <center><iframe id="framepdfprescription" width="111%" style="height: 300px;"></iframe></center>
                        @else
                          <center><iframe id="framepdfprescription" width="100%" style="height: 300px;"></iframe></center>
                        @endif
                           
                     </section>
                     
                  </div>

                  
               </div>
            </div>
            <script type="text/javascript">
               /**
                * Se guardan los nombre de cada medicamento cuando se abre el Modal
                * @type {Array}
                */
               var words = [];
               /**
                * medicinesToSelect arreglo donde se encuentra la descripción total de todos los medicamentos que están 
                * disponibles para seleccionar y con el nombre se puede acceder a la información completa
                */
               var medicinesToSelect = [];
               /**
                * medicinesSelected medicamentos seleccionados en la receta.
                */
               var medicinesSelected = [];
               /**
                * Contador utilizado para identificar si un doctor se encuentra escribiendo o borrando en la receta.
                */
               var lengthTextBody = 0;
               /**
                * Función que reduce la escritura de selectores por id.
                * @param  {[type]} argument [Dom element]
                * @return {[type]}          [element selected]
                */
               function byId(argument) {
                  return document.getElementById(argument);
               }
               /**
                * Utilizado para avanzar la barra de receta en cuanto se abra el Modal.
                */
               $('#prescription-form-modal').on('shown.bs.modal', function () {
                  byId('progressCompleteRecipe').setAttribute("style", "width: 30%;");
                  byId('progressCompleteRecipe').innerHTML = "30%";
               });
               $(document).ready(function(){
                  jQuery.noConflict(false);
                  $("#wizardPrescription").steps({
                        headerTag: "h3",
                        bodyTag: "section",
                        transitionEffect: "slideLeft",
                        cssClass: "wizard",
                        autoFocus: true,
                        labels: {
                           pagination: "Paginación",
                           finish:     "Enviar",
                           next:       "Revisar",
                           previous:   "Editar",
                           loading:    "Cargando"
                        },
                        showFinishButtonAlways: true,
                        onStepChanged: function (event, currentIndex, priorIndex) { 
                           if(currentIndex){
                              byId('linkfinish').href = "#finish";
                              byId('optionlinkfinish').removeAttribute("class");
                              byId('progressCompleteRecipe').setAttribute("style", "width: 90%;");
                              byId('progressCompleteRecipe').innerHTML = "90%";
                              byId('framepdfprescription').src = "{{ url('prescriptions/pdf')}}";
                           }else{
                              byId('linkfinish').href = "return false;";
                              byId('optionlinkfinish').className = "disabled";
                              byId('progressCompleteRecipe').setAttribute("style", "width: 50%;");
                              byId('progressCompleteRecipe').innerHTML = "50%";
                           }
                           console.log(currentIndex); // 1
                           console.log(priorIndex); // 0
                        },
                        onFinished: function (event, currentIndex) { 
                           console.log('terminado...' + event);
                           console.log('terminado...' + currentIndex);
                           byId('progressCompleteRecipe').setAttribute("style", "width: 100%;");
                           byId('progressCompleteRecipe').innerHTML = "100%";
                           
                           
                        }
                     });
                  
                  /**
                   * Activa el framework select2 para la selección de la cita a la cual se dirigirá la receta.
                   * @type {String}
                   */
                  $('#currentMedicalAppointment').select2({ width: "100%" });
                  
                  /**
                   * Permite que pueda establecer un id al botón y <LI> element de finalizar.
                   */
                  var getLinks = document.getElementsByTagName('a');
                  for (var i = getLinks.length - 1; i >= 0; i--) 
                     if(getLinks[i].href == "{{ url('prescriptions#finish')}}")
                        getLinks[i].setAttribute('id', "linkfinish");
                     
                  byId('linkfinish').parentNode.setAttribute('id', "optionlinkfinish");
                  byId('optionlinkfinish').className = "disabled";
                  byId('linkfinish').href = "return false;";
                  
               });
              
               /**
                * Función responsable de identificar los movimientos de escritura sobre la receta.
                * @param  string textBody [valor actual del textarea]
                */
               function controlledActionsOnTheWrite(textBody) {
                  var textBodyArray = textBody.split(" ");
                  if (textBody.length <= lengthTextBody) {
                     /**
                      * Agregar si existe la sustancia en el catalogo pero no fue seleccionada y se encuentra escrita en el textarea.
                      * (Validando para ver si lo agrego al array como optional)
                      * @param  {[type]} 
                      */
                     $.map(words, function (medicine) {
                        
                        if(textBodyArray.indexOf(medicine.split(" ")[0]) > 0){
                           console.log( 'Se encontro: ' + medicine);
                           return medicine;
                        }
                        //return word.indexOf(term) === 0 ?  word : null;
                     });
                     console.log('borrando...');
                  }else if(textBody.length >= lengthTextBody)
                           console.log('escribiendo...');
                  
                  
                  lengthTextBody = textBody.length;
                  var toDeleted = [];
                  /**
                   * En caso de que se encuentre en el array y no en el textarea eliminarla del array medicinesSelected.
                   */
                  $.map(medicinesSelected, function (medicine) {
                     textBody.toLowerCase();
                     if(textBody.indexOf(medicine.name) < 0)
                        toDeleted.push(medicine.name);
                     
                  });
                  if(toDeleted.length > 0)
                     for (var o = toDeleted.length - 1; o >= 0; o--) 
                        for (var i = medicinesSelected.length - 1; i >= 0; i--) 
                           if (medicinesSelected[i].name == toDeleted[o]) 
                              medicinesSelected.splice(i, 1);
               }
               /**
                * La función se ejecuta solo cuando se abre el modal para no hacer solicitudes que no sean
                * estrictamente necesarias.
                *
                * @textcomplete
                *
                * Aquí se activa el framework textcomplete que predice las palabras que se escriben para proponer
                * opciones de medicamentos.
                */
               function loadMedicines() {
                  if (byId('load-medicines').value == "") {
                     $.ajax({
                        method: "get",
                        url: "{{ url('prescriptions/medicinescatalogue')}}",
                        success: function( data ){
                           console.log('Submission was success.');
                           medicinesToSelect = data;
                           
                           $.map(data, function (word) {
                              words.push(word.name.charAt(0).toUpperCase() + word.name.slice(1));
                              words.push(word.name.toUpperCase());
                              words.push(word.name);
                           });
                           $.map(medicinesToSelect, function (word) { 
                              medicinesToSelect[word.name] = word.medicine; 
                           });
                           console.log(medicinesToSelect);
                           byId('load-medicines').value = true;
                           $('#receta').textcomplete([{
                              match: /(^|\b)(\w{2,})$/,
                              search: function (term, callback) {
                                 
                                 callback(
                                    $.map(words, function (word) {
                                       byId('textcomplete-dropdown-1').style.zIndex = "1100";
                                       return word.indexOf(term) === 0 ?  word : null;
                                    }
                                 ));
                              }, replace: function (word) {
                                 word = word.toLowerCase();
                                    
                                 // Validar que si esta seleccionada no agregue más de una versión al array medicinesSelected.
                                 $.map(medicinesSelected, function (medicineSelected) {
                                    if(word == medicineSelected.name){
                                       console.log('Words selected but not added one more time: ' + word);
                                       return word + ' ';
                                    }
                                 });
                                 var record = {
                                    "id"     : medicinesToSelect[word].split("---")[1].split(':')[1],
                                    "name"   : medicinesToSelect[word].split("---")[0].split(':')[1]
                                 };
                                 medicinesSelected.push(record);
                                 //name:adiamyl plus 4 / 1000 mg caja x 20 tabs---id:25
                                 console.log('Words selected: ');
                                 console.log(medicinesSelected);
                                 return word + ' ';
                              }
                           }]);
                        }, error: function( data ){
                           console.log('Submission was error.');
                           console.log(data);
                           if(data.error == "Unauthenticated.")
                              window.location.href = "{{ url('/login') }}";
                           
                        }
                     });
                  }
               }               
            </script>
         </div>

      </div>
   </div>
</div>