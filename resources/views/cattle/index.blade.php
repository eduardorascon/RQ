@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>GANADO, registros: {{ $CONTADOR }}, </strong>
					<a href="{{ route('cattle.create') }}">Agregar nuevo registro</a>
				</div>
				@if($all_cattle->count() > 0)
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-hover table-condensed">
						<thead>
							<tr>
								<th>@sortablelink('kind', 'Ganado')</th>
								<th>@sortablelink('tag', 'Arete Siniga')</th>
								<th>@sortablelink('control_tag', 'Arete de Control')</th>
								<th>@sortablelink('breed_name', 'Raza')</th>
								<th>@sortablelink('birth', 'Fecha de Nacimiento')</th>
								<th>@sortablelink('purchase_date', 'Fecha de Compra')</th>
								<th>@sortablelink('empadre_date', 'Fecha de Empadre')</th>
								<th>@sortablelink('sale_date', 'Fecha de Venta')</th>
								<th>@sortablelink('gender', 'Sexo')</th>
								<th>@sortablelink('current_weight', 'Peso')</th>
								<th>@sortablelink('age_in_months', 'Meses de edad')</th>
								<th>@sortablelink('pregnancy_status', 'Estado')</th>
								<th>@sortablelink('months_since_last_birth', 'Meses sin parir')</th>
								<th class="col-sm-2">Acciones</th>
							</tr>
						</thead>
						<tbody>
						@foreach($all_cattle as $cattle)
							<tr>
								<td>{{ $cattle->kind }}</td>
								<td>{{ $cattle->tag }}</td>
								<td>{{ $cattle->control_tag }}</td>
								<td>{{ $cattle->breed_name }}</td>
								<td>{{ $cattle->getBirthWithFormat() }}</td>
								<td>{{ $cattle->getPurchaseDateWithFormat() }}</td>
								<td>{{ $cattle->getEmpadreDateWithFormat() }}</td>
								<td>{{ $cattle->getSaleDateWithFormat() }}</td>
								<td>{{ $cattle->gender }}</td>
								<td>{{ $cattle->current_weight }} kgs</td>
								<td>{{ $cattle->age_in_months }}</td>
								<td>{{ $cattle->pregnancy_status }}</td>
								<td>{{ $cattle->months_since_last_birth }}</td>
								<td>
									@if($cattle->kind === 'Toro')
									<form class="" action="{{ route('bulls.destroy', $cattle->id) }}" method="post">
	                					<a class="btn btn-info btn-sm" data-container="body" data-toggle="tooltip" data-placement="top" title="Mostrar información del registro" href="{{ route('bulls.show', $cattle->id) }}">
											<span class="glyphicon glyphicon-file" aria-hidden="true"></span>
										</a>
	                    				<a class="btn btn-warning btn-sm" data-container="body" data-toggle="tooltip" data-placement="top" title="Editar información del registro" href="{{ route('bulls.edit', $cattle->id) }}">
	                    					<span class="glyphicon glyphicon-open" aria-hidden="true"></span>
	                    				</a>
                    					<input type="hidden" name="_method" value="delete">
                						<input type="hidden" name="_token" value="{{ csrf_token() }}">
                    					<button type="submit" name="btnBorrar" class="btn btn-danger btn-sm" data-container="body" data-toggle="tooltip" data-placement="top" title="Eliminar el registro" onclick="return confirm('El registro será eliminado');">
                    						<span class="glyphicon glyphicon-alert" aria-hidden="true"></span>
                    					</button>
									</form>
									@endif
									@if($cattle->kind === 'Becerro')
									<form class="" action="{{ route('calves.destroy', $cattle->id) }}" method="post">
										<a class="btn btn-info btn-sm" data-container="body" data-toggle="tooltip" data-placement="top" title="Mostrar información del registro" href="{{ route('calves.show', $cattle->id) }}">
											<span class="glyphicon glyphicon-file" aria-hidden="true"></span>
										</a>
										<a class="btn btn-info btn-sm" data-container="body" data-toggle="tooltip" data-placement="top" title="Mostrar información del registro de la madre" href="{{ route('cows.show', $cattle->mother_id) }}">
											<span class="glyphicon glyphicon-file" aria-hidden="true"></span> Madre
										</a>
	                    				<a class="btn btn-warning btn-sm" data-container="body" data-toggle="tooltip" data-placement="top" title="Editar información del registro" href="{{ route('calves.edit', $cattle->id) }}">
	                    					<span class="glyphicon glyphicon-open" aria-hidden="true"></span>
	                    				</a>
										<input type="hidden" name="_method" value="delete">
                    					<input type="hidden" name="_token" value="{{ csrf_token() }}">
                    					<button type="submit" name="btnBorrar" class="btn btn-danger btn-sm" data-container="body" data-toggle="tooltip" data-placement="top" title="Eliminar el registro" onclick="return confirm('El registro será eliminado');">
                    						<span class="glyphicon glyphicon-alert" aria-hidden="true"></span>
                    					</button>
									</form>
									@endif
									@if($cattle->kind === 'Vaca')
									<form class="" action="{{ route('cows.destroy', $cattle->id) }}" method="post">
										<a class="btn btn-info btn-sm" data-container="body" data-toggle="tooltip" data-placement="top" title="Mostrar información del registro" href="{{ route('cows.show', $cattle->id) }}">
											<span class="glyphicon glyphicon-file" aria-hidden="true"></span>
										</a>
	                    				<a class="btn btn-warning btn-sm" data-container="body" data-toggle="tooltip" data-placement="top" title="Editar información del registro" href="{{ route('cows.edit', $cattle->id) }}">
	                    					<span class="glyphicon glyphicon-open" aria-hidden="true"></span>
	                    				</a>
										<input type="hidden" name="_method" value="delete">
                    					<input type="hidden" name="_token" value="{{ csrf_token() }}">
                    					<button type="submit" name="btnBorrar" class="btn btn-danger btn-sm" data-container="body" data-toggle="tooltip" data-placement="top" title="Eliminar el registro" onclick="return confirm('El registro será eliminado');">
                    						<span class="glyphicon glyphicon-alert" aria-hidden="true"></span>
                    					</button>
									</form>
									@endif
								</td>
							</tr>
						@endforeach
						</tbody>
						</table>
					</div>
					<div>{{ $all_cattle->appends(\Request::except('page'))->render() }}</div>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection