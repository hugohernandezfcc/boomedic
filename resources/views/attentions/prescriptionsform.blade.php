


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
        <textarea id="textareatest"></textarea>

        <script type="text/javascript">
          // Shared strategy for all demos.
          window.emojiStrategy = {
            id: 'emoji',
            match: /(^|\s):([a-z0-9+\-\_]*)$/,
            search: function (term, callback) {
              callback(Object.keys(emojis).filter(function (name) {
                return name.startsWith(term);
              }));
            },
            template: function (name) {
              return '<img src="' + emojis[name] + '"></img> ' + name;
            },
            replace: function (name) {
              return '$1:' + name + ': ';
            }
          };

          var editor = new Textarea(document.getElementById('textareatest'));

          var textcomplete = new Textcomplete(editor);
          textcomplete.register([emojiStrategy]);
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