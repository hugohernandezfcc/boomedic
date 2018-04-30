<style type="text/css">
   @if(!$isMobile)
      .modal-dialog {
         width: 90%;
         margin: 30px auto;
      }
   @endif

   .progress-bar {
      background-color: #3E3E3E;
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
                        <option selected="selected">Alabama</option>
                        <option>Alaska</option>
                        <option>California</option>
                        <option>Delaware</option>
                        <option>Tennessee</option>
                        <option>Texas</option>
                        <option>Washington</option>
                     </select>
                  </div>
               </div>

               <div class="col-md-6">
                  <div style="padding: 3px;">
                     <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="5" style="width: 50%;"> 50% </div>
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
                                 <textarea class="form-control" id="receta" rows="10" cols="35" placeholder="Describe la prescripción médica ..."></textarea>
                              @else
                                 <textarea class="form-control" id="receta" rows="10" cols="30" placeholder="Describe la prescripción médica ..."></textarea>
                              @endif
                           </div>
                     </section>
                     <h3>PDF </h3>
                     <section>
                           <p>The next and previous buttons help you to navigate through your content.</p>
                     </section>
                  </div>


                  

                  
               </div>
            </div>
            <script type="text/javascript">

               var words = [];
               var medicinesSelected = [];

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
                           finish:     "Prescribir",
                           next:       "Imprimir",
                           previous:   "Prescribir",
                           loading:    "Cargando"
                        }
                     });
                  

                  $('#currentMedicalAppointment').select2({ width: "100%" });
               });
              
               function loadMedicines() {
                  if (document.getElementById('load-medicines').value == "") {

                     $.ajax({
                        method: "get",
                        url: "{{ url('prescriptions/medicinescatalogue')}}",
                        success: function( data ){
                           console.log('Submission was success.');
                           medicinesSelected = data;
                           
                           $.map(data, function (word) {
                              words.push(word.name);
                           });

                           $.map(medicinesSelected, function (word) { 
                              medicinesSelected[word.name] = word.medicine; 
                           });

                           console.log(medicinesSelected);
                           document.getElementById('load-medicines').value = true;

                           $('#receta').textcomplete([{
                              match: /(^|\b)(\w{2,})$/,
                              search: function (term, callback) {
                                 
                                 callback(
                                    $.map(words, function (word) {
                                       document.getElementById('textcomplete-dropdown-1').style.zIndex = "1100";

                                       if(word.indexOf(term) === 0){
                                          console.log('word selected: '+ term);
                                          return word;
                                       }else
                                          return null;
                                    }
                                 ));
                              }, replace: function (word) {
                                 return word + ' ';
                              }
                           }]);

                        }, error: function( data ){
                           console.log('Submission was error.');
                           console.log(data);
                        }
                     });
                     
                     $('#receta').textcomplete([{
                     match: /(^|\b)(\w{2,})$/,
                     search: function (term, callback) {
                        
                        callback(
                           $.map(words, function (word) {
                              document.getElementById('textcomplete-dropdown-1').style.zIndex = "1100";

                              if(word.indexOf(term) === 0){
                                 console.log('word selected: '+ term);
                                 return word;
                              }else
                                 return null;
                           }
                        ));
                     }, replace: function (word) {
                        return word + ' ';
                     }
                  }]);
                     
                  }
               }               
            </script>



         </div>
         <!-- <div class="modal-footer">
            <div class="row">
               <div class="col-md-6">
               </div>
               <div class="col-md-6">
                  <a href="#next" role="menuitem" ></a>
               </div>
            </div>
            
         </div> -->
      </div>
   </div>
</div>

