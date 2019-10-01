<style>
   .enun{
   	color: gray;
   }
</style>
@isset($emptyc)

		<div align="center" class="col-sm-12 enun">
			        <img src="{{ asset(config($icon)) }}" height="180" width="180" id="imgEmpty">
			        <h3>Nada que mostrar!</h3>
				      <h4> <span class="spanEmpty1"> No tienes {{ $title }} agregados </span>
				   @if($emptyc != "not_buttom")
				    <span class="spanEmpty">, <br> podrías generar tu primer registro aquí</span></h4><br>
				    <form action="create" method="get" id="form_profile2">
					    <button type="submit" class="btn btn-default btn-flat buttonEmpty"> Generar {{ $title }} </button>
					<a class="btn text-muted">Más información</a>
				    </form>
				   @else
					</h4>
					<a class="btn text-muted" style="display: inline-block;">Más información</a>
					@endif
		</div>

@endisset
