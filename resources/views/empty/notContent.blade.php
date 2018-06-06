
@isset($indicator)
    

	@if($indicator == 'NOT_DATA_LIST')
		<li>
    		<div class="row">
    			<div class="col-sm-6">
    					<i class="fa fa-fw"></i>
    			</div>
    			<div class="col-sm-6">
    					@isset($title)
    						No contienes {{ $title }} que mostrar.
    					@endisset
    			</div>
    		</div>
    	</li>
	@else
		other content...
	@endif


@endisset

