@if(!empty($as))
<style type="text/css">
		.lockscreen-wrapper {
	      max-width: 100% !important;
	  	  margin-top: 1% !important;
		}
</style>

<div class="lockscreen-wrapper">
	<div class="lockscreen-item" style="width: 100% !important;">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="https://s3.amazonaws.com/abiliasf/profile-42914_640.png" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials">
      <div class="input-group" style="display: block;">
	            <select class="select2" name="doctor" id="mySelectd"> 
	            @foreach($as as $assi)	
                  <option id="{{ $assi->iddr }}">{{ $assi->name }}</option>
                @endforeach  
                </select>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
 </div>
 <br>
 @endif