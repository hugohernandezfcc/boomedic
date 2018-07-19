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
    .closeb {
      float: right;
      cursor: pointer;

    }
     .dropdown-menu>li>a {
       color: #333 !important;
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
                <h4>Asunto: {{ $f->subject_email }} 
                 <div class="btn-group closeb"> 
                  <button  class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></button>
                  <ul class="dropdown-menu dropdown-menu-right" role="menu" style="float: left !important;">
                    <li><a onclick="send('{{ $f->id }}');">Reenviar a correo personal</a></li>
                  </ul>
                </div>
                  </h4>
                <p>From: {{ $f->email }}
                <br>Fecha: {{  $f->date_email }}<br><a href="{{ $f->url }}" class="btn btn-secondary btn-sm">{{ $f->details }}</a> 
                
                @php
					         echo $f->text_email;
                @endphp
                </p>  
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
<script type="text/javascript">
      function send(id){
                            $.ajax(
                                    {
                                      type: "GET",    
                                      url: "{{ url('clinicHistory/reSender') }}/" + id, 
                                      success: function(result){
                                               alert(result); 
                                      }
                                    })
      }
</script>  		
@stop