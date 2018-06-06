
@isset($indicator)
    

	@if($indicator == 'NOT_DATA_LIST')
		<li style="background-color: #f6f6f6;">
    		<div class="row">
    			<div class="col-sm-5" align="center">
    				<i class="fa fa-fw fa-edit "></i>
    			</div>
    			<div class="col-sm-7" align="center">
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
