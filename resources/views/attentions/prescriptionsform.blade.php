


@if(!$isMobile)
  <style type="text/css">
    .modal-dialog {
      width: 90%;
      margin: 30px auto;
    }
  </style>
@endif



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
        <textarea id="textareatest"></textarea>



        <script type="text/javascript">
          $('#textareatest').textcomplete([
    { // tech companies
        words: ['apple', 'google', 'facebook', 'github'],
        match: /\b(\w{2,})$/,
        search: function (term, callback) {
            callback($.map(this.words, function (word) {
                return word.indexOf(term) === 0 ? word : null;
            }));
        },
        index: 1,
        replace: function (word) {
            return word + ' ';
        }
    }
]);
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

<script type="text/javascript" src="{{ asset('jquery-textcomplete/packages/jquery-textcomplete/src/main.js') }}"></script>

