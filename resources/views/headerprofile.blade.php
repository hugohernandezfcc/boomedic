<!DOCTYPE html>
<head></head>
<body>
	<div class="lockscreen-item" style="margin: 10px 0 30px auto;">

	    <!-- lockscreen credentials (contains the form) -->
	    <form class="lockscreen-credentials" action="create" method="get" id="form_profile">
	    	{{ csrf_field() }}
	      	<div class="input-group">
	        	<div class="form-control" align="left"><label id="labeltext">Agregar</label></div>
	        	<input type="hidden" name="id" value="{{ $userId }}">
	        	<div class="btn btn-default btn-circle" id="div_profile">
		          	<button type="submit" class="btn btn-default btn-circle">
		          		<i class="fa fa-plus text-muted" id="i_button"></i>
		          	</button>
	        	</div>
	      	</div>
	    </form>
	    <!-- /.lockscreen credentials -->
	</div>
</body>
</html>