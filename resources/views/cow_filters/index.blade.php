@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading">Filtros para vacas</div>
				<div class="panel-body">
					<form class="form-horizontal" action="{{ route('cow_filters.search') }}" method="get">
						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_tag">Arete Siniga</label>
						<div class="col-sm-9">
							<input type="text" name="cattle_tag" class="form-control" placeholder="Etiqueta">
						</div>
						</div>

						<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="submit" class="btn btn-primary" value="Buscar">
						</div>
						</div>
					</form>
				</div>
				@if($cows->count() > 0)
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped">
						<thead>
							<tr>
								<th>Arete Siniga</th>
								<th>Fecha de nacimiento</th>
								<th>Fecha de compra</th>
								<th>Raza</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						@foreach($cows as $cow)
							<tr>
								<td>{{ $cow->cattle->tag }}</td>
								<td>{{ $cow->cattle->getBirthWithFormat() }}</td>
								<td>{{ $cow->cattle->getPurchaseDateWithFormat() }}</td>
								<td>{{ $cow->cattle->breed->name }}</td>
								<td>
                    				<a class="btn btn-info btn-xs" href="{{ route('cows.show', $cow->id) }}">Información</a>
								</td>
							</tr>
						@endforeach
						</tbody>
						</table>
					</div>
					<div>{{ $cows->links() }}</div>
				</div>
				@else
				<div class="panel-body">
					Sin resultados
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection