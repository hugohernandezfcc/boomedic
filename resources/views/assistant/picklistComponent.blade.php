@if(!empty($as))
<style type="text/css">
		.lockscreen-wrapper {
	      max-width: 100% !important;
	  	  margin-top: 3% !important;
	  	  margin-left: 1% !important;
		}
</style>

<div class="lockscreen-wrapper">
	<div class="lockscreen-item" style="width: 100% !important;">
    <!-- lockscreen image -->
    <div class="lockscreen-image">

      <img src="https://s3.amazonaws.com/abiliasf/profile-42914_640.png" alt="User Image" id="imgDrA">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials">
      <div class="input-group" style="display: block;">
	            <select class="select2" name="doctor" id="mySelectd"> 
	            @foreach($as as $assi)	
                  <option value="{{ $assi->iddr }}">{{ $assi->name }}</option>
                @endforeach  
                </select>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
 </div>
 <br>
 	<script type="text/javascript">

 	$(document).ready(function () {
 	 var dr = JSON.stringify(@php echo $as; @endphp);
  		dr =JSON.parse(dr);
 			for(var z=0; z < dr.length; z++){
 				console.log(dr[z]['iddr']);
 				if(dr[z]['iddr'] ==  $('#mySelectd option:selected').val()){
 					$('#imgDrA').attr('src', dr[z]['profile_photo']);
 				}	
 			}
 		$('#mySelectd').on('change', function() {
 			for(var z=0; z < dr.length; z++){
 				console.log(dr[z]['iddr']);
 				if(dr[z]['iddr'] ==  $('#mySelectd option:selected').val()){
 					$('#imgDrA').attr('src', dr[z]['profile_photo']);
 				}	
 			 }

 			})
 		})

 	</script>
 @endif