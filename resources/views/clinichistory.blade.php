@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

@stop

@section('content')
	<script type="text/javascript" src="{{asset('jquery_steps/jquery.steps.js')}}"></script>
	<script type="text/javascript" src="{{asset('jquery_steps/jquery.steps.js')}}"></script>
	<div class="box">
	  	<div class="box-header with-border">
		    <h3 class="box-title">Historía clínica</h3>
	  	</div>
		<div class="box-body">
			<div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-default" style="border-top-color: black;">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        Antecedentes heredofamiliares
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="box-body">
                      
                    	<script type="text/javascript">
						    $("#example-basic").steps({
						        headerTag: "h3",
						        bodyTag: "section",
						        transitionEffect: "slideLeft",
						        autoFocus: true
						     //    labels: {
							    //     cancel: "Cancelar",
							    //     current: "Paso actual:",
							    //     pagination: "Paginación",
							    //     finish: "Final",
							    //     next: "Siguiente",
							    //     previous: "Regresar",
							    //     loading: "Cargando ..."
							    // }
						    });
						</script>
						 

					    <div id="example-basic">
					        <h3>Keyboard</h3>
					        <section>
					            <p>Try the keyboard navigation by clicking arrow left or right!</p>
					        </section>
					        <h3>Effects</h3>
					        <section>
					            <p>Wonderful transition effects.</p>
					        </section>
					        <h3>Pager</h3>
					        <section>
					            <p>The next and previous buttons help you to navigate through your content.</p>
					        </section>
					    </div>



                    </div>
                  </div>
                </div>
                <div class="panel box box-default" style="border-top-color: black;">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        Collapsible Group Danger
                      </a>
                    </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="box-body">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                      wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                      eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                      assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                      nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                      farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                      labore sustainable VHS.
                    </div>
                  </div>
                </div>
                <div class="panel box box-default" style="border-top-color: black;">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                        Collapsible Group Success
                      </a>
                    </h4>
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse">
                    <div class="box-body">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                      wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                      eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                      assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                      nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                      farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                      labore sustainable VHS.
                    </div>
                  </div>
                </div>
              </div>
		</div>	  	
	</div>

	

@stop