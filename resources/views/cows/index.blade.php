@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>VACAS, registros: {{ $total_cows }}, </strong>
					<a href="{{ route('cows.create') }}">Agregar nuevo registro</a>
				</div>
				@if($cows->count() > 0)
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-hover table-condensed">
						<thead>
							<tr>
								<th>@sortablelink('tag', 'Arete Siniga')</th>
								<th>@sortablelink('control_tag', 'Arete de Control')</th>
								<th>@sortablelink('breed_name', 'Raza')</th>
								<th>@sortablelink('birth', 'Fecha de nacimiento')</th>
								<th>@sortablelink('purchase_date', 'Fecha de compra')</th>
								<th>@sortablelink('empadre_date', 'Fecha de empadre')</th>
								<th>@sortablelink('sale_date', 'Fecha de venta')</th>
								<th>@sortablelink('current_weight', 'Peso actual')</th>
								<th>@sortablelink('age_in_months', 'Meses de edad')</th>
								<th>@sortablelink('pregnancy_status', 'Estado')</th>
								<th>@sortablelink('months_since_last_birth', 'Meses sin parir')</th>
								<th class="col-sm-2">Acciones</th>
							</tr>
						</thead>
						<tbody>
						@foreach($cows as $cow)
							<tr>
								<td>{{ $cow->tag }}</td>
								<td>{{ $cow->control_tag }}</td>
								<td>{{ $cow->breed_name }}</td>
								<td>{{ $cow->getBirthWithFormat() }}</td>
								<td>{{ $cow->getPurchaseDateWithFormat() }}</td>
								<td>{{ $cow->getEmpadreDateWithFormat() }}</td>
								<td>{{ $cow->getSaleDateWithFormat() }}</td>
								<td>{{ $cow->current_weight }} kgs</td>
								<td>{{ $cow->age_in_months }}</td>
								<td>{{ $cow->pregnancy_status }}</td>
								<td>{{ $cow->months_since_last_birth }}</td>
								<td>
									<form class="" action="{{ route('cows.destroy', $cow->id) }}" method="post">
										<a class="btn btn-info btn-sm" data-container="body" data-toggle="tooltip" data-placement="top" title="Mostrar información del registro" href="{{ route('cows.show', $cow->id) }}">
											<span class="glyphicon glyphicon-file" aria-hidden="true"></span>
										</a>
	                    				<a class="btn btn-warning btn-sm" data-container="body" data-toggle="tooltip" data-placement="top" title="Editar información del registro" href="{{ route('cows.edit', $cow->id) }}">
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
					<div>{{ $cows->appends(\Request::except('page'))->render() }}</div>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection