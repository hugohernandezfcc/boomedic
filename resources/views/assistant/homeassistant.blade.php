@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')

@stop

@section('content')
	<div class="row">
        <div class="col-lg-3 col-xs-6">
          	<div class="small-box bg-aqua">
	            <div class="inner">
	              	<h3>150</h3>
	              	<p>Proximas citas</p>
	            </div>
	            <div class="icon">
	              	<i class="fa fa-calendar"></i>
	            </div>
	            <a class="small-box-footer" href="javascript:void(0)">Detalles <i class="fa fa-arrow-circle-right"></i></a>
          	</div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          	<div class="small-box bg-green">
            	<div class="inner">
              		<h3>53<sup style="font-size: 20px">%</sup></h3>
              		<p>Saldos</p>
            	</div>
            	<div class="icon">
              		<i class="ion ion-stats-bars"></i>
            	</div>
            	<a class="small-box-footer" href="javascript:void(0)">Detalles <i class="fa fa-arrow-circle-right"></i></a>
          	</div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          	<div class="small-box bg-primary">
            	<div class="inner">
              		<h3>44</h3>
              		<p>Expedientes</p>
            	</div>
            	<div class="icon">
              		<i class="ion ion-person-add"></i>
            	</div>
            	<a class="small-box-footer" href="javascript:void(0)">Detalles <i class="fa fa-arrow-circle-right"></i></a>
          	</div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          	<div class="small-box bg-teal">
            	<div class="inner">
              		<h3>44</h3>
              		<p>Interacciones</p>
            	</div>
            	<div class="icon">
              		<i class="fa fa-comments"></i>
            	</div>
            	<a class="small-box-footer" href="javascript:void(0)">Detalles <i class="fa fa-arrow-circle-right"></i></a>
          	</div>
        </div>
        <!-- ./col -->
      </div>
		      <div class="row">
			    <div class="col-lg-7">
		        	      @include('conversations.conversationform')
		        </div>
		      </div>  

@stop