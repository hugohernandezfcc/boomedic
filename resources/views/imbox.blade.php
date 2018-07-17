@extends('adminlte::page')

@section('title', 'Boomedic')

@section('content_header')
	<style type="text/css">
		.callout-gray{
			background-color: #fff !important;
			border-color: #777;		
		}
		.callout a{
			text-decoration: none !important;
		}
	</style>
@stop

@section('content')
<div class="box">
  	<div class="box-header with-border">
	    <h3 class="box-title">Imbox</h3>
  	</div>
  	<div class="box-body">
     @if($count > 0) 
  		<b>Adjuntos recibidos #{{ $count }}</b><br><br>
  			@foreach($files as $f)
			 <div class="callout callout-gray">
        <form action="{{ url('clinichistory/reSender') }}" method="post">
          <input type="hidden" name="id" value="{{ $f->id }}">
                <h4>Asunto: {{ $f->subject_email }} <button type="submit" class="btn btn-default btn-xs">Reenviar a correo personal <i class="fa fa-envelope"></i></button></h4>
                <p>From: {{ $f->email }}
                <br>Fecha: {{  $f->date_email }}<br><a href="{{ $f->url }}" class="btn btn-secondary btn-sm">{{ $f->details }}</a> 
                
                @php
					         echo $f->text_email;
                @endphp
                </p>
        </form>        
      </div>
	  		@endforeach
      @else
           @include('empty.emptyData', 
                              [
                                'emptyc' => 'not_buttom',
                                'title'  => 'Bandeja de adjuntos',
                                'icon'   => 'adminlte.empty-box'
                              ]
                            )
      @endif  

	</div>  
</div>	
  		
@stop