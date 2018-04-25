  <style type="text/css">
    @if(!$isMobile)
      .modal-dialog {
        width: 90%;
        margin: 30px auto;
      }
    @endif

    #textcomplete-dropdown-1{
      z-index: 1100;
    }
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

        legalicen la mota putos...
        <br/>
       <textarea class="receta" id="receta" ></textarea>

        <script type="text/javascript">
        

        $(document).ready(function(){
          jQuery.noConflict(false);

          $('#receta').textcomplete([{
            match: /(^|\b)(\w{2,})$/,
            search: function (term, callback) {
              var words = ['google', 'google1','google13','goog3le1','google1','google1', 'facebook', 'github', 'microsoft', 'yahoo'];
              
              callback($.map(words, function (word) {

                document.getElementById('textcomplete-dropdown-1').style.zIndex = "1100";

                if(word.indexOf(term) === 0)
                  return word;
                else
                  return null;
                  
              }));
            },
            replace: function (word) {
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

