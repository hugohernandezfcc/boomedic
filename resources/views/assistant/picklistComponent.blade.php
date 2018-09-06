@if(!empty($as))

<style type="text/css">
.lockscreen-item {
    width: 200px !important;
    margin: 12px 0 0px auto !important
}
.lockscreen-image {
    left: -10px !important;
    top: -7px !important;
    background: #27a000 !important;
}
.lockscreen-image>img {
    z-index: 1000;
    width: 35px !important;
    height: 35px !important;
}
.lockscreen-credentials {
    margin-left: 24px;
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
	            <select class="form-control" name="doctor" id="mySelectd"> 
	            @foreach($as as $assi)	
                  <option value="{{ $assi->iddr }}">{{ $assi->name }}</option>
                @endforeach  
                </select>
      </div>
    </form>
  </div>
</div>
 </ul>
 	<script type="text/javascript">

 	$(document).ready(function () {
 		 $("#mySelectd").val("{{ session()->get('asdr') }}");
 	 var dr = JSON.stringify(@php echo $as; @endphp);
  	 dr =JSON.parse(dr);
 			for(var z=0; z < dr.length; z++){
 				if(dr[z]['iddr'] ==  $('#mySelectd option:selected').val()){
 					$('#imgDrA').attr('src', dr[z]['profile_photo']);

 				}	
 			}
 		$('#mySelectd').on('change', function() {

           
 			for(var x=0; x < dr.length; x++){
 				if(dr[x]['iddr'] ==  $('#mySelectd option:selected').val()){
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
				                             		 window.location.href = "{{ url('medicalconsultations') }}";
				                          }else{
 									window.location.href = "{{ url('drAppointments/redirecting/index') }}";
 								}

				                             }
				                         });                            	 			
 									}	
 								 }
 							})
 					})

 	</script>
 @endif