@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
	<style type="text/css">

	 .progress-bar {
	 	background-color: #3E3E3E;
	 }
	 .nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover {
    color: #fff;
    background-color: #3E3E3E;
		}
		.nav-pills>li.active>a, .nav-pills>li.active>a:hover, .nav-pills>li.active>a:focus {
    border-top-color: #3E3E3E;
}
 .nav-pills {
    width: 100% !important;
    text-align: center !important;

  }

  .nav-pills > li {
      float: none !important;
      display: inline-block !important;
    }
    .checkbox {
    padding-left: 20px; }

    .checkbox label {
    display: inline-block;
    position: relative;
    padding-left: 5px; }

    .checkbox label::before {
      content: "";
      display: inline-block;
      position: absolute;
      width: 17px;
      height: 17px;
      left: 0;
      margin-left: -20px;
      border: 1px solid #cccccc;
      border-radius: 3px;
      background-color: #fff;
      -webkit-transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
      -o-transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
      transition: border 0.15s ease-in-out, color 0.15s ease-in-out; }

    .checkbox label::after {
      display: inline-block;
      position: absolute;
      width: 16px;
      height: 16px;
      left: 0;
      top: 0;
      margin-left: -20px;
      padding-left: 3px;
      padding-top: 1px;
      font-size: 11px;
      color: #555555; }

    .checkbox input[type="checkbox"] {
      opacity: 0; }


    .checkbox input[type="checkbox"]:checked + label::after {
      font-family: 'FontAwesome';
      content: "\f00c"; }

    .checkbox input[type="checkbox"]:disabled + label {
      opacity: 0.65; }

      .checkbox input[type="checkbox"]:disabled + label::before {
        background-color: #eeeeee;
        cursor: not-allowed; }

        .checkbox-primary input[type="checkbox"]:checked + label::before {
  background-color: #3E3E3E;
  border-color: #3E3E3E; }

        .checkbox-primary input[type="checkbox"]:checked + label::after {
          color: #fff; }

          iframe {
            max-width: 100%;
          }
	</style>
     @if($mode == 'null')  
<div class="box">

  	<div class="box-header with-border">
	    <h3 class="box-title">Historia Clínica</h3>
  	</div>
 
  	<div class="box-body">
  <div class="container" id="myWizard">

   <div class="progress">
   	@php
   	$percent = (1 /count($questions)) * 100;
    $per = intval($percent);
   	@endphp
     <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="5" style="width: {{ $percent }}%;">
       {{ $per }}%
     </div>
   </div>
  

   <div class="tab-content">
   	@foreach($questions as $questions1) 
      @if($loop->iteration == 1)
      <div class="tab-pane fade in active" id="step1">
         
        <div class="well"> 
          
            <h3>{{ $questions1->question }}</h3>
            <br>
          @php $an = json_decode($questions1->answer); @endphp
            <label>Respuestas:</label><br>
            <input type="hidden" class="quesId" value="{{ $questions1->id }}">
            <input type="hidden" class="ansId" value="{{ $questions1->a }}">
            @foreach($an as $an)
                    <div class="checkbox checkbox-primary">
                        <input id="{{ $questions1->id }}{{ $loop->iteration }}" type="checkbox" value="{{ $an }}" name="resp[]">
                        <label for="{{ $questions1->id }}{{ $loop->iteration }}">
                            {{ $an }}
                        </label>
                    </div>
                    @if($questions1->parent)
                      @foreach($questions as $questionsSearch) 
                       @if($question1->parent == $questionsSearch->id)
                     <br><div>
                    <h3>{{ $questionsSearch->question }}</h3><br>
                     </div>
                     @endif
                      @endforeach
                    @endif
             @endforeach         

        </div>

         <a class="btn btn-default btn-flat next pull-right" href="#">Continuar &nbsp;<span class="fa fa-chevron-right"></span></a>
      </div>
        @endif
         @if(($loop->iteration > 1) && !$loop->last)
      <div class="tab-pane fade" id="step{{ $loop->iteration }}">
         <div class="well"> 
            <h3>{{ $questions1->question }}</h3>
            <br>
            @php $an = json_decode($questions1->answer); @endphp
            <label>Respuestas:</label><br>
            <input type="hidden" class="quesId" value="{{ $questions1->id }}">
            <input type="hidden" class="ansId" value="{{ $questions1->a }}">
            @foreach($an as $an)
                    <div class="checkbox checkbox-primary">
                        <input id="{{ $questions1->id }}{{ $loop->iteration }}" type="checkbox" value="{{ $an }}" name="resp[]">
                        <label for="{{ $questions1->id }}{{ $loop->iteration }}">
                            {{ $an }}
                        </label>
                    </div>
             @endforeach         
     

         </div>
         <a class="btn btn-default btn-flat prev pull-left" href="#"><span class="fa fa-chevron-left"></span> &nbsp;Atrás</a>
         <a class="btn btn-default btn-flat next pull-right" href="#">Continuar &nbsp;<span class="fa fa-chevron-right"></span></a>
      </div>
      @endif
       @if($loop->last)
      <div class="tab-pane fade" id="step{{ $loop->iteration }}">
         <div class="well"> 
            <h3>{{ $questions1->question }}</h3>
            <br>
            @php $an = json_decode($questions1->answer); @endphp
            <label>Respuestas:</label><br>
             <input type="hidden" class="quesId" value="{{ $questions1->id }}">
            <input type="hidden" class="ansId" value="{{ $questions1->a }}">
            @foreach($an as $an)
                    <div class="checkbox checkbox-primary">
                        <input id="{{ $questions1->id }}{{ $loop->iteration }}" type="checkbox" value="{{ $an }}" name="resp[]">
                        <label for="{{ $questions1->id }}{{ $loop->iteration }}">
                            {{ $an }}
                        </label>
                    </div>
             @endforeach         

         </div>
        <a class="btn btn-default btn-flat prev pull-left" href="#"><span class="fa fa-chevron-left"></span> &nbsp;Atrás</a>
        <a class="btn btn-default btn-flat first pull-left" href="#">Volver a iniciar &nbsp;<span class="fa fa-undo"></span></a>
        <a class="btn btn-secondary btn-flat pull-right finish" href="#">Finalizar</a>
        <a id="finish" href="cHistory" style="visibility: hidden;"></a>
      </div>
       @endif
      @endforeach

   </div>
   <div class="navbar" style="visibility: hidden" id="wiz">
      <div class="navbar-inner">
            <ul class="nav nav-pills pull-center">
          @foreach($questions as $question) 
              @if($loop->iteration == 1)
               <li class="active"><a href="#step1" data-toggle="tab" data-step="1">1</a></li>
              @endif
               @if($loop->iteration > 1)
               <li><a href="#step{{ $loop->iteration }}" data-toggle="tab" data-step="{{ $loop->iteration }}">{{ $loop->iteration }}</a></li>
               @endif
            @endforeach
            </ul>
      </div>
   </div>
</div>
            </div>
        </div>
@endif
@if($mode == 'finish')


    <!-- Main content -->
     <div class="box-header">
      <h3 class="box-title">
                Expediente médico
              </h3>
     </div><br/>
        <div class="box-body">
      <!-- row -->
     <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
                        @foreach($test_result->sortBy('created_at') as $test)


            <li>
              <i class="fa fa-file bg-aqua"></i>

              <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::parse($test->updated_at)->diffForHumans() }}</span>

                <h3 class="timeline-header"><a href="#">{{ $test->name }}</a></h3>
                <div class="timeline-body">
                  Prescribe. {{ $test->doc}}.<br>
                  Recipe. {{ $test->folio}}.<br>
                  Detalles:<br>
                  {{ $test->details }}<br><br>


                  <a class="btn btn-default btn-flat btn-sm external" data-toggle="modal" href="{{ $test->url }}" data-target="#myModal">Ver estudio</a>


                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                 <span style="font-size: 15px;"><b> {{ $test->name }} </b></span>
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                  <div class="modal-body">
                                  </div>
                                  </div><!-- /.modal-content -->
                              </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                                                    <!-- /.modal -->

                </div>
              </div>
            </li>
            @endforeach
             <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
         </ul>  

         
    <div class="box-header">
      <h3 class="box-title">
                Historia clínica
              </h3>
     </div><br/>
     <ul class="timeline">   
            @php
            $t1 = 0; 
            $t2 = 0; 
            $t3 = 0;
            $t4 = 0;
            $t5 = 0;                         
            @endphp
      @foreach($clinic_history->sortBy('type') as $clinic)

            <!-- timeline time label -->
            @if($clinic->type == 'Antecedentes Familiares')
             @php $t1++; @endphp
             @if($t1 == 1)
            <li class="time-label">
                  <span class="bg-blue">
                   {{ $clinic->type }} 
                  </span>
            </li>
            @endif


            <!-- /.timeline-label -->
            <!-- timeline item -->

            <li>
              <i class="fa fa-users bg-blue"></i>

              <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::parse($clinic->updated_at)->diffForHumans() }}</span>

                <h3 class="timeline-header"><a href="#"  data-toggle="tooltip" title="{{ $clinic->text_help}}">{{ $clinic->question }}</a></h3>
                <div class="timeline-body">
                   @php $a = json_decode($clinic->answer); @endphp
                  @foreach($a as $answer)
                 <i class="fa fa-circle" style="vertical-align: middle; font-size: 6px "></i> {{ $answer }}<br>
                  @endforeach
                </div>
              </div>
            </li>
            @endif
             @if($clinic->type == 'Antecedentes Morbidos')
             @php $t2++; @endphp
             @if($t2 == 1)
            <li class="time-label">
                  <span class="bg-gray">
                   Antecedentes Mórbidos
                  </span>
            </li>
            @endif
            <!-- /.timeline-label -->
            <!-- timeline item -->

            <li>
              <i class="fa fa-stethoscope bg-gray"></i>

              <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::parse($clinic->updated_at)->diffForHumans() }}</span>

                <h3 class="timeline-header"><a href="#"  data-toggle="tooltip" title="{{ $clinic->text_help}}">{{ $clinic->question }}</a></h3>
                <div class="timeline-body">
                   @php $a = json_decode($clinic->answer); @endphp
                  @foreach($a as $answer)
                 <i class="fa fa-circle" style="vertical-align: middle; font-size: 6px "></i> {{ $answer }}<br>
                  @endforeach
                </div>
              </div>
            </li>
            @endif
           @if($clinic->type == 'Alergias')
           @php $t3++; @endphp
             @if($t3 == 1)
            <li class="time-label">
                  <span class="bg-black">
                   Alergias
                  </span>
            </li>
            @endif
            <!-- /.timeline-label -->
            <!-- timeline item -->

            <li>
              <i class="fa fa-medkit bg-black"></i>

              <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::parse($clinic->updated_at)->diffForHumans() }}</span>

                <h3 class="timeline-header"><a href="#"  data-toggle="tooltip" title="{{ $clinic->text_help}}">{{ $clinic->question }}</a></h3>
                <div class="timeline-body">
                   @php $a = json_decode($clinic->answer); @endphp
                  @foreach($a as $answer)
                 <i class="fa fa-circle" style="vertical-align: middle; font-size: 6px "></i> {{ $answer }}<br>
                  @endforeach
                </div>
              </div>
            </li>
            @endif
           @if($clinic->type == 'Habitos')
            @php $t4++; @endphp
             @if($t4 == 1)
            <li class="time-label">
                  <span class="bg-green">
                   Hábitos
                  </span>
            </li>
            @endif
            <!-- /.timeline-label -->
            <!-- timeline item -->

            <li>
              <i class="fa fa-coffee bg-green"></i>

              <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> {{ \Carbon\Carbon::parse($clinic->updated_at)->diffForHumans() }}</span>

                <h3 class="timeline-header"><a href="#"  data-toggle="tooltip" title="{{ $clinic->text_help}}">{{ $clinic->question }}</a></h3>
                <div class="timeline-body">
                   @php $a = json_decode($clinic->answer); @endphp
                  @foreach($a as $answer)
                 <i class="fa fa-circle" style="vertical-align: middle; font-size: 6px "></i> {{ $answer }}<br>
                  @endforeach
                </div>
              </div>
            </li>
            @endif
            <!-- END timeline item -->
            @endforeach

              <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
        </ul>     
      </div>
     </div>   
    </div> 
