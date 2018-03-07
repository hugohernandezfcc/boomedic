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
          
            <label>{{ $questions1->question }}</label>
            <br>
            <label>Enter Response</label>
            <input class="form-control input-lg">
            
        </div>

         <a class="btn btn-secondary btn-flat next pull-right" href="#">Siguiente</a>
      </div>
        @endif
         @if(($loop->iteration > 1) && !$loop->last)
      <div class="tab-pane fade" id="step{{ $loop->iteration }}">
         <div class="well"> 
            <label>{{ $questions1->question }}</label>
            <br>
            <label>Enter Response</label>
            <input class="form-control  input-lg">
         </div>
         <a class="btn btn-default btn-flat prev pull-left" href="#">Atrás</a>
         <a class="btn btn-secondary btn-flat next pull-right" href="#">Siguiente</a>
      </div>
      @endif
       @if($loop->last)
      <div class="tab-pane fade" id="step{{ $loop->iteration }}">
         <div class="well"> 
            <label>{{ $questions1->question }}</label>
            <br>
            <label>Enter Response</label>
            <input class="form-control  input-lg">
         </div>
        <a class="btn btn-default btn-flat prev pull-left" href="#">Atrás</a>
        <a class="btn btn-secondary btn-flat first pull-left" href="#">Volver a iniciar</a>
        <a class="btn btn-secondary btn-flat pull-right" href="#">Guardar historia</a>
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