@if(!empty($as))

<style type="text/css">
	.lockscreen-item {
    width: 200px !important;
    margin: 12px 0 7px auto !important
}
.lockscreen-image {
    left: -10px !important;
    top: -7px !important;
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
</ul>
<div class="user-panel">
	<div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="https://s3.amazonaws.com/abiliasf/profile-42914_640.png" id="imgDrA"  class="img-circle">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials">
      <div class="input-group" style="display: block !important;">
	            <select class="form-control" name="doctor" id="mySelectd"> 
	            @foreach($as as $assi)	
                  <option value="{{ $assi->iddr }}">{{ $assi->name }}</option>
                @endforeach  
                </select>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
        <!--<div class="pull-left image">
			 <img src="https://s3.amazonaws.com/abiliasf/profile-42914_640.png" id="imgDrA"  class="img-circle">
        </div>
        <div class="pull-left info">
        	<form role="form">
	            <select class="form-control" name="doctor" id="mySelectd"> 
	            @foreach($as as $assi)	
                  <option value="{{ $assi->iddr }}">{{ $assi->name }}</option>
                @endforeach  
                </select>
            </form>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>-->
</div>
 <br>
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