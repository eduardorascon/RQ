@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>BECERROS, registros: {{ $total_calves }}, </strong>
					<a href="{{ route('calfs.create') }}">Agregar nuevo registro</a>
				</div>
				@if($calfs->count() > 0)
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
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
						@foreach($calfs as $calf)
							<tr>
								<td>{{ $calf->cattle->tag }}</td>
								<td>{{ $calf->cattle->breed->name }}</td>
								<td>{{ $calf->cattle->getBirthWithFormat() }}</td>
								<td>{{ $calf->cattle->getPurchaseDateWithFormat() }}</td>
								<td>
									@if(count($calf->sale))
									{{ $calf->sale->getSaleDateWithFormat() }}
									@endif
								</td>
								<td>
									<form class="" action="{{ route('calfs.destroy', $calf->id) }}" method="post">
										<a class="btn btn-info btn-sm" data-container="body" data-toggle="tooltip" data-placement="top" title="Mostrar información del registro" href="{{ route('calfs.show', $calf->id) }}">
											<span class="glyphicon glyphicon-file" aria-hidden="true"></span>
										</a>
										<a class="btn btn-info btn-sm" data-container="body" data-toggle="tooltip" data-placement="top" title="Mostrar información del registro de la madre" href="{{ route('cows.show', $calf->mother->id) }}">
											<span class="glyphicon glyphicon-file" aria-hidden="true"></span> Madre
										</a>
	                    				<a class="btn btn-warning btn-sm" data-container="body" data-toggle="tooltip" data-placement="top" title="Editar información del registro" href="{{ route('calfs.edit', $calf->id) }}">
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
					<div>{{ $calfs->links() }}</div>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection