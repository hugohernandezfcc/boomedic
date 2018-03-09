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

	</style>
<div class="box">
  	<div class="box-header with-border">
	    <h3 class="box-title">Historia Clínica</h3>
  	</div>
  @if($mode == 'null')  
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
@endif
@if($mode == 'finish')



    <section class="content-header">
      <h1>
        Timeline
        <small>example</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">UI</a></li>
        <li class="active">Timeline</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- row -->
      <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    10 Feb. 2014
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                <div class="timeline-body">
                  Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                  weebly ning heekya handango imeem plugg dopplr jibjab, movity
                  jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                  quora plaxo ideeli hulu weebly balihoo...
                </div>
                <div class="timeline-footer">
                  <a class="btn btn-primary btn-xs">Read more</a>
                  <a class="btn btn-danger btn-xs">Delete</a>
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-user bg-aqua"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-comments bg-yellow"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                <div class="timeline-body">
                  Take me to your leader!
                  Switzerland is small and neutral!
                  We are more like Germany, ambitious and misunderstood!
                </div>
                <div class="timeline-footer">
                  <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-green">
                    3 Jan. 2014
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-camera bg-purple"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                <div class="timeline-body">
                  <img src="http://placehold.it/150x100" alt="..." class="margin">
                  <img src="http://placehold.it/150x100" alt="..." class="margin">
                  <img src="http://placehold.it/150x100" alt="..." class="margin">
                  <img src="http://placehold.it/150x100" alt="..." class="margin">
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-video-camera bg-maroon"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> 5 days ago</span>

                <h3 class="timeline-header"><a href="#">Mr. Doe</a> shared a video</h3>

                <div class="timeline-body">
                  <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tMWkeBIohBs" frameborder="0" allowfullscreen=""></iframe>
                  </div>
                </div>
                <div class="timeline-footer">
                  <a href="#" class="btn btn-xs bg-maroon">See comments</a>
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
          </ul>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row" style="margin-top: 10px;">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-code"></i> Timeline Markup</h3>
            </div>
            <div class="box-body">
                  <pre style="font-weight: 600;">&lt;ul class="timeline"&gt;

    &lt;!-- timeline time label --&gt;
    &lt;li class="time-label"&gt;
        &lt;span class="bg-red"&gt;
            10 Feb. 2014
        &lt;/span&gt;
    &lt;/li&gt;
    &lt;!-- /.timeline-label --&gt;

    &lt;!-- timeline item --&gt;
    &lt;li&gt;
        &lt;!-- timeline icon --&gt;
        &lt;i class="fa fa-envelope bg-blue"&gt;&lt;/i&gt;
        &lt;div class="timeline-item"&gt;
            &lt;span class="time"&gt;&lt;i class="fa fa-clock-o"&gt;&lt;/i&gt; 12:05&lt;/span&gt;

            &lt;h3 class="timeline-header"&gt;&lt;a href="#"&gt;Support Team&lt;/a&gt; ...&lt;/h3&gt;

            &lt;div class="timeline-body"&gt;
                ...
                Content goes here
            &lt;/div&gt;

            &lt;div class="timeline-footer"&gt;
                &lt;a class="btn btn-primary btn-xs"&gt;...&lt;/a&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/li&gt;
    &lt;!-- END timeline item --&gt;

    ...

&lt;/ul&gt;
                  </pre>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    <div><div class="row docs-premium-template">
                    <div class="col-sm-12 col-md-6">
                <div class="box box-solid">
                    <div class="box-body">
                        <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                            PREMIUM TEMPLATE
                        </h4>
                        <div class="media">
                            <div class="media-left">
                                <a href="https://www.creative-tim.com/product/material-dashboard-pro-angular2?affiliate_id=97705" class="ad-click-event">
                                    <img src="/uploads/images/free_templates/creative-tim-material-angular.png" alt="Material Dashboard Pro" class="media-object" style="width: 150px;height: auto;border-radius: 4px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
                                </a>
                            </div>
                            <div class="media-body">
                                <div class="clearfix">
                                    <p class="pull-right">
                                        <a href="https://www.creative-tim.com/product/material-dashboard-pro-angular2?affiliate_id=97705" class="btn btn-success btn-sm ad-click-event">
                                            LEARN MORE
                                        </a>
                                    </p>

                                    <h4 style="margin-top: 0">Material Dashboard Pro ─ $59</h4>

                                    <p>Angular 2 Premium Material Bootstrap Admin with a fresh, new design inspired by Google's Material Design</p>
                                    <p style="margin-bottom: 0">
                                        <i class="fa fa-shopping-cart margin-r5"></i> 853+ purchases
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                    <div class="col-sm-12 col-md-6">
                <div class="box box-solid">
                    <div class="box-body">
                        <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                            PREMIUM TEMPLATE
                        </h4>
                        <div class="media">
                            <div class="media-left">
                                <a href="https://www.creative-tim.com/product/now-ui-kit-pro?affiliate_id=97705" class="ad-click-event">
                                    <img src="/uploads/images/free_templates/now_ui_kit.jpg" alt="Now UI Kit" class="media-object" style="width: 150px;height: auto;border-radius: 4px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
                                </a>
                            </div>
                            <div class="media-body">
                                <div class="clearfix">
                                    <p class="pull-right">
                                        <a href="https://www.creative-tim.com/product/now-ui-kit-pro?affiliate_id=97705" class="btn btn-success btn-sm ad-click-event">
                                            LEARN MORE
                                        </a>
                                    </p>

                                    <h4 style="margin-top: 0">Now UI Kit ─ $69</h4>

                                    <p>A beautiful Bootstrap 4 UI kit featuring over 1000 components, 34 sections and 11 example pages</p>
                                    <p style="margin-bottom: 0">
                                        <i class="fa fa-shopping-cart margin-r5"></i> 297+ purchases
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
</div></section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright © 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-theme-demo-options-tab" data-toggle="tab"><i class="fa fa-wrench"></i></a></li><li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked="">
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked="">
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked="">
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked="">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

@endif
            </div>
        </div>

				<script>
				$(document).ready(function () {

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
