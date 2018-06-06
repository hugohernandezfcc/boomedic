
@isset($indicator)
    

	@switch($indicator)
	    @case('NOT_DATA_LIST')


	    	<li>
	    		<div class="row">
	    			<div class="col-sm-6">
	    					<i class="fa fa-fw"></i>
	    			</div>
	    			<div class="col-sm-6">
	    					@isset($title)
	    						No contienes {{ $title }} que mostrar.
	    					@isset($indicator)

	    					@isset(!$title)
	    						No contienes registros que mostrar.
	    					@isset($indicator)
	    			</div>
	    		</div>
	    	</li>


	        @break

	    @case(2)
	        Second case...
	        @break

	    @default
	        Default case...
	@endswitch


@endisset

