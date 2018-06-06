
@isset($indicator)
    

	@if($indicator == 'NOT_DATA_LIST')
		<li>
    		<div class="row">
    			<div class="col-sm-6" align="right">
    				<i class="fa fa-fw fa-edit "></i>
    			</div>
    			<div class="col-sm-6">
					@isset($title)
						No contienes <b>{{ $title }}</b> que mostrar.
					@endisset
    			</div>
    		</div>
    	</li>
	@else
		other content...
	@endif


@endisset
