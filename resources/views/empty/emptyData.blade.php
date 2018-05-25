<style>
   .enun{
   	color: gray;
   }
</style>
		<div align="center" class="col-sm-12 enun">
			        <img src="{{ url(config('adminlte.adminlte', 'empty-box')) }}" height="200" width="200" id="imgEmpty">
			        <h3>OMG!</h3>
				    <h4> <span class="spanEmpty1"> No tienes {{ $title }} agregados </span><span class="spanEmpty">, <br> podrías generar tu primer registro aquí</span></h4><br>
				    <form action="create" method="get" id="form_profile2">
				    <button type="submit" class="btn btn-default btn-flat buttonEmpty"> Generar {{ $title }} </button><a class="btn text-muted">Más información</a>
				    </form>

		</div>
