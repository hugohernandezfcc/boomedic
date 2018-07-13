@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')
	<style type="text/css">
		 .nav-stacked>li.active>a {
		    border-left-color: #080808 !important;
		}
	</style>
@stop

@section('content')
<div class="box">
  	<div class="box-header with-border">
	    <h3 class="box-title">Inbox</h3>
  	</div>
  	<div class="box-body">
  		<b>{{ $count }}</b><br>
	  	<ul class="nav nav-pills nav-stacked">
	  		<li class="active"><label>Adjuntos descargados a Amazón S3:</label></li>	
	  		@foreach($files as $f)
	            <li>{{ $f }}</li>
	  		@endforeach
	  	</ul>
	  
  	</div>	
  		
@stop