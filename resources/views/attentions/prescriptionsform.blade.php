  <style type="text/css">
    @if(!$isMobile)
      .modal-dialog {
        width: 90%;
        margin: 30px auto;
      }
    @endif
  </style>



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
           

              $(document).ready(function(){
                  jQuery.noConflict(false);

                  var words = ['ANSIL 5 MG TABLETAS 30 UNIDADES', 'TENSINOR H 160 MG / 25 MG TABLETAS DE 20 UNIDADES ','DAZEL DUO PACK 40 MG TABLETAS DE 20 UNIDADES','FLUCONAZOL 150 MG CAPSULA DE 1 UNIDAD','DICLOFENACO 10 TAB 50 MG','ADIABET 500 5 MG CAJA X 30 TABS', 'ADIABET PLUS 1000 5 MG CAJA X 30 TABS ', 'ADIABET PLUS 2.5 MG CAJA X 30 TABS', 'microsoft', 'yahoo'];

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
            </script>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
         </div>
      </div>
    <!-- /.modal-content -->
   </div>
  <!-- /.modal-dialog -->
</div>

