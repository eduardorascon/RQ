@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading">
					Vacas, {{ count($cows) }}
					<a href="{{ route('cows.create') }}">Agregar nueva vaca</a>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped">
						<thead>
							<tr>
								<th>Etiqueta</th>
								<th>Fecha de compra</th>
								<th>Fecha de nacimiento</th>
								<th>Raza</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						@foreach($cows as $cow)
							<tr>
								<td>{{ $cow->cattle->tag }}</td>
								<td>{{ $cow->cattle->purchase_date }}</td>
								<td>{{ $cow->cattle->birth }}</td>
								<td>{{ $cow->cattle->breed->name }}</td>
								<td>
									<form class="" action="{{ route('cows.destroy', $cow->id) }}" method="post">
										<input type="hidden" name="_method" value="delete">
                    					<input type="hidden" name="_token" value="{{ csrf_token() }}">
                    					<a class="btn btn-primary btn-xs" href="{{ route('cows.show', $cow->id) }}">Peso</a>
                    					<a class="btn btn-primary btn-xs" href="{{ route('cows.edit', $cow->id) }}">Editar</a>
                    					<input class="btn btn-danger btn-xs" type="submit" onclick="return confirm('El registro será eliminado');" name="btnBorrar" value="Eliminar">
									</form>
								</td>
							</tr>
						@endforeach
						</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection