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

            <div class="form-group">
               <textarea class="form-control" id="receta" rows="10" cols="30" placeholder="Describe la prescripción médica ..."></textarea>
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

                              if(word.indexOf(term) === 0)
                                 return word;
                              else
                                 return null;
                           }
                        ));
                     }, replace: function (word) {
                        return word + ' ';
                     }
                  }]);
               });
              
              function loadMedicines() {
                 document.getElementById('load-medicines').value = true;

                 $.ajax({
                     method: "get",
                     url: '/previousattention/medicinescatalogue',
                     success: function( data ){
                        console.log('Submission was successful.');
                        console.log(data);
                        medicinesSelected = data;
                        console.log(medicines);
                        
                        $.map(medicines, function (word) {

                           words.push(word.name);

                        });
                     },
                     error: function( data ){
                        console.log('Submission was error.');
                        console.log(data);
                     }
                  });

                 /**
                  * .done(function( medicines ) {
                     medicinesSelected = medicines;
                     console.log(medicines);
                     
                     $.map(medicines, function (word) {

                        words.push(word.name);

                     });

                 })
                  */
                    

              }
            </script>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
         </div>
      </div>
   </div>
</div>

