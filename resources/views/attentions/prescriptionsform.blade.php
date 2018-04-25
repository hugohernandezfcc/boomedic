


@if(!$isMobile)
  <style type="text/css">
    .modal-dialog {
      width: 90%;
      margin: 30px auto;
    }
  </style>
@endif


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.textcomplete/1.8.4/jquery.textcomplete.js"></script>
  <script type="text/javascript" src="https://cdn.tinymce.com/4/tinymce.min.js"></script>



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
       <textarea class="editable" id="one"></textarea>

        <script type="text/javascript">
        

        $(document).ready(function(){
          tinymce.init({ selector:'#three' });
          $('.editable').textcomplete([{
            match: /(^|\b)(\w{2,})$/,
            search: function (term, callback) {
              var words = ['google', 'facebook', 'github', 'microsoft', 'yahoo'];
              callback($.map(words, function (word) {
                return word.indexOf(term) === 0 ? word : null;
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


