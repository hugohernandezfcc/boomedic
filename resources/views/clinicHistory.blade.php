@extends('adminlte::page')

@section('title', 'Boomedic')
@section('content_header')
<style type="text/css">
.com { color: #93a1a1; }
.lit { color: #195f91; }
.pun, .opn, .clo { color: #93a1a1; }
.fun { color: #dc322f; }
.str, .atv { color: #D14; }
.kwd, .prettyprint .tag { color: #1e347b; }
.typ, .atn, .dec, .var { color: teal; }
.pln { color: #48484c; }

.prettyprint {
  padding: 8px;
  background-color: #f7f7f9;
  border: 1px solid #e1e1e8;
}
.prettyprint.linenums {
  -webkit-box-shadow: inset 40px 0 0 #fbfbfc, inset 41px 0 0 #ececf0;
     -moz-box-shadow: inset 40px 0 0 #fbfbfc, inset 41px 0 0 #ececf0;
          box-shadow: inset 40px 0 0 #fbfbfc, inset 41px 0 0 #ececf0;
}

/* Specify class=linenums on a pre to get line numbering */
ol.linenums {
  margin: 0 0 0 33px; /* IE indents via margin-left */
}
ol.linenums li {
  padding-left: 12px;
  color: #bebec5;
  line-height: 20px;
  text-shadow: 0 1px 0 #fff;
}
</style>
    <script src="{{ asset('js/jquery.bootstrap.wizard.js') }}"></script>
    <script src="{{ asset('js/prettify.js') }}"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
@stop
@section('content')


<div class="box">
  	<div class="box-header with-border">
	    <h3 class="box-title">Historia Clínica</h3>
  	</div>
  	<div class="box-body">
  	<div id="rootwizard">
					<div class="navbar">
					  <div class="navbar-inner">
					    <div class="container">
					<ul>
					  	<li><a href="#tab1" data-toggle="tab">First</a></li>
						<li><a href="#tab2" data-toggle="tab">Second</a></li>
						<li><a href="#tab3" data-toggle="tab">Third</a></li>
						<li><a href="#tab4" data-toggle="tab">Forth</a></li>
						<li><a href="#tab5" data-toggle="tab">Fifth</a></li>
						<li><a href="#tab6" data-toggle="tab">Sixth</a></li>
						<li><a href="#tab7" data-toggle="tab">Seventh</a></li>
					</ul>
					 </div>
					  </div>
					</div>
					<div id="bar" class="progress progress-striped active">
					  <div class="progress-bar"></div>
					</div>
					<div class="tab-content">
					    <div class="tab-pane" id="tab1">
					      1
					    </div>
					    <div class="tab-pane" id="tab2">
					      2
					    </div>
						<div class="tab-pane" id="tab3">
							3
					    </div>
						<div class="tab-pane" id="tab4">
							4
					    </div>
						<div class="tab-pane" id="tab5">
							5
					    </div>
						<div class="tab-pane" id="tab6">
							6
					    </div>
						<div class="tab-pane" id="tab7">
							7
					    </div>
						<ul class="pager wizard">
							<li class="previous first" style="display:none;"><a href="javascript:;">First</a></li>
							<li class="previous"><a href="javascript:;">Previous</a></li>
							<li class="next last" style="display:none;"><a href="javascript:;">Last</a></li>
						  	<li class="next"><a href="javascript:;">Next</a></li>
						</ul>
					</div>
				</div>
            </div>


	<script>
	$(document).ready(function() {
	  	$('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
			var $total = navigation.find('li').length;
			var $current = index+1;
			var $percent = ($current/$total) * 100;
			$('#rootwizard').find('.progress-bar').css({width:$percent+'%'});
		}});
	});
	</script>

@stop