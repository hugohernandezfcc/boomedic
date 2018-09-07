@if(!empty($as))

	<style type="text/css">
		.lockscreen-item {
		    width: 200px !important;
		    margin: 12px 0 0px auto !important
		}
		.lockscreen-image {
		    left: -10px !important;
		    top: -7px !important;
		}
		.lockscreen-image>img {
		    z-index: 1000;
		    width: 35px !important;
		    height: 35px !important;
		    background:  #b7b7b7eb !important;
		}
		.lockscreen-credentials {
		    margin-left: 24px;
		}
		.online{
			background: #00a65a !important;
		}
		.offline{	
			background: #b7b7b7eb !important;
		}
		.select{
			color: #b8c7ce;
			background: #333;
			border:1px solid #333;
		}
		.select:hover{
			border:1px solid #b8c7ce;
		}
		.select option:hover{
			background: black !important;
			border:1px solid #b8c7ce;
		}
	</style>

<ul class="sidebar-menu">
	<li class="header">DOCTOR</li>

<div class="user-panel">
	<div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="https://s3.amazonaws.com/abiliasf/profile-42914_640.png" id="imgDrA"  class="img-circle">
    </div>
    <form class="lockscreen-credentials">
      <div class="input-group" style="display: block !important;">
	            <select class="form-control select" name="doctor" id="mySelectd"> 
	            @foreach($as as $assi)	
	            	 @foreach($donli as $de)
	            	    @if($assi->iddr == $de['id'])
                  		 <option value="{{ $assi->iddr }}" col="{{ $de['online'] }}">{{ $assi->name }}</option>
                  		@endif 
                  	 @endforeach	 
                @endforeach  
                </select>
      </div>
    </form>
  </div>
</div>
 </ul>
 	<script type="text/javascript">

 	$(document).ready(function () {
 		 var url =  window.location.href;
 		 if(url.search('/doctor/laborInformationView') != '-1'){
 		 		$("#mySelectd").prop('disabled', true);
 		 }else{
 		 	$("#mySelectd").prop('disabled', false);
 		 }
 		 $("#mySelectd").val("{{ session()->get('asdr') }}");
 	 var dr = JSON.stringify(@php echo $as; @endphp);

  	 dr =JSON.parse(dr);
 			for(var z=0; z < dr.length; z++){
 				if(dr[z]['iddr'] ==  $('#mySelectd option:selected').val()){
 					$('#imgDrA').attr('src', dr[z]['profile_photo']);
 					 if($('#mySelectd option:selected').attr('col') == '1'){
 					 	$('.lockscreen-image').addClass('online');
 					 }else{
 					 	$('.lockscreen-image').addClass('offline');
 					 }

 				}	
 			}
 		$('#mySelectd').on('change', function() {
 			for(var x=0; x < dr.length; x++){
 				if(dr[x]['iddr'] ==  $('#mySelectd option:selected').val()){
 					 if($('#mySelectd option:selected').attr('col') == '1'){
 					 	$('.lockscreen-image').addClass('online');
 					 	$('.lockscreen-image').removeClass('offline');
 					 }else{
 					 	$('.lockscreen-image').addClass('offline');
 					 	$('.lockscreen-image').removeClass('online');
 					 }
 					console.log(dr[x]['iddr']);
 					$('#imgDrA').attr('src', dr[x]['profile_photo']);
 					 				$.ajax({     
				                             type: "GET",                 
				                             url: "{{ url('user/select') }}/" + dr[x]['iddr'] ,           
				                             success: function(result)             
				                             {
				                             	if(window.location.href == "{{ url('medicalconsultations') }}"){
				                             		console.log(result);
				                             		 var data = 0;
				                             		 clearTimeout(timer);
													 $("#mid").val(data);
													 $('#time').val('0');
													 $('.textbody').prop('disabled', true);
													 $('.chatbut').prop('disabled', true);
				                             		 get(data);
				                          }else{
				 									location.reload();
				 								}

				                             }
				                         });                            	 			
 									}	
 								 }
 							})
 					})

 	</script>
 @endif