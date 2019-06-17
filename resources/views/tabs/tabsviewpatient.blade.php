@if($agent->isMobile())


@else

	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
          	<li id="medicalAttentionTab" style="display: none;"><a href="#medicalAttentionLink" data-toggle="tab">Atención médica </a><a href="#" onclick="byId('medicalAttentionTab').style.display = 'none'; byId('medicalAttentionLink').style.display = 'none';"> <i class="fa fa-close"></i></a> </li>

          	<li class="active"><a href="#activity" data-toggle="tab">Detalle</a></li>
          	<li><a href="#family" id="familyOption" data-toggle="tab">Familia</a></li>
          	<li><a href="#address" onclick="initMapAddressUser();" data-toggle="tab">Dirección</a></li>
          	<li><a href="#clinichistory" data-toggle="tab">Historia Clínica</a></li>
          	<li><a href="#history" data-toggle="tab">Registro de Actividad</a></li>
        </ul>

        <div class="tab-content">

        	<div class="tab-pane" id="medicalAttentionLink" style="display: none;">
        		Hola
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