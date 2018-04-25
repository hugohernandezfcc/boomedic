@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

@stop

@section('content')

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.textcomplete/1.8.4/jquery.textcomplete.js"></script>

	<div class="row">
        <div class="col-md-3">
        	
        	<a class="btn btn-secondary btn-block btn-flat margin-bottom" data-toggle="modal" data-target="#prescription-form-modal">Generar receta </a>
        	


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
       <textarea class="editable" id="one"></textarea>

        <script type="text/javascript">
        

        $(document).ready(function(){
          jQuery.noConflict(false);

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


        	@if($isMobile)
				<div class="box box-solid collapsed-box">
			@else
				<div class="box box-solid">
			@endif

		        <div class="box-header with-border">
		            <h3 class="box-title">Opciones</h3>

		            <div class="box-tools">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse">
		                	@if($isMobile)
								<i class="fa fa-plus"></i>
							@else
		                		<i class="fa fa-minus"></i>
							@endif
		                </button>
		            </div>
		        </div>
		        <div class="box-body no-padding">
		            <ul class="nav nav-pills nav-stacked">
		                <li >
		                	<a href="#">
		                		<i class="fa fa-comments"></i> Comentarios <span class="label label-primary pull-right">0</span>
		                	</a>
		                </li>
		                <li class="header">VISTAS</li>
		                <li>
		                	<a href="#">
		                		<i class="fa fa-calendar-minus-o"></i> Ultimos 7 días
		                	</a>
		                </li>
		                <li class="active">
		                	<a href="#">
		                		<i class="fa fa-edit"></i> Todas las recetas
		                	</a>
		                </li>
		                <li class="header">CONFIGURACIÓN</li>
		                <li class="active">
		                	<a href="#">
		                		<i class="fa fa-config"></i> Formato de receta
		                	</a>
		                </li>
		            </ul>
		        </div>
		    </div>

		</div>
		<div class="col-md-9">

			<div class="box" >
			  	<div class="box-header with-border">
				    <h3 class="box-title">Solicitudes de información</h3>
			  	</div>
			  	<div class="box-body">
			  		<ul class="nav nav-stacked">
						<li><a > Hugo hernández </a></li>
						<li><a > Hugo hernández </a></li>
						<li><a > Hugo hernández </a></li>
						<li><a > Hugo hernández </a></li>
						<li><a > Hugo hernández </a></li>
						<li><a > Hugo hernández </a></li>
						<li><a > Hugo hernández </a></li>
						<li><a > Hugo hernández </a></li>
						<li><a > Hugo hernández </a></li>
					</ul>
				</div>
			</div>

		</div>
	</div>


@stop