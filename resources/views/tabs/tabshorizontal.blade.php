<div class="nav-tabs-custom">

    <ul class="nav nav-tabs">
      	<li class="active"><a href="#activity" data-toggle="tab">Detalle</a></li>
      	<li><a href="#Asistant" id="four" data-toggle="tab">Asistentes</a></li>
      	<li><a href="#laborInformation" data-toggle="tab">Consultorios</a></li>
      	<li><a href="#configClinic" data-toggle="tab">Preguntas previa cita</a></li>
    </ul>

    <div class="tab-content">


    	<div class="active tab-pane" role="tabpanel" id="activity">
    		<!-- Form details -->
 	    	<form class="form-horizontal">
				<div class="form-group">
				    <label class="col-sm-3 control-label">Nombre de usuario:</label>
				    <div class="col-sm-9">
				      	<p class="form-control-static">{{ $username2 }}</p>
				    </div>
				</div>
 	    		<div class="form-group">
				    <label class="col-sm-3 control-label">Correo:</label>
				    <div class="col-sm-9">
				      	<p class="form-control-static">{{ $email2 }}</p>
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-sm-3 control-label">Edad:</label>
				    <div class="col-sm-9">
				      	<p class="form-control-static">{{ $age }}</p>
				    </div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Genero:</label>
					<div class="col-sm-9">
						@if($gender == "female")
					      	<p class="form-control-static">{{$gender}} {{ trans('adminlte::adminlte.female') }}</p>
					    @endif
                    	
                    	@if($gender == "male")
                    		<p class="form-control-static">{{ trans('adminlte::adminlte.female') }}</p>
                    	@endif
                    	@if($gender == "other")
                    		<p class="form-control-static">{{ trans('adminlte::adminlte.male') }}</p>
                    	@endif
				    </div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Estado civil:</label>
					<div class="col-sm-9">
						@if($maritalstatus == "single")
					      	<p class="form-control-static">{{ trans('adminlte::adminlte.single') }}</p>
					    @endif
					    @if($maritalstatus == "married")
					      	<p class="form-control-static">{{ trans('adminlte::adminlte.married') }}</p>
					    @endif
					</div>
				</div>
 				<div class="form-group">
				    <label class="col-sm-3 control-label"># Móvil:</label>
				    <div class="col-sm-9">
				      	<p class="form-control-static">{{ $mobile }}</p>
				    </div>
				</div>
				<div class="form-group">
				    <label class="col-sm-3 control-label">Ultima modificación:</label>
				    <div class="col-sm-9">
				      	<p class="form-control-static">{{ $updated_at }}</p>
				    </div>
				</div>
			</form>
 	    </div>





 	    <div class="tab-pane" id="Asistant">
 	    	
            <div class="box-body">
        	    <div class="lockscreen-item pull-right" style="width: 210px !important;">
			      	<div class="input-group">
			        	<div class="form-control" align="center">
			        		<label id="labeltext">Agregar Asistente</label>
			        	</div>
			        	<div class="input-group-btn">
				          	<a class="btn btn-default" data-toggle="modal" data-target="#modalassist">
				          		<i class="fa fa-plus text-muted"></i>
				          	</a>
			        	</div>
			      	</div>
				</div>

				<div id="demo"></div>
            </div>

 	    </div>



 	    <div class="tab-pane" id="laborInformation">
 	    	<div class="box-body"> 	
	          	@if($labor->isEmpty())
			 		<span class="text-black">No hay ningún centro asociado a su cuenta.</span>			
				@else
					<div class="pull-right">
					   	<form action="/doctor/laborInformation/{{$userId}}" method="post">
					   		{{ csrf_field() }}
					   		<button type="submit" class="btn btn-secondary btn-xs"><i class="fa fa-plus"></i> Agregar consultorio</button>
					   	</form>
					</div>
					@foreach($labor->sortByDesc('created_at') as $labor)

						<div class="form-group">	
							<div class="col-sm-8" style="padding-right: 0; padding-left: 0;">
						        <div class="info-box sm bg-gray">
						          	<a href="{{ url('workboardDr/index') }}/{{$labor->id}}">
						          		<span class="info-box-icon sm bg-black">
						          			<i class="fa fa-calendar"></i>
						          		</span>
						          	</a> 
						            <div class="info-box-content sm">
						              	<b>{{ $labor->workplace}}</b> 
						              	<span class="text-black">{{ $labor->country }}, {{ $labor->state }}, {{ $labor->colony }}, {{ $labor->delegation }}, {{ $labor->street }} {{ $labor->streetNumber }}. Código Postal: {{ $labor->postalcode }}</span>
						            </div>
						        </div>
							</div>

							<!-- Image Map -->
							<div class="col-sm-4" style="padding-right: 0; padding-left: 0;">
								<img border="0" src="//maps.googleapis.com/maps/api/staticmap?center={{ $labor->latitude }},{{ $labor->longitude }}&amp;markers=size:small%7Ccolor:black%7Clabel:%7C{{ $labor->latitude }},{{ $labor->longitude }}&amp;zoom=15&amp;style=element:geometry%7Ccolor:0xf5f5f5&amp;size=400x45&amp;key={{ env('GOOGLE_KEY') }}" alt="ubicación"  style="width:100%; height:45px;">	
							</div>
							<!-- ./ Image Map -->
						</div>	

					@endforeach
				@endif
		   </div>			
 	    </div>




 	    <div class="tab-pane" id="configClinic">

     	    <div class="box-body">

     	   <!-- Alert success-->
     	     	<div class="alert alert-success alert-dismissible" style="display: none;">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                <i class="icon fa fa-check"></i>Se ha guardado la pregunta y su configuración correctamente
             	</div>
           <!-- Alert success-->  

           <!-- Alert error-->
     	     	<div class="alert alert-warning alert-dismissible" style="display: none;">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                <i class="icon fa fa-check"></i>Ha ocurrido un error guardando tu pregunta, por favor vuelve a intentaro. Si el fallo persiste envía un caso de soporte.
             	</div>
           <!-- Alert error-->

           		<!-- Field -->
     	    	<div class="input-group">
                	<input type="text" name="question" id="question" class="form-control" placeholder="Escriba una pregunta para la información necesaria previa a la cita" required>
                    <span class="input-group-btn">
                    	<button class="btn btn-flat btn-secondary" onclick="nextQues();"><span class="fa fa-plus"></span></button>
                    </span>
             	</div>
             	<!-- Field -->

     	    	<br/>


     	    	<div class="well well-sm" id="box-question">
     	    		<label class="text-muted">Preguntas agregadas</label>
     	    		<div id="searchQuestions">
     	    			@foreach($questions as $quest)
     	    				<div>
     	    					<a href="{{ url('doctor/deletequestion') }}/{{ $quest->id }}" class="btn btn-sm btn-flat text-muted"><span class="fa fa-trash"></span> </a>&nbsp;
     	    					{{ $quest->question }} 
     	    				</div>
     	    			@endforeach
     	    		</div>	
     	    	</div>

     	    	<div style="display: none;" id="box-question-save" data-toggle="buttons">
					<script type="text/javascript">
						$(document).ready(function () {
						    var navListItems = $('div.setup-panel div a'), // tab nav items
						            allWells = $('.setup-content'), // content div
						            allNextBtn = $('.nextBtn'), // next button
						            stepb = $('.setup-content');

						    allWells.hide(); // hide all contents by defauld

						    navListItems.click(function (e) {
						        e.preventDefault();
						        var $target = $($(this).attr('href')),
						                $item = $(this);

						        if (!$item.hasClass('disabled')) {
						            navListItems.removeClass('btn-secondary').addClass('btn-default');
						            $item.addClass('btn-secondary');
						            allWells.hide();
						            $target.show();
						            $target.find('input:eq(0)').focus();
						        }
						    });
						    // next button
						    allNextBtn.click(function(){
						    	$('#preview').show();
						        	var curStep = $(this).closest(".setup-content"),
						            curStepBtn = curStep.attr("id"),
						            //nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
						            curInputs = curStep.find("input[type='text'],input[type='email'],input[type='password'],input[type='url']"),
						            isValid = true;

						         $('#readquestion').html($('#question').val()); 

						         	if($("input[name='type']:checked").val() ==  'texto')  
						        		 $('#readresponse').html('<textarea class="form-control"></textarea>');

						        	if($("input[name='type']:checked").val() ==  'radio'){
						        		 $('#readresponse').html('');
						        			var classopt = document.getElementsByClassName("opr");

										 for(i=0;i<classopt.length;i++){
										 	$('#readresponse').append('<input type="radio" name="radio">&nbsp;'+ classopt[i].innerHTML + '<br>');
								  		  }
						        	}

						        	if($("input[name='type']:checked").val() ==  'checkbox'){
						        		 $('#readresponse').html('');
						        			var classopt = document.getElementsByClassName("opc");

										 for(i=0;i<classopt.length;i++){
										 	$('#readresponse').append('<input type="checkbox" name="checkbox">&nbsp;'+ classopt[i].innerHTML + '<br>');
								  		  }
						        	}


						        // move to next step if valid
						        if (isValid)
						            nextStepWizard.removeAttr('disabled').trigger('click');
						    });
							$('div.setup-panel div a.btn-circle').click(function(){
						    	$('#preview').hide();
						    	 allNextBtn.hide();
						    	 if($('#radio:checked').val() == 'radio'){
								    	 if($('#addOpt').html().length > 0){
 										    	 $('.nextBtn.step1').show() 	
 										    	 $('#addOptcheck').html('');
										    	 }
										    	 else 
 										    	 $('#addOptcheck').html('');
						    	 	}

						    	 if($('#checkbox:checked').val() == 'checkbox'){
								    	 if($('#addOptcheck').html().length > 0){
 										    	 $('.nextBtn.step2').show() 	
 										    	 $('#addOpt').html('');
										    	 }
										     else 
										     	 $('#addOpt').html('');   	 
						    	 	}

						    	 if($('#texto:checked').val() == 'texto'){
						    	 		 $('.nextBtn.step3').show()
								    	 $('#addOpt').html('');
								    	 $('#addOptcheck').html('');
						    	 	}
							});


						    $('div.setup-panel div a.btn-secondary').trigger('click');
						});
					</script>

     	    	<div align="right"><span class="fa fa-close btn btn-sm text-muted" onclick="cancelQuestion();"></span></div>
				<label class="text-muted">Configuración de respuestas</label><br>
				<div class="stepwizard">
	                <div class="stepwizard-row setup-panel">
	                    <div class="stepwizard-step">
	                        <a href="#step-1" type="button" class="btn btn-secondary btn-circle" title="Selección única"><i class="glyphicon glyphicon-check"></i></a>
	                    </div>
	                    
	                    <div class="stepwizard-step">
	                        <a href="#step-2" type="button" class="btn btn-default btn-circle" title="Selección múltiple"><i class="glyphicon glyphicon-list-alt"></i></a>
	                    </div>
	                    
	                    <div class="stepwizard-step">
	                        <a href="#step-3" type="button" class="btn btn-default btn-circle" title="Texto abierto"><i class="fa fa-pencil"></i></a>
	                    </div>
	                    
	                </div>
	            </div>
	            <br>
           		<div class="row setup-content" id="step-1">
                	<div class="col-xs-12">
                    	<div class="col-md-12" >
	                    	<div class="row">
	                    		<label for="radio" class="btn btn-default btn-sm btn-flat">
	                    			<span class="glyphicon glyphicon-ok"></span>
	                    			<input type="radio" name="type" value="radio" id="radio" style="visibility: hidden;"/>
	                    			<b>Selección única</b>
	                    		</label>
	                    		<button class="btn btn-secondary btn-flat nextBtn step1 pull-right" type="button" style="display: none;">Vista previa</button>
	                    	</div>
                    		<br/>
                    			
							<div class="input-group input-group-sm">
			                  <input type="text"  id="opt" class="form-control" placeholder="Escriba una opción" required autocomplete="off">
			                    <span class="input-group-btn">
			                    	<button class="btn btn-flat btn-default btn-sm" onclick="add();"><span class="fa fa-plus"></span> Agregar opción</button>
			                    </span>
			                </div>

			                <br>
			                <div id="addOpt"></div>
			                <br>

                         <!-- <span class="text-muted fa fa-question-circle">Respuestas de alternativa simple (dicotómicas), cuando sólo es posible una respuesta (sí o no, hombre o mujer)</span>
                       --></div>  
                     </div> 
			    </div>

           <div class="row setup-content" id="step-2">
                <div class="col-xs-12">
                    <div class="col-md-12">
                    <div class="row">
                      <label for="checkbox" class="btn btn-default btn-sm btn-flat"><span class="glyphicon glyphicon-ok"></span>
                      	<input type="radio" name="type" value="checkbox" id="checkbox" autocomplete="off" style="visibility: hidden;">
                    			<b>Selección múltiple</b>
                      </label>
                   <button class="btn btn-secondary btn-flat nextBtn step2 pull-right" type="button" style="display: none;">Vista previa</button>   
                  </div><br>
								<div class="input-group input-group-sm">
				                  <input type="text"  id="optcheck" class="form-control" placeholder="Escriba una opción" required autocomplete="off">
				                    <span class="input-group-btn">
				                    	<button class="btn btn-flat btn-default btn-sm" onclick="addcheck();"><span class="fa fa-plus"></span> Agregar opción</button>
				                    </span>
				                </div><br>
				                <div id="addOptcheck"></div><br>
                   </div>
                </div>    
           </div>

           <div class="row setup-content" id="step-3">
                <div class="col-xs-12">
                    <div class="col-md-12">
                     <div class="row">	
                     <label for="texto" class="btn btn-default active btn-sm btn-flat">
                    	<span class="glyphicon glyphicon-ok"></span>
                    	<input type="radio" name="type" value="texto" id="texto" style="visibility: hidden;" checked="checked" onchange="if($('#texto:checked').val() == 'texto') $('.nextBtn.step3').show()">
                     		<b>Texto abierto</b>
                     	</label>
                     	<button class="btn btn-secondary btn-flat nextBtn step3 pull-right" type="button" style="display: none;">Vista Previa</button>
                     </div>
                </div>        <!-- content go here -->

                </div>    
                      
           </div>
           	<div class="row" id="preview" style="display: none;">
                <div class="col-xs-12">
                    <div class="col-md-12 well well-sm">
	                    <div class="row">
	                     	<div class="col-sm-12">
	                     		<h5><b>Vista Previa</b></h5>

	                    	 	<label class="text-muted" id="readquestion"></label><br>
	                          	<div id="readresponse"></div>
	                     	</div>
	                 	</div><br>
                           <button class="btn btn-secondary btn-flat pull-right" type="button" id="finishQuestion">Guardar configuración</button>
                     	</div>
                </div>             
           	</div>
     	   </div>	



     	    </div>
 	    </div>
 	</div>
</div>