@endif


				<script>

				$(document).ready(function () {


  $('a.external').on('click', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $(".modal-body").html('<iframe width="100%" height="100%" frameborder="0" scrolling="yes" allowtransparency="true" src="'+url+'" ></iframe>');
 
    });
 
    $('#myModal').on('show.bs.modal', function () {
 
        $(this).find('.modal-dialog').css({
                  width:'40%x', //choose your width
                  height:'100%', 
                  'padding':'0'
           });
         $(this).find('.modal-content').css({
                  height:'100%', 
                  'border-radius':'0',
                  'padding':'0'
           });
         $(this).find('.modal-body').css({
                  width:'auto',
                  height:'100%', 
                  'padding':'0'
           });
    })


					$('.next').click(function(){

					  var nextId = $(this).parents('.tab-pane').next().attr("id");
					  $('[href=#'+nextId+']').tab('show');
            var tab = $(this).parents('.tab-pane').attr("id");

                   var values = $('#'+tab+' input:checkbox').map(function() {
                    if (this.checked) {
                    return this.value; // obtienes el valor de todos los checkboxes
                        }
                    }).get();

            var ques = $('#'+tab+ ' .quesId').val();
            var ansId = $('#'+tab+ ' .ansId').val();
            console.log(JSON.stringify(values));
            console.log(ansId);
            console.log(ques);
                      $.ajaxSetup({
                                  headers: {
                                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                  }
                              });

                                     $.ajax({     
                                       type: "POST",                 
                                        url: "save",  
                                        data: { "answers" : JSON.stringify(values), 
                                                "question" : ques,
                                                "ansId"    : ansId
                                      }, 
                                        dataType: 'json',                
                                       success: function(data)             
                                       {
                                        console.log(data);
                                       }
                                   });
					  return false;
					  
					});
					$('.prev').click(function(){

					  var prevId = $(this).parents('.tab-pane').prev().attr("id");
					  $('[href=#'+prevId+']').tab('show');
					  return false;
					  
					});

					$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
					  
					  //update progress
					  var step = $(e.target).data('step');
					  var percent = (parseInt(step) / @php echo count($questions); @endphp) * 100;
					  console.log(@php echo count($questions); @endphp);
					  
					  $('.progress-bar').css({width: percent + '%'});
					  $('.progress-bar').text(parseInt(percent) + "%");
					  
					  //e.relatedTarget // previous tab
					  
					});

					$('.first').click(function(){

					  $('#wiz a:first').tab('show')

					});
          $('.finish').click(function(){

                        var tab = $(this).parents('.tab-pane').attr("id");
                         var values = $('#'+tab+' input:checkbox').map(function() {
                          if (this.checked) {
                          return this.value; // obtienes el valor de todos los checkboxes
                              }
                          }).get();

                        var ques = $('#'+tab+ ' .quesId').val();
                        var ansId = $('#'+tab+ ' .ansId').val();
                        console.log(JSON.stringify(values));
                        console.log(ansId);
                        console.log(ques);
                                  $.ajaxSetup({
                                  headers: {
                                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                  }
                              });

                                     $.ajax({     
                                       type: "POST",                 
                                        url: "save",  
                                        data: { "answers" : JSON.stringify(values), 
                                                "question" : ques,
                                                "ansId"    : ansId
                                      }, 
                                        dataType: 'json',                
                                       success: function(data)             
                                       {
                                          
                                        console.log(data);
                                       }
                                   });
                         window.open('cHistory', '_self');

          })

				})
				</script>

@stop
