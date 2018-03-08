@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content')

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

	</style>
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
            <input type="hidden" id="$questions1->id" value="$questions1->id">
            @foreach($an as $an)
                    <div class="checkbox checkbox-primary">
                        <input id="{{ $questions1->id }}{{ $loop->iteration }}" type="checkbox" value="{{ $an }}" name="resp[]">
                        <label for="{{ $questions1->id }}{{ $loop->iteration }}">
                            {{ $an }}
                        </label>
                    </div>
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
            @foreach($an as $an)
                    <div class="checkbox checkbox-primary">
                        <input id="{{ $questions1->id }}{{ $loop->iteration }}" type="checkbox" value="{{ $an }}">
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
            @foreach($an as $an)
                    <div class="checkbox checkbox-primary">
                        <input id="{{ $questions1->id }}{{ $loop->iteration }}" type="checkbox" value="{{ $an }}">
                        <label for="{{ $questions1->id }}{{ $loop->iteration }}">
                            {{ $an }}
                        </label>
                    </div>
             @endforeach     
         </div>
        <a class="btn btn-default btn-flat prev pull-left" href="#"><span class="fa fa-chevron-left"></span> &nbsp;Atrás</a>
        <a class="btn btn-default btn-flat first pull-left" href="#">Volver a iniciar &nbsp;<span class="fa fa-undo"></span></a>
        <a class="btn btn-secondary btn-flat pull-right" href="#">Finalizar</a>
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

				<script>
				$(document).ready(function () {

					$('.next').click(function(){

					  var nextId = $(this).parents('.tab-pane').next().attr("id");
					  $('[href=#'+nextId+']').tab('show');
                                   /*     $.ajaxSetup({
                                  headers: {
                                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                  }
                              });
                           var address1 = document.getElementById('address').value;
                                     $.ajax({     
                                       type: "POST",                 
                                        url: "clinicHistory/save",  
                                        data: { "search" : address1 }, 
                                        dataType: 'json',                
                                       success: function(data)             
                                       {
                                console.log(JSON.parse(data).reverse());
                                 var data1 = JSON.parse(data).reverse(); 
                                 $('#recentS').show();
                                 $(".recent").remove();

                                        for(var z=0; z < data1.length; z++){
                                           $('#resp').append('<a href="#" data-value="'+ data1[z] +'" onclick="showvalue(this);" class="recent btn text-muted" style="text-align: left;white-space: normal;"><i class="fa fa-clock-o"></i> '+ data1[z] +'<br/></a>');
                                         }
                                          document.getElementById('address').value = " ";     
                                       }
                                   });*/
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

				})
				</script>

@stop
