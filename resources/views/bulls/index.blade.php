@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading">
					Toros, {{ count($bulls) }}
					<a href="{{ route('bulls.create') }}">Agregar nuevo toro</a>
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
						@foreach($bulls as $bull)
							<tr>
								<td>{{ $bull->cattle->tag }}</td>
								<td>{{ $bull->cattle->purchase_date }}</td>
								<td>{{ $bull->cattle->birth }}</td>
								<td>{{ $bull->cattle->breed->name }}</td>
								<td>
									<form class="" action="{{ route('bulls.destroy', $bull->id) }}" method="post">
										<input type="hidden" name="_method" value="delete">
                    					<input type="hidden" name="_token" value="{{ csrf_token() }}">
                    					<a class="btn btn-primary btn-xs" href="{{ route('bulls.show', $bull->id) }}">Peso</a>
                    					<a class="btn btn-primary btn-xs" href="{{ route('bulls.edit', $bull->id) }}">Editar</a>
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