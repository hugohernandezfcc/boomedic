<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.textcomplete/1.8.4/jquery.textcomplete.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.js"></script>

<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-steps/jquery.steps.css') }}">
@if($agent->isMobile())
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
          	<li id="medicalAttentionTab" style="display: none;"><a href="#medicalAttentionLink" data-toggle="tab">Atención médica </a> </li>
          	<li class="active"><a href="#activity" data-toggle="tab">Detalle</a></li>
          	<li><a href="#family" id="familyOption" data-toggle="tab">Familia</a></li>
          	<li><a href="#address" onclick="initMapAddressUser();" data-toggle="tab">Dirección</a></li>
          	<li><a href="#clinichistory" data-toggle="tab">Historia Clínica</a></li>
          	<li><a href="#history" data-toggle="tab">Registro de Actividad</a></li>
        </ul>

        <div class="tab-content">

        	<div class="tab-pane" id="medicalAttentionLink" style="display: none;">

        		<form class="form-horizontal">
				  	<div class="form-group">
				    	<label for="HeightField" class="col-sm-2 control-label">Estatura:</label>
					    <div class="col-sm-10">
					      	<input type="text" required="true" class="form-control" id="HeightField" placeholder="1.70 m">
					    </div>
				  	</div>
				  	<div class="form-group">
				    	<label for="WeightField" class="col-sm-2 control-label">Peso:</label>
					    <div class="col-sm-10">
					      	<input type="text" required="true" class="form-control" id="WeightField" placeholder="73 kg">
					    </div>
				  	</div>

				  	<div class="form-group">
					  	<label for="temperatureField" class="col-sm-2 control-label">Temp. (°C):</label>
						 <div class="col-sm-10">
						 	<div class="input-group">
						    	<div class="input-group-btn">
						        	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						        		Modo <span class="caret"></span>
						        	</button>
						        	<ul class="dropdown-menu">
						          		<li><a href="#">Oral</a></li>
						          		<li><a href="#">Axilar</a></li>
						          		<li><a href="#">Rectal</a></li>
						          		<li><a href="#">Frontal</a></li>
						        	</ul>
						      	</div>
					      		<input type="text" required="true" class="form-control" id="temperatureField" placeholder="73 kg">
					      	</div>
					    </div>
					</div>

				  	
				  	<div class="form-group">
				    	<label for="cranial_capacityField" class="col-sm-2 control-label">C.Craneal (CC):</label>
					    <div class="col-sm-10">
					      	<input type="text" class="form-control" id="cranial_capacityField" placeholder="72 cm">
					    </div>
				  	</div>
				  	<div class="form-group">
				    	<label for="waist_diameterField" class="col-sm-2 control-label">D. de Cintura:</label>
					    <div class="col-sm-10">
					      	<input type="text" class="form-control" id="waist_diameterField" placeholder="92 cm">
					    </div>
				  	</div>

				  	<div class="form-group">
					  	<label for="paField" class="col-sm-2 control-label">Presión Arterial (PA):</label>
						<div class="col-sm-10">
					  		<div class="input-group" >
						      	<span class="input-group-btn">
						        	<button class="btn btn-default" type="button">Estable</button>
						      	</span>
						      	<input type="text" id="paField" class="form-control" placeholder="120/80 ...">
					      	</div>
					    </div>
					</div>
					<div class="form-group">
					  	<label for="hearRateField" class="col-sm-2 control-label">Frec. Cardiaca (FC):</label>
						<div class="col-sm-10">
					  		<div class="input-group" >
						      	<span class="input-group-btn">
						        	<button class="btn btn-default" type="button">Estable</button>
						      	</span>
						      	<input type="text" id="hearRateField" class="form-control" placeholder="60 - 100">
					      	</div>
					    </div>
					</div>

				    <div class="form-group">
					  	<label for="frecRepField" class="col-sm-2 control-label">Frec. Respiratoria (FC):</label>
						<div class="col-sm-10">
					  		<div class="input-group" >
						      	<span class="input-group-btn">
						        	<button class="btn btn-default" type="button">Estable</button>
						      	</span>
						      	<input type="text" id="frecRepField" class="form-control" placeholder="12 - 16">
					      	</div>
					    </div>
					</div>

					<div class="progress-bar" id="progressCompleteRecipe" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="5" style="width: 10%;"> 10% </div>
					
					<input type="hidden" id="load-medicines" value="" />
					<div id="wizardPrescription">
	                     <h3>Receta </h3>
	                     <section>
	                           <!-- The validation is to change the cols number in textarea -->
	                           <div class="form-group">
	                              @if($agent->isMobile())
	                                 <textarea class="form-control" id="receta" rows="8" cols="32" onkeypress="controlledActionsOnTheWrite(this.value);" placeholder="Describe la prescripción médica ..."></textarea>
	                              @else
	                                 <textarea class="form-control" id="receta" rows="8" cols="34" onkeypress="controlledActionsOnTheWrite(this.value);" placeholder="Describe la prescripción médica ..."></textarea>
	                              @endif
	                           </div>
	                     </section>
	                     <h3>PDF </h3>
	                    <section>

	                        @if($agent->isMobile())
	                          <center><iframe id="framepdfprescription" width="111%" style="height: 300px;"></iframe></center>
	                        @else
	                          <center><iframe id="framepdfprescription" width="100%" style="height: 300px;"></iframe></center>
	                        @endif
	                    </section>
	                </div>

	                <script type="text/javascript">
		               /**
		                * Se guardan los nombre de cada medicamento cuando se abre el Modal
		                * @type {Array}
		                */
		               var words = [];
		               /**
		                * medicinesToSelect arreglo donde se encuentra la descripción total de todos los medicamentos que están 
		                * disponibles para seleccionar y con el nombre se puede acceder a la información completa
		                */
		               var medicinesToSelect = [];
		               /**
		                * medicinesSelected medicamentos seleccionados en la receta.
		                */
		               var medicinesSelected = [];
		               /**
		                * Contador utilizado para identificar si un doctor se encuentra escribiendo o borrando en la receta.
		                */
		               var lengthTextBody = 0;
		               /**
		                * Función que reduce la escritura de selectores por id.
		                * @param  {[type]} argument [Dom element]
		                * @return {[type]}          [element selected]
		                */
		               function byId(argument) {
		                  return document.getElementById(argument);
		               }
		               /**
		                * Utilizado para avanzar la barra de receta en cuanto se abra el Modal.
		                */
		               $('#prescription-form-modal').on('shown.bs.modal', function () {
		                  byId('progressCompleteRecipe').setAttribute("style", "width: 30%;");
		                  byId('progressCompleteRecipe').innerHTML = "30%";
		               });

		               $(document).ready(function(){
		                  jQuery.noConflict(false);
		                  $("#wizardPrescription").steps({
		                        headerTag: "h3",
		                        bodyTag: "section",
		                        transitionEffect: "slideLeft",
		                        cssClass: "wizard",
		                        autoFocus: true,
		                        labels: {
		                           pagination: "Paginación",
		                           finish:     "Enviar",
		                           next:       "Revisar",
		                           previous:   "Editar",
		                           loading:    "Cargando"
		                        },
		                        showFinishButtonAlways: true,
		                        onStepChanged: function (event, currentIndex, priorIndex) { 
		                           if(currentIndex){
		                              byId('linkfinish').href = "#finish";
		                              byId('optionlinkfinish').removeAttribute("class");
		                              byId('progressCompleteRecipe').setAttribute("style", "width: 90%;");
		                              byId('progressCompleteRecipe').innerHTML = "90%";
		                              byId('framepdfprescription').src = "{{ url('prescriptions/pdf')}}";
		                           }else{
		                              byId('linkfinish').href = "return false;";
		                              byId('optionlinkfinish').className = "disabled";
		                              byId('progressCompleteRecipe').setAttribute("style", "width: 50%;");
		                              byId('progressCompleteRecipe').innerHTML = "50%";
		                           }
		                           console.log(currentIndex); // 1
		                           console.log(priorIndex); // 0
		                        },
		                        onFinished: function (event, currentIndex) { 
		                           console.log('terminado...' + event);
		                           console.log('terminado...' + currentIndex);
		                           byId('progressCompleteRecipe').setAttribute("style", "width: 100%;");
		                           byId('progressCompleteRecipe').innerHTML = "100%";
		                           
		                           
		                        }
		                     });
		                  
		                  /**
		                   * Activa el framework select2 para la selección de la cita a la cual se dirigirá la receta.
		                   * @type {String}
		                   */

		                  
		                  /**
		                   * Permite que pueda establecer un id al botón y <LI> element de finalizar.
		                   */
		                  var getLinks = document.getElementsByTagName('a');
		                  for (var i = getLinks.length - 1; i >= 0; i--) 
		                     if(getLinks[i].href == "{{ url('prescriptions#finish')}}")
		                        getLinks[i].setAttribute('id', "linkfinish");
		                     
		                  byId('linkfinish').parentNode.setAttribute('id', "optionlinkfinish");
		                  byId('optionlinkfinish').className = "disabled";
		                  byId('linkfinish').href = "return false;";
		                  
		               });
		              	
		               /**
		                * Función responsable de identificar los movimientos de escritura sobre la receta.
		                * @param  string textBody [valor actual del textarea]
		                */
		               function controlledActionsOnTheWrite(textBody) {
		                  var textBodyArray = textBody.split(" ");
		                  if (textBody.length <= lengthTextBody) {
		                     /**
		                      * Agregar si existe la sustancia en el catalogo pero no fue seleccionada y se encuentra escrita en el textarea.
		                      * (Validando para ver si lo agrego al array como optional)
		                      * @param  {[type]} 
		                      */
		                     $.map(words, function (medicine) {
		                        
		                        if(textBodyArray.indexOf(medicine.split(" ")[0]) > 0){
		                           console.log( 'Se encontro: ' + medicine);
		                           return medicine;
		                        }
		                        //return word.indexOf(term) === 0 ?  word : null;
		                     });
		                     console.log('borrando...');
		                  }else if(textBody.length >= lengthTextBody)
		                           console.log('escribiendo...');
		                  
		                  
		                  lengthTextBody = textBody.length;
		                  var toDeleted = [];
		                  /**
		                   * En caso de que se encuentre en el array y no en el textarea eliminarla del array medicinesSelected.
		                   */
		                  $.map(medicinesSelected, function (medicine) {
		                     textBody.toLowerCase();
		                     if(textBody.indexOf(medicine.name) < 0)
		                        toDeleted.push(medicine.name);
		                     
		                  });
		                  if(toDeleted.length > 0)
		                     for (var o = toDeleted.length - 1; o >= 0; o--) 
		                        for (var i = medicinesSelected.length - 1; i >= 0; i--) 
		                           if (medicinesSelected[i].name == toDeleted[o]) 
		                              medicinesSelected.splice(i, 1);
		               }
		               /**
		                * La función se ejecuta solo cuando se abre el modal para no hacer solicitudes que no sean
		                * estrictamente necesarias.
		                *
		                * @textcomplete
		                *
		                * Aquí se activa el framework textcomplete que predice las palabras que se escriben para proponer
		                * opciones de medicamentos.
		                */
		               function loadMedicines() {
		                  if (byId('load-medicines').value == "") {
		                     $.ajax({
		                        method: "get",
		                        url: "{{ url('prescriptions/medicinescatalogue')}}",
		                        success: function( data ){
		                           console.log('Submission was success.');
		                           medicinesToSelect = data;
		                           
		                           $.map(data, function (word) {
		                              words.push(word.name.charAt(0).toUpperCase() + word.name.slice(1));
		                              words.push(word.name.toUpperCase());
		                              words.push(word.name);
		                           });
		                           $.map(medicinesToSelect, function (word) { 
		                              medicinesToSelect[word.name] = word.medicine; 
		                           });
		                           console.log(medicinesToSelect);
		                           byId('load-medicines').value = true;

		                           $('#receta').textcomplete([{
		                              match: /(^|\b)(\w{2,})$/,
		                              search: function (term, callback) {
		                                 
		                                 callback(
		                                    $.map(words, function (word) {
		                                       byId('textcomplete-dropdown-1').style.zIndex = "1100";
		                                       return word.indexOf(term) === 0 ?  word : null;
		                                    }
		                                 ));
		                              }, replace: function (word) {
		                                 word = word.toLowerCase();
		                                    
		                                 // Validar que si esta seleccionada no agregue más de una versión al array medicinesSelected.
		                                 $.map(medicinesSelected, function (medicineSelected) {
		                                    if(word == medicineSelected.name){
		                                       console.log('Words selected but not added one more time: ' + word);
		                                       return word + ' ';
		                                    }
		                                 });
		                                 var record = {
		                                    "id"     : medicinesToSelect[word].split("---")[1].split(':')[1],
		                                    "name"   : medicinesToSelect[word].split("---")[0].split(':')[1]
		                                 };
		                                 medicinesSelected.push(record);
		                                 //name:adiamyl plus 4 / 1000 mg caja x 20 tabs---id:25
		                                 console.log('Words selected: ');
		                                 console.log(medicinesSelected);
		                                 return word + ' ';
		                              }
		                           }]);
		                        }, error: function( data ){
		                           console.log('Submission was error.');
		                           console.log(data);
		                           if(data.error == "Unauthenticated.")
		                              window.location.href = "{{ url('/login') }}";
		                           
		                        }
		                     });
		                  }
		               }               
		            </script>

				</form>
        		

        		<div class="row">
        			<div class="col-md-6">
        				<a href="#" onclick="medicalAttention('tabsBlade');" class="btn btn-default btn-block">
	                		Cancelar
	                	</a>
        			</div>
        			<div class="col-md-6">
        				<a href="#" class="btn btn-secondary btn-flat btn-block">
	                		Guardar
	                	</a>
        			</div>
        		</div>
        	</div>

			<div class="active tab-pane" role="tabpanel" id="activity">
				<!-- Form details -->
		    	<form class="form-horizontal">
					<div class="form-group">
					    <label class="col-sm-3 control-label">Nombre de usuario:</label>
					    <div class="col-sm-9">
					      	<p class="form-control-static">{{ $pusername }}</p>
					    </div>
					</div>
			    		<div class="form-group">
					    <label class="col-sm-3 control-label">Edad:</label>
					    <div class="col-sm-9">
					      	<p class="form-control-static">{{ $agep }}</p>
					    </div>
					</div>
					<div class="form-group">
					    <label class="col-sm-3 control-label">Ocupación:</label>
					    <div class="col-sm-9">
					      	<p class="form-control-static">{{ $occupation }}</p>
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
					    <label class="col-sm-3 control-label">Escolaridad:</label>
					    <div class="col-sm-9">
					      	<p class="form-control-static">{{ $scholarship }}</p>
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


		    <div class="tab-pane" id="family">
				         	    	

		    	<div id="diagramFamily"></div>


		    	<!-- modals add family member & session as child -->
		    	
		    	@include('modals.addFamilyMember')
		    	@include('modals.sessionAsParentChild')
		    	
		    	<!-- modals add family member & session as child -->

		    	<script type="text/javascript">
		    		
		    		$('#familyOption').on('click', function(e) {
			 				e.preventDefault();
			 				document.getElementById('diagramFamily').innerHTML='';
						+ function(d3) {
				/* Para centrar globos charge junta globos secundarios o los exparce más, y variable w, restarle o sumarl dependiendo el panel en donde se ve */			
						var swatches = function(el) {
							var circleWidth = 45;	
							var charge = -700;//800
							var h = 0;
							var w= 0;
					        if("@php echo $agent->isMobile(); @endphp"){
					            //var mensaje2 = "@php echo $agent->version('Android'); @endphp";
					              h= window.screen.availHeight;
								  w= window.screen.availWidth;
					          
					            if(h >= 1000 && h <= 1300){
					            	circleWidth = 30;
									charge = -300;
					                h = h*0.20;
					                h = Math.floor(h);
					                w = w*0.40;
					                w = Math.floor(w);
					                  //alert("Altura: "+h + "anchura " + w);
					            }else if(h>=1800){
					              h-= 1840;
					              w-= 1200;
					             circleWidth = 30;
								 charge = -300;
					            }else{
					              h-=315;
					              w-=100;
					              circleWidth = 30;
								 charge = -300;
					            }
					       	 }else{
					          h = window.screen.availHeight-375;
					          w = window.screen.availWidth-550;//100
					           circleWidth = 53;
					        }

							    w = w;
								h = h;

									    

					    var palette = {
					      "lightgray": "#819090",
					      "gray": "#708284",
					      "mediumgray": "#808486",
					      "darkgray": "#272B2C",
					      "darkblue": "#0A2933",
					      "darkerblue": "#042029",
					      "paleryellow": "#FCF4DC",
					      "paleyellow": "#EAE3CB",
					      "yellow": "#A57706",
					      "orange": "#BD3613",
					      "red": "#D11C24",
					      "pink": "#C61C6F",
					      "purple": "#595AB7",
					      "blue": "#2176C7",
					      "green": "#259286",
					      "white": "#fefefe",
					      "yellowgreen": "#738A05"
					    }

					    var nodes = @php echo $nodes; @endphp;
					    var links = [];

					    for (var i = 0; i < nodes.length; i++) {
					      if (nodes[i].target !== undefined) {
					        for (var x = 0; x < nodes[i].target.length; x++) {
					          links.push({
					            source: nodes[i],
					            target: nodes[nodes[i].target[x]]
					          })
					        }
					      }
					    }

					    var myChart = d3.select(el)
					      .append('svg')
					      .attr('width', "100%")
					      .attr('height', h)
					      .style('margin', '0').style('display','inline')

					    var force = d3.layout.force()
					      .nodes(nodes)
					      .links([])
					      .gravity(0.1)
					      .charge(charge)
					      .size([w, h])



					    var link = myChart.selectAll('line')
					      .data(links).enter().append('line')
					      .attr('stroke', palette.darkgray)
					      .attr('stroke-width', 3);

					    var node = myChart.selectAll('pattern')
					      .data(nodes).enter()
					      .append('g')
					      .call(force.drag);

					       node.append('svg:defs')
								    .append('svg:pattern')
								    .attr('id', function(d,i){
								      return d.id
								    })
								     .attr('patternUnits',"userSpaceOnUse")
								    .attr('height', function(d, i) {
								        if (i > 0) {
								          return (circleWidth-10) *2
								        } else {
								          return circleWidth * 2 
								        }
								      })
								    .attr('width', function(d, i) {
								        if (i > 0) {
								          return (circleWidth-10) *2
								        } else {
								          return circleWidth * 2 
								        }
								      })
								    .attr('x', function(d, i) {
								        if (i > 0) {
								          return circleWidth-10
								        } else {
								          return circleWidth
								        }
								      }).attr('y', function(d, i) {
								        if (i > 0) {
								          return circleWidth-10
								        } else {
								          return circleWidth
								        }
								      })
								    .append('svg:image')
								    .attr('xlink:href',function(d,i){
								     	 return d.photo + '?1'
								    })
								    .attr('height', function(d, i) {
								        if (i > 0) {
								          return (circleWidth-10) *2
								        } else {
								          return circleWidth * 2 
								        }
								      })
								    .attr('width', function(d, i) {
								        if (i > 0) {
								          return (circleWidth-10) *2
								        } else {
								          return circleWidth * 2 
								        }
								      })
								      .attr('x', 0)
								      .attr('y', 0);

					    node.append('circle')
					      .attr('cx', function(d) {
					        return d.x;
					      }).attr('cy', function(d) {
					        return d.y;
					      })
					      .attr('r', function(d, i) {
					        if (i > 0) {
					          return circleWidth - 10
					        } else {
					          return circleWidth
					        }
					      })
					      .attr('id', function(d, i) {
					          return d.id
					      })
					      .attr('stroke', function(d, i) {
					        if (i > 0) {
					          return palette.darkgray
					        } else {
					          return palette.darkgray
					        }
					      })
					      .attr('stroke-width', 5)
					      .style("fill", "#fff").style("fill", function(d,i){ return 'url(#' + d.id+')'})

					    node.append('text')
					      .text(function(d) {
					        return d.name
					      })
					      .attr('font-family', 'sans-serif')
					      .attr('fill', function(d, i) {
					        if (i > 0) {

					          return palette.darkgray
					        } else {
					          return "transparent"						   
					         }
					      })
					      .attr('x', function(d, i) {
					        if (i > 0) {
					          return -20
					        } else {
					          return circleWidth - 15
					        }
					      })
					      .attr('y', function(d, i) {
					        if (i > 0) {
					          return circleWidth + 5
					        } else {
					          return 8
					        }
					      })
					      .attr('text-anchor', function(d, i) {
					        if (i > 0) {
					          return 'beginning'
					        } else {
					          return 'end'
					        }
					      })
					      .attr('font-size', function(d, i) {
					        if (i > 0) {
					          return '1em'
					        } else {
					          return '1em'
					        }
					      })

					    force.on('tick', function(e) {
					      node.attr('transform', function(d, i) {
					        return 'translate(' + d.x + ', ' + d.y + ')';
					      })

					      link
					        .attr('x1', function(d) {
					          return d.source.x
					        })
					        .attr('y1', function(d) {
					          return d.source.y
					        })
					        .attr('x2', function(d) {
					          return d.target.x
					        })
					        .attr('y2', function(d) {
					          return d.target.y
					        })
					    })
					    node.on("click", click);
							function click(d) 
							{
							if(d.id == "n"){
								$("#modalfamily").modal('toggle');		
								}else{

							$('#userp').attr('src', d.photo + '?2');
							if(!d.namecom){
							  	$('#namep').html(d.name);
							  }	else{
							  	$('#namep').html(d.namecom + ' - ' + d.relationship);
							  	if(d.session == 1){
							  		$('#idpa').val(d.id);
							  		$('#init1').css({ 'display': "none" });
									$('#init').css({ 'display': "none" });
							  	}else{
							  		$('#idpa').val(d.id);
							  		$('#init1').css({ 'display': "none" });
									$('#init').css({ 'display': "none" });
							  	}
							  }
							  	$("#modalfamily2").modal('toggle');
							  }
							}
						force.start();

					  }('#diagramFamily');

					}(window.d3);
					  });
		    	</script>
			</div>

			<div class="tab-pane" id="address">
		    	<div align="center" class="box-body" >
		    		
		    		@if($latitude == "" && $longitude == "")
		    	         @include('empty.emptyData', 
		                    [
		                      'emptyc' => 'buttom',
		                      'title'  => 'No se ha agregado dirección',
		                      'icon'   => 'adminlte.empty-house'
		                    ]
		                  )
			               <script type="text/javascript">
			                  $('#form_profile2').attr("action", "/user/edit/complete");
			                  $('.buttonEmpty').text('Agregar dirección');
			                  $('.spanEmpty1').html('No se ha agregado dirección');
			               </script>   
			    	   <input type="hidden" id="nullmap" value="true">
			    	@else   
			          <div id="mapAddressUser"></div>
			          <input type="hidden" id="nullmap" value="false">
			        @endif
		    	</div>
			</div>

			<div class="tab-pane" id="clinichistory">
		    	<div class="box-body" >

		    		@foreach($questions as $quest)
                        @if($loop->iteration == 1)
                            <a data-target="#modalhistoryappointments-{{ $patientId}}" data-toggle="modal" class="btn btn-secondary btn-flat btn-block">Historia clínica previa cita</a>
                        @endif    
                    @endforeach

		    		@include('modals.clinichistoryappointments', 
	                    [
	                      	'id' => $patientId,
	                      	'dr' => Auth::id(), 
	                      	'questions'  => $questions_appointments,
	                      	'clinic_historyappo'  => $clinic_history_appointments
	                    ]
	                )

		    		@include('viewclinichistory')
		    	</div>		  
		    </div> 	
		    <div class="tab-pane" id="history">
		    	<div class="box-body" >
		    	 	@include('historyView')
		    	</div> 	       
		    </div>
	    </div>




    </div>


@else
	

	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
          	<li id="medicalAttentionTab" style="display: none;"><a href="#medicalAttentionLink" data-toggle="tab">Atención médica </a> </li>
          	<li class="active"><a href="#activity" data-toggle="tab">Detalle</a></li>
          	<li><a href="#family" id="familyOption" data-toggle="tab">Familia</a></li>
          	<li><a href="#address" onclick="initMapAddressUser();" data-toggle="tab">Dirección</a></li>
          	<li><a href="#clinichistory" data-toggle="tab">Historia Clínica</a></li>
          	<li><a href="#history" data-toggle="tab">Registro de Actividad</a></li>
        </ul>

        <div class="tab-content">

        	<div class="tab-pane" id="medicalAttentionLink" style="display: none;">

        		<form class="form-horizontal">
				  	<div class="form-group">
				    	<label for="HeightField" class="col-sm-2 control-label">Estatura:</label>
					    <div class="col-sm-10">
					      	<input type="text" required="true" class="form-control" id="HeightField" placeholder="1.70 m">
					    </div>
				  	</div>
				  	<div class="form-group">
				    	<label for="WeightField" class="col-sm-2 control-label">Peso:</label>
					    <div class="col-sm-10">
					      	<input type="text" required="true" class="form-control" id="WeightField" placeholder="73 kg">
					    </div>
				  	</div>

				  	<div class="form-group">
					  	<label for="temperatureField" class="col-sm-2 control-label">Temp. (°C):</label>
						 <div class="col-sm-10">
						 	<div class="input-group">
						    	<div class="input-group-btn">
						        	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						        		Modo <span class="caret"></span>
						        	</button>
						        	<ul class="dropdown-menu">
						          		<li><a href="#">Oral</a></li>
						          		<li><a href="#">Axilar</a></li>
						          		<li><a href="#">Rectal</a></li>
						          		<li><a href="#">Frontal</a></li>
						        	</ul>
						      	</div>
					      		<input type="text" required="true" class="form-control" id="temperatureField" placeholder="73 kg">
					      	</div>
					    </div>
					</div>

				  	
				  	<div class="form-group">
				    	<label for="cranial_capacityField" class="col-sm-2 control-label">C.Craneal (CC):</label>
					    <div class="col-sm-10">
					      	<input type="text" class="form-control" id="cranial_capacityField" placeholder="72 cm">
					    </div>
				  	</div>
				  	<div class="form-group">
				    	<label for="waist_diameterField" class="col-sm-2 control-label">D. de Cintura:</label>
					    <div class="col-sm-10">
					      	<input type="text" class="form-control" id="waist_diameterField" placeholder="92 cm">
					    </div>
				  	</div>

				  	<div class="form-group">
					  	<label for="paField" class="col-sm-2 control-label">Presión Arterial (PA):</label>
						<div class="col-sm-10">
					  		<div class="input-group" >
						      	<span class="input-group-btn">
						        	<button class="btn btn-default" type="button">Estable</button>
						      	</span>
						      	<input type="text" id="paField" class="form-control" placeholder="120/80 ...">
					      	</div>
					    </div>
					</div>
					<div class="form-group">
					  	<label for="hearRateField" class="col-sm-2 control-label">Frec. Cardiaca (FC):</label>
						<div class="col-sm-10">
					  		<div class="input-group" >
						      	<span class="input-group-btn">
						        	<button class="btn btn-default" type="button">Estable</button>
						      	</span>
						      	<input type="text" id="hearRateField" class="form-control" placeholder="60 - 100">
					      	</div>
					    </div>
					</div>

				    <div class="form-group">
					  	<label for="frecRepField" class="col-sm-2 control-label">Frec. Respiratoria (FC):</label>
						<div class="col-sm-10">
					  		<div class="input-group" >
						      	<span class="input-group-btn">
						        	<button class="btn btn-default" type="button">Estable</button>
						      	</span>
						      	<input type="text" id="frecRepField" class="form-control" placeholder="12 - 16">
					      	</div>
					    </div>
					</div>

					<div class="progress-bar" id="progressCompleteRecipe" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="5" style="width: 10%;"> 10% </div>
					
					<input type="hidden" id="load-medicines" value="" />
					<div id="wizardPrescription">
	                     <h3>Receta </h3>
	                     <section>
	                           <!-- The validation is to change the cols number in textarea -->
	                           <div class="form-group">
	                              @if($agent->isMobile())
	                                 <textarea class="form-control" id="receta" rows="8" cols="32" onkeypress="controlledActionsOnTheWrite(this.value);" placeholder="Describe la prescripción médica ..."></textarea>
	                              @else
	                                 <textarea class="form-control" id="receta" rows="8" cols="34" onkeypress="controlledActionsOnTheWrite(this.value);" placeholder="Describe la prescripción médica ..."></textarea>
	                              @endif
	                           </div>
	                     </section>
	                     <h3>PDF </h3>
	                    <section>

	                        @if($agent->isMobile())
	                          <center><iframe id="framepdfprescription" width="111%" style="height: 300px;"></iframe></center>
	                        @else
	                          <center><iframe id="framepdfprescription" width="100%" style="height: 300px;"></iframe></center>
	                        @endif
	                    </section>
	                </div>

	                <script type="text/javascript">
		               /**
		                * Se guardan los nombre de cada medicamento cuando se abre el Modal
		                * @type {Array}
		                */
		               var words = [];
		               /**
		                * medicinesToSelect arreglo donde se encuentra la descripción total de todos los medicamentos que están 
		                * disponibles para seleccionar y con el nombre se puede acceder a la información completa
		                */
		               var medicinesToSelect = [];
		               /**
		                * medicinesSelected medicamentos seleccionados en la receta.
		                */
		               var medicinesSelected = [];
		               /**
		                * Contador utilizado para identificar si un doctor se encuentra escribiendo o borrando en la receta.
		                */
		               var lengthTextBody = 0;
		               /**
		                * Función que reduce la escritura de selectores por id.
		                * @param  {[type]} argument [Dom element]
		                * @return {[type]}          [element selected]
		                */
		               function byId(argument) {
		                  return document.getElementById(argument);
		               }
		               /**
		                * Utilizado para avanzar la barra de receta en cuanto se abra el Modal.
		                */
		               $('#prescription-form-modal').on('shown.bs.modal', function () {
		                  byId('progressCompleteRecipe').setAttribute("style", "width: 30%;");
		                  byId('progressCompleteRecipe').innerHTML = "30%";
		               });

		               $(document).ready(function(){
		                  jQuery.noConflict(false);
		                  $("#wizardPrescription").steps({
		                        headerTag: "h3",
		                        bodyTag: "section",
		                        transitionEffect: "slideLeft",
		                        cssClass: "wizard",
		                        autoFocus: true,
		                        labels: {
		                           pagination: "Paginación",
		                           finish:     "Enviar",
		                           next:       "Revisar",
		                           previous:   "Editar",
		                           loading:    "Cargando"
		                        },
		                        showFinishButtonAlways: true,
		                        onStepChanged: function (event, currentIndex, priorIndex) { 
		                           if(currentIndex){
		                              byId('linkfinish').href = "#finish";
		                              byId('optionlinkfinish').removeAttribute("class");
		                              byId('progressCompleteRecipe').setAttribute("style", "width: 90%;");
		                              byId('progressCompleteRecipe').innerHTML = "90%";
		                              byId('framepdfprescription').src = "{{ url('prescriptions/pdf')}}";
		                           }else{
		                              byId('linkfinish').href = "return false;";
		                              byId('optionlinkfinish').className = "disabled";
		                              byId('progressCompleteRecipe').setAttribute("style", "width: 50%;");
		                              byId('progressCompleteRecipe').innerHTML = "50%";
		                           }
		                           console.log(currentIndex); // 1
		                           console.log(priorIndex); // 0
		                        },
		                        onFinished: function (event, currentIndex) { 
		                           console.log('terminado...' + event);
		                           console.log('terminado...' + currentIndex);
		                           byId('progressCompleteRecipe').setAttribute("style", "width: 100%;");
		                           byId('progressCompleteRecipe').innerHTML = "100%";
		                           
		                           
		                        }
		                     });
		                  
		                  /**
		                   * Activa el framework select2 para la selección de la cita a la cual se dirigirá la receta.
		                   * @type {String}
		                   */

		                  
		                  /**
		                   * Permite que pueda establecer un id al botón y <LI> element de finalizar.
		                   */
		                  var getLinks = document.getElementsByTagName('a');
		                  for (var i = getLinks.length - 1; i >= 0; i--) 
		                     if(getLinks[i].href == "{{ url('prescriptions#finish')}}")
		                        getLinks[i].setAttribute('id', "linkfinish");
		                     
		                  byId('linkfinish').parentNode.setAttribute('id', "optionlinkfinish");
		                  byId('optionlinkfinish').className = "disabled";
		                  byId('linkfinish').href = "return false;";
		                  
		               });
		              	
		               /**
		                * Función responsable de identificar los movimientos de escritura sobre la receta.
		                * @param  string textBody [valor actual del textarea]
		                */
		               function controlledActionsOnTheWrite(textBody) {
		                  var textBodyArray = textBody.split(" ");
		                  if (textBody.length <= lengthTextBody) {
		                     /**
		                      * Agregar si existe la sustancia en el catalogo pero no fue seleccionada y se encuentra escrita en el textarea.
		                      * (Validando para ver si lo agrego al array como optional)
		                      * @param  {[type]} 
		                      */
		                     $.map(words, function (medicine) {
		                        
		                        if(textBodyArray.indexOf(medicine.split(" ")[0]) > 0){
		                           console.log( 'Se encontro: ' + medicine);
		                           return medicine;
		                        }
		                        //return word.indexOf(term) === 0 ?  word : null;
		                     });
		                     console.log('borrando...');
		                  }else if(textBody.length >= lengthTextBody)
		                           console.log('escribiendo...');
		                  
		                  
		                  lengthTextBody = textBody.length;
		                  var toDeleted = [];
		                  /**
		                   * En caso de que se encuentre en el array y no en el textarea eliminarla del array medicinesSelected.
		                   */
		                  $.map(medicinesSelected, function (medicine) {
		                     textBody.toLowerCase();
		                     if(textBody.indexOf(medicine.name) < 0)
		                        toDeleted.push(medicine.name);
		                     
		                  });
		                  if(toDeleted.length > 0)
		                     for (var o = toDeleted.length - 1; o >= 0; o--) 
		                        for (var i = medicinesSelected.length - 1; i >= 0; i--) 
		                           if (medicinesSelected[i].name == toDeleted[o]) 
		                              medicinesSelected.splice(i, 1);
		               }
		               /**
		                * La función se ejecuta solo cuando se abre el modal para no hacer solicitudes que no sean
		                * estrictamente necesarias.
		                *
		                * @textcomplete
		                *
		                * Aquí se activa el framework textcomplete que predice las palabras que se escriben para proponer
		                * opciones de medicamentos.
		                */
		               function loadMedicines() {
		                  if (byId('load-medicines').value == "") {
		                     $.ajax({
		                        method: "get",
		                        url: "{{ url('prescriptions/medicinescatalogue')}}",
		                        success: function( data ){
		                           console.log('Submission was success.');
		                           medicinesToSelect = data;
		                           
		                           $.map(data, function (word) {
		                              words.push(word.name.charAt(0).toUpperCase() + word.name.slice(1));
		                              words.push(word.name.toUpperCase());
		                              words.push(word.name);
		                           });
		                           $.map(medicinesToSelect, function (word) { 
		                              medicinesToSelect[word.name] = word.medicine; 
		                           });
		                           console.log(medicinesToSelect);
		                           byId('load-medicines').value = true;

		                           $('#receta').textcomplete([{
		                              match: /(^|\b)(\w{2,})$/,
		                              search: function (term, callback) {
		                                 
		                                 callback(
		                                    $.map(words, function (word) {
		                                       byId('textcomplete-dropdown-1').style.zIndex = "1100";
		                                       return word.indexOf(term) === 0 ?  word : null;
		                                    }
		                                 ));
		                              }, replace: function (word) {
		                                 word = word.toLowerCase();
		                                    
		                                 // Validar que si esta seleccionada no agregue más de una versión al array medicinesSelected.
		                                 $.map(medicinesSelected, function (medicineSelected) {
		                                    if(word == medicineSelected.name){
		                                       console.log('Words selected but not added one more time: ' + word);
		                                       return word + ' ';
		                                    }
		                                 });
		                                 var record = {
		                                    "id"     : medicinesToSelect[word].split("---")[1].split(':')[1],
		                                    "name"   : medicinesToSelect[word].split("---")[0].split(':')[1]
		                                 };
		                                 medicinesSelected.push(record);
		                                 //name:adiamyl plus 4 / 1000 mg caja x 20 tabs---id:25
		                                 console.log('Words selected: ');
		                                 console.log(medicinesSelected);
		                                 return word + ' ';
		                              }
		                           }]);
		                        }, error: function( data ){
		                           console.log('Submission was error.');
		                           console.log(data);
		                           if(data.error == "Unauthenticated.")
		                              window.location.href = "{{ url('/login') }}";
		                           
		                        }
		                     });
		                  }
		               }               
		            </script>

				</form>
        		

        		<div class="row">
        			<div class="col-md-6">
        				<a href="#" onclick="medicalAttention('tabsBlade');" class="btn btn-default btn-block">
	                		Cancelar
	                	</a>
        			</div>
        			<div class="col-md-6">
        				<a href="#" class="btn btn-secondary btn-flat btn-block">
	                		Guardar
	                	</a>
        			</div>
        		</div>
        	</div>

			<div class="active tab-pane" role="tabpanel" id="activity">
				<!-- Form details -->
		    	<form class="form-horizontal">
					<div class="form-group">
					    <label class="col-sm-3 control-label">Nombre de usuario:</label>
					    <div class="col-sm-9">
					      	<p class="form-control-static">{{ $pusername }}</p>
					    </div>
					</div>
			    		<div class="form-group">
					    <label class="col-sm-3 control-label">Edad:</label>
					    <div class="col-sm-9">
					      	<p class="form-control-static">{{ $agep }}</p>
					    </div>
					</div>
					<div class="form-group">
					    <label class="col-sm-3 control-label">Ocupación:</label>
					    <div class="col-sm-9">
					      	<p class="form-control-static">{{ $occupation }}</p>
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
					    <label class="col-sm-3 control-label">Escolaridad:</label>
					    <div class="col-sm-9">
					      	<p class="form-control-static">{{ $scholarship }}</p>
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


		    <div class="tab-pane" id="family">
				         	    	

		    	<div id="diagramFamily"></div>


		    	<!-- modals add family member & session as child -->
		    	
		    	@include('modals.addFamilyMember')
		    	@include('modals.sessionAsParentChild')
		    	
		    	<!-- modals add family member & session as child -->

		    	<script type="text/javascript">
		    		
		    		$('#familyOption').on('click', function(e) {
			 				e.preventDefault();
			 				document.getElementById('diagramFamily').innerHTML='';
						+ function(d3) {
				/* Para centrar globos charge junta globos secundarios o los exparce más, y variable w, restarle o sumarl dependiendo el panel en donde se ve */			
						var swatches = function(el) {
							var circleWidth = 45;	
							var charge = -700;//800
							var h = 0;
							var w= 0;
					        if("@php echo $agent->isMobile(); @endphp"){
					            //var mensaje2 = "@php echo $agent->version('Android'); @endphp";
					              h= window.screen.availHeight;
								  w= window.screen.availWidth;
					          
					            if(h >= 1000 && h <= 1300){
					            	circleWidth = 30;
									charge = -300;
					                h = h*0.20;
					                h = Math.floor(h);
					                w = w*0.40;
					                w = Math.floor(w);
					                  //alert("Altura: "+h + "anchura " + w);
					            }else if(h>=1800){
					              h-= 1840;
					              w-= 1200;
					             circleWidth = 30;
								 charge = -300;
					            }else{
					              h-=315;
					              w-=100;
					              circleWidth = 30;
								 charge = -300;
					            }
					       	 }else{
					          h = window.screen.availHeight-375;
					          w = window.screen.availWidth-550;//100
					           circleWidth = 53;
					        }

							    w = w;
								h = h;

									    

					    var palette = {
					      "lightgray": "#819090",
					      "gray": "#708284",
					      "mediumgray": "#808486",
					      "darkgray": "#272B2C",
					      "darkblue": "#0A2933",
					      "darkerblue": "#042029",
					      "paleryellow": "#FCF4DC",
					      "paleyellow": "#EAE3CB",
					      "yellow": "#A57706",
					      "orange": "#BD3613",
					      "red": "#D11C24",
					      "pink": "#C61C6F",
					      "purple": "#595AB7",
					      "blue": "#2176C7",
					      "green": "#259286",
					      "white": "#fefefe",
					      "yellowgreen": "#738A05"
					    }

					    var nodes = @php echo $nodes; @endphp;
					    var links = [];

					    for (var i = 0; i < nodes.length; i++) {
					      if (nodes[i].target !== undefined) {
					        for (var x = 0; x < nodes[i].target.length; x++) {
					          links.push({
					            source: nodes[i],
					            target: nodes[nodes[i].target[x]]
					          })
					        }
					      }
					    }

					    var myChart = d3.select(el)
					      .append('svg')
					      .attr('width', "100%")
					      .attr('height', h)
					      .style('margin', '0').style('display','inline')

					    var force = d3.layout.force()
					      .nodes(nodes)
					      .links([])
					      .gravity(0.1)
					      .charge(charge)
					      .size([w, h])



					    var link = myChart.selectAll('line')
					      .data(links).enter().append('line')
					      .attr('stroke', palette.darkgray)
					      .attr('stroke-width', 3);

					    var node = myChart.selectAll('pattern')
					      .data(nodes).enter()
					      .append('g')
					      .call(force.drag);

					       node.append('svg:defs')
								    .append('svg:pattern')
								    .attr('id', function(d,i){
								      return d.id
								    })
								     .attr('patternUnits',"userSpaceOnUse")
								    .attr('height', function(d, i) {
								        if (i > 0) {
								          return (circleWidth-10) *2
								        } else {
								          return circleWidth * 2 
								        }
								      })
								    .attr('width', function(d, i) {
								        if (i > 0) {
								          return (circleWidth-10) *2
								        } else {
								          return circleWidth * 2 
								        }
								      })
								    .attr('x', function(d, i) {
								        if (i > 0) {
								          return circleWidth-10
								        } else {
								          return circleWidth
								        }
								      }).attr('y', function(d, i) {
								        if (i > 0) {
								          return circleWidth-10
								        } else {
								          return circleWidth
								        }
								      })
								    .append('svg:image')
								    .attr('xlink:href',function(d,i){
								     	 return d.photo + '?1'
								    })
								    .attr('height', function(d, i) {
								        if (i > 0) {
								          return (circleWidth-10) *2
								        } else {
								          return circleWidth * 2 
								        }
								      })
								    .attr('width', function(d, i) {
								        if (i > 0) {
								          return (circleWidth-10) *2
								        } else {
								          return circleWidth * 2 
								        }
								      })
								      .attr('x', 0)
								      .attr('y', 0);

					    node.append('circle')
					      .attr('cx', function(d) {
					        return d.x;
					      }).attr('cy', function(d) {
					        return d.y;
					      })
					      .attr('r', function(d, i) {
					        if (i > 0) {
					          return circleWidth - 10
					        } else {
					          return circleWidth
					        }
					      })
					      .attr('id', function(d, i) {
					          return d.id
					      })
					      .attr('stroke', function(d, i) {
					        if (i > 0) {
					          return palette.darkgray
					        } else {
					          return palette.darkgray
					        }
					      })
					      .attr('stroke-width', 5)
					      .style("fill", "#fff").style("fill", function(d,i){ return 'url(#' + d.id+')'})

					    node.append('text')
					      .text(function(d) {
					        return d.name
					      })
					      .attr('font-family', 'sans-serif')
					      .attr('fill', function(d, i) {
					        if (i > 0) {

					          return palette.darkgray
					        } else {
					          return "transparent"						   
					         }
					      })
					      .attr('x', function(d, i) {
					        if (i > 0) {
					          return -20
					        } else {
					          return circleWidth - 15
					        }
					      })
					      .attr('y', function(d, i) {
					        if (i > 0) {
					          return circleWidth + 5
					        } else {
					          return 8
					        }
					      })
					      .attr('text-anchor', function(d, i) {
					        if (i > 0) {
					          return 'beginning'
					        } else {
					          return 'end'
					        }
					      })
					      .attr('font-size', function(d, i) {
					        if (i > 0) {
					          return '1em'
					        } else {
					          return '1em'
					        }
					      })

					    force.on('tick', function(e) {
					      node.attr('transform', function(d, i) {
					        return 'translate(' + d.x + ', ' + d.y + ')';
					      })

					      link
					        .attr('x1', function(d) {
					          return d.source.x
					        })
					        .attr('y1', function(d) {
					          return d.source.y
					        })
					        .attr('x2', function(d) {
					          return d.target.x
					        })
					        .attr('y2', function(d) {
					          return d.target.y
					        })
					    })
					    node.on("click", click);
							function click(d) 
							{
							if(d.id == "n"){
								$("#modalfamily").modal('toggle');		
								}else{

							$('#userp').attr('src', d.photo + '?2');
							if(!d.namecom){
							  	$('#namep').html(d.name);
							  }	else{
							  	$('#namep').html(d.namecom + ' - ' + d.relationship);
							  	if(d.session == 1){
							  		$('#idpa').val(d.id);
							  		$('#init1').css({ 'display': "none" });
									$('#init').css({ 'display': "none" });
							  	}else{
							  		$('#idpa').val(d.id);
							  		$('#init1').css({ 'display': "none" });
									$('#init').css({ 'display': "none" });
							  	}
							  }
							  	$("#modalfamily2").modal('toggle');
							  }
							}
						force.start();

					  }('#diagramFamily');

					}(window.d3);
					  });
		    	</script>
			</div>

			<div class="tab-pane" id="address">
		    	<div align="center" class="box-body" >
		    		
		    		@if($latitude == "" && $longitude == "")
		    	         @include('empty.emptyData', 
		                    [
		                      'emptyc' => 'buttom',
		                      'title'  => 'No se ha agregado dirección',
		                      'icon'   => 'adminlte.empty-house'
		                    ]
		                  )
			               <script type="text/javascript">
			                  $('#form_profile2').attr("action", "/user/edit/complete");
			                  $('.buttonEmpty').text('Agregar dirección');
			                  $('.spanEmpty1').html('No se ha agregado dirección');
			               </script>   
			    	   <input type="hidden" id="nullmap" value="true">
			    	@else   
			          <div id="mapAddressUser"></div>
			          <input type="hidden" id="nullmap" value="false">
			        @endif
		    	</div>
			</div>

			<div class="tab-pane" id="clinichistory">
		    	<div class="box-body" >

		    		@foreach($questions as $quest)
                        @if($loop->iteration == 1)
                            <a data-target="#modalhistoryappointments-{{ $patientId}}" data-toggle="modal" class="btn btn-secondary btn-flat btn-block">Historia clínica previa cita</a>
                        @endif    
                    @endforeach

		    		@include('modals.clinichistoryappointments', 
	                    [
	                      	'id' => $patientId,
	                      	'dr' => Auth::id(), 
	                      	'questions'  => $questions_appointments,
	                      	'clinic_historyappo'  => $clinic_history_appointments
	                    ]
	                )

		    		@include('viewclinichistory')
		    	</div>		  
		    </div> 	
		    <div class="tab-pane" id="history">
		    	<div class="box-body" >
		    	 	@include('historyView')
		    	</div> 	       
		    </div>
	    </div>




    </div>
@endif