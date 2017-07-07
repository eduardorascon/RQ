@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading">Toros ({{ $total_bulls }}), <a href="{{ route('bulls.create') }}">Agregar nuevo toro</a></div>
				@if($bulls->count() > 0)
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped">
						<thead>
							<tr>
								<th>Arete Siniga</th>
								<th>Fecha de nacimiento</th>
								<th>Fecha de compra</th>
								<th>Peso actual</th>
								<th>Raza</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						@foreach($bulls as $bull)
							<tr>
								<td>{{ $bull->cattle->tag }}</td>
								<td>{{ $bull->cattle->getBirthWithFormat() }}</td>
								<td>{{ $bull->cattle->getPurchaseDateWithFormat() }}</td>
								<td>{{ $bull->cattle->currentWeight() }} kgs</td>
								<td>{{ $bull->cattle->breed->name }}</td>
								<td>
									<form class="" action="{{ route('bulls.destroy', $bull->id) }}" method="post">
										<input type="hidden" name="_method" value="delete">
                    					<input type="hidden" name="_token" value="{{ csrf_token() }}">
                    					<a class="btn btn-info btn-xs" href="{{ route('bulls.show', $bull->id) }}">
                    						<span class="glyphicon glyphicon-file" aria-hidden="true"></span> Información
                    					</a>
                    					<a class="btn btn-success btn-xs" href="{{ route('bulls.edit', $bull->id) }}">
                    						<span class="glyphicon glyphicon-open" aria-hidden="true"></span> Editar
                    					</a>
                    					<button type="submit" name="btnBorrar" class="btn btn-danger btn-xs" onclick="return confirm('El registro será eliminado');">
                    						<span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Eliminar
                    					</button>
									</form>
								</td>
							</tr>
						@endforeach
						</tbody>
						</table>
					</div>
					<div>{{ $bulls->links() }}</div>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection