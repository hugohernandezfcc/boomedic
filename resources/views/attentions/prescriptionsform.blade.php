<style type="text/css">
   @if(!$isMobile)
      .modal-dialog {
         width: 90%;
         margin: 30px auto;
      }
   @endif
</style>

<input type="hidden" id="load-medicines" value="false" />

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
               <div class="col-md-6">
                  
               </div>
            </div>
            <br /><br />
            <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                     <!-- The validation is to change the cols number in textarea -->
                     @if($isMobile)
                        <textarea class="form-control" id="receta" rows="10" cols="35" placeholder="Describe la prescripción médica ..."></textarea>
                     @else
                        <textarea class="form-control" id="receta" rows="10" cols="30" placeholder="Describe la prescripción médica ..."></textarea>
                     @endif
                  </div>
               </div>
            </div>
            <script type="text/javascript">

               var words = [];
               var medicinesSelected = [];

              $(document).ready(function(){
                  jQuery.noConflict(false);


                  $('#receta').textcomplete([{
                     match: /(^|\b)(\w{2,})$/,
                     search: function (term, callback) {
                        
                        callback(
                           $.map(words, function (word) {
                              document.getElementById('textcomplete-dropdown-1').style.zIndex = "1100";

                              if(word.indexOf(term) === 0){
                                 console.log('Selected: ' + word);
                                 return word;
                              }else
                                 return null;
                           }
                        ));
                     }, replace: function (word) {
                        return word + ' ';
                     }
                  }]);

                  $('#currentMedicalAppointment').select2({ width: "100%" });
               });
              
               function loadMedicines() {

                  if (document.getElementById('load-medicines').value == false) {
                     $.ajax({
                        method: "get",
                        url: '/prescriptions/medicinescatalogue',
                        success: function( data ){

                           medicinesSelected = data;
                           
                           $.map(data, function (word) {
                              words.push(word.name);
                           });

                           $.map(medicinesSelected, function (word) { 
                              medicinesSelected[word.name] = word.medicine; 
                           });

                           console.log(medicinesSelected);
                           document.getElementById('load-medicines').value = true;
                        }, error: function( data ){
                           console.log('Submission was error.');
                           console.log(data);
                        }
                     });
                  }
               }
            </script>
         </div>
         <div class="modal-footer">
            <div class="row">
               <div class="col-md-6">
               </div>
               <div class="col-md-6">
                  <button type="button" class="btn btn-secondary btn-block btn-flat margin-bottom">Prescribir</button>
               </div>
            </div>
            
         </div>
      </div>
   </div>
</div>

