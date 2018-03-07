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
     <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="5" style="width: 20%;">
       20%
     </div>
   </div>
  
   <div class="navbar">
      <div class="navbar-inner">
            <ul class="nav nav-pills pull-center">
               <li class="active"><a href="#step1" data-toggle="tab" data-step="1">1</a></li>
               <li><a href="#step2" data-toggle="tab" data-step="2">2</a></li>
               <li><a href="#step3" data-toggle="tab" data-step="3">3</a></li>
               <li><a href="#step4" data-toggle="tab" data-step="4">4</a></li>
               <li><a href="#step5" data-toggle="tab" data-step="5">5</a></li>
            </ul>
      </div>
   </div>
   <div class="tab-content">
      <div class="tab-pane fade in active" id="step1">
         
        <div class="well"> 
          
            <label>Question 1</label>
            <select class="form-control input-lg">
              <option value="What was the name of your first pet?">What was the name of your first pet?</option>
              <option value="Where did you first attend school?">Where did you first attend school?</option>
              <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
              <option value="What is your favorite car model?">What is your favorite car model?</option>
            </select>
            <br>
            <label>Enter Response</label>
            <input class="form-control input-lg">
            
        </div>

         <a class="btn btn-secondary btn-flat next pull-right" href="#">Siguiente</a>
      </div>
      <div class="tab-pane fade" id="step2">
         <div class="well"> 
          
            <label>Security Question 2</label>
            <select class="form-control  input-lg">
              <option value="What was the name of your first pet?">What was the name of your first pet?</option>
              <option selected="" value="Where did you first attend school?">Where did you first attend school?</option>
              <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
              <option value="What is your favorite car model?">What is your favorite car model?</option>
            </select>
            <br>
            <label>Enter Response</label>
            <input class="form-control  input-lg">
            
         </div>
         <a class="btn btn-default btn-flat prev pull-left" href="#">Atrás</a>
         <a class="btn btn-secondary btn-flat next pull-right" href="#">Siguiente</a>
      </div>
      <div class="tab-pane fade" id="step3">
        <div class="well"> <h2>Step 3</h2> Add another step here..</div>
        <a class="btn btn-default btn-flat prev pull-left" href="#">Atrás</a>
         <a class="btn btn-secondary btn-flat next pull-right" href="#">Siguiente</a>
      </div>
      <div class="tab-pane fade" id="step4">
        <div class="well"> <h2>Step 4</h2> Add another almost done step here..</div>
        <a class="btn btn-default btn-flat prev pull-left" href="#">Atrás</a>
         <a class="btn btn-secondary btn-flat next pull-right" href="#">Siguiente</a>
      </div>
      <div class="tab-pane fade" id="step5">
        <div class="well"> <h2>Step 5</h2> You're Done!</div>
        <a class="btn btn-default btn-flat prev pull-left" href="#">Atrás</a>
        <a class="btn btn-secondary btn-flat first pull-left" href="#">Volver a iniciar</a>
        <a class="btn btn-secondary btn-flat pull-right" href="#">Guardar historia</a>
        

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
					  var percent = (parseInt(step) / 5) * 100;
					  
					  $('.progress-bar').css({width: percent + '%'});
					  $('.progress-bar').text(percent + "%");
					  
					  //e.relatedTarget // previous tab
					  
					});

					$('.first').click(function(){

					  $('#myWizard a:first').tab('show')

					});

				})
				</script>

@stop