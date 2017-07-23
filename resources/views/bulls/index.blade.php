@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>TOROS, registros: {{ $total_bulls }}, </strong>
					<a href="{{ route('bulls.create') }}">Agregar nuevo registro</a>
				</div>
				@if($bulls->count() > 0)
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-hover table-condensed">
						<thead>
							<tr>
								<th>Arete Siniga</th>
								<th>Raza</th>
								<th>Fecha de nacimiento</th>
								<th>Fecha de compra</th>
								<th>Fecha de venta</th>
								<th>Peso actual</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
						@foreach($bulls as $bull)
							<tr>
								<td>{{ $bull->cattle->tag }}</td>
								<td>{{ $bull->cattle->breed->name }}</td>
								<td>{{ $bull->cattle->getBirthWithFormat() }}</td>
								<td>{{ $bull->cattle->getPurchaseDateWithFormat() }}</td>
								<td>
									@if(count($bull->sale))
									{{ $bull->sale->getSaleDateWithFormat() }}
									@endif
								</td>
								<td>
									{{ $bull->cattle->currentWeight() }} kgs
								</td>
								<td>
									<form class="" action="{{ route('bulls.destroy', $bull->id) }}" method="post">
	                					<a class="btn btn-info btn-sm" data-container="body" data-toggle="tooltip" data-placement="top" title="Mostrar información del registro" href="{{ route('bulls.show', $bull->id) }}">
											<span class="glyphicon glyphicon-file" aria-hidden="true"></span>
										</a>
	                    				<a class="btn btn-warning btn-sm" data-container="body" data-toggle="tooltip" data-placement="top" title="Editar información del registro" href="{{ route('bulls.edit', $bull->id) }}">
	                    					<span class="glyphicon glyphicon-open" aria-hidden="true"></span>
	                    				</a>
                    					<input type="hidden" name="_method" value="delete">
                						<input type="hidden" name="_token" value="{{ csrf_token() }}">
                    					<button type="submit" name="btnBorrar" class="btn btn-danger btn-sm" data-container="body" data-toggle="tooltip" data-placement="top" title="Eliminar el registro" onclick="return confirm('El registro será eliminado');">
                    						<span class="glyphicon glyphicon-alert" aria-hidden="true"></span>
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