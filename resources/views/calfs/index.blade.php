@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					Becerros, {{ count($calfs) }}
					<a href="{{ route('calfs.create') }}">Agregar nuevo becerro</a>
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
						@foreach($calfs as $calf)
							<tr>
								<td>{{ $calf->cattle->tag }}</td>
								<td>{{ $calf->cattle->purchase_date }}</td>
								<td>{{ $calf->cattle->birth }}</td>
								<td>{{ $calf->cattle->breed->name }}</td>
								<td>
									<form class="" action="{{ route('calfs.destroy', $calf->id) }}" method="post">
										<input type="hidden" name="_method" value="delete">
                    					<input type="hidden" name="_token" value="{{ csrf_token() }}">
                    					<a class="btn btn-primary btn-xs" href="{{ route('calfs.edit', $calf->id) }}">Editar</a>
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