@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>VENTA DE BECERROS</strong>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" action="{{ route('calves_sales.index') }}" method="get">
						{{ csrf_field() }}

						<div class="form-group">
						<label class="control-label col-sm-3" for="search">Arete Siniga:</label>
						<div class="col-sm-9">
							<div class="input-group">
								<input type="text" class="form-control" name="search" placeholder="Buscar...">
								<span class="input-group-btn">
									<button type="submit" class="btn btn-info">
									<span class="glyphicon glyphicon-search"></span>
									</button>
								</span>
							</div>
						</div>
						</div>

					</form>
				</div>
				<div class="panel-body">
				@if($calves->count() > 0)
					<div class="table-responsive">
						<table class="table table-hover table-condensed">
						<thead>
							<tr>
								<th>Becerro</th>
								<th>Raza</th>
								<th>Madre</th>
								<th>Fecha de nacimiento</th>
								<th>Fecha de compra</th>
								<th>Fecha de venta</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
						@foreach($calves as $calf)
							<tr>
								<td>{{ $calf->cattle->tag }}</td>
								<td>{{ $calf->cattle->breed->name }}</td>
								<td>{{ $calf->mother->cattle->tag }}</td>
								<td>{{ $calf->cattle->getBirthWithFormat() }}</td>
								<td>{{ $calf->cattle->getPurchaseDateWithFormat() }}</td>
								<td>
									@if(count($calf->sale) > 0)
									{{ $calf->sale->getSaleDateWithFormat()}}
									@endif
								</td>
								<td>
									@if(count($calf->sale) == 0)
									<a class="btn btn-success btn-sm" href="{{ route('calves_sales.create', 'calf=' . $calf->id) }}" data-container="body" data-toggle="tooltip" data-placement="top" title="Crear registro de venta">
										<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
									</a>
									@else
									<a class="btn btn-info btn-sm" href="{{ route('calves_sales.show', $calf->id) }}" data-container="body" data-toggle="tooltip" data-placement="top" title="Mostrar información del registro">
										<span class="glyphicon glyphicon-file" aria-hidden="true"></span>
									</a>
									<a class="btn btn-warning btn-sm" href="{{ route('calves_sales.edit', $calf->id) }}" data-container="body" data-toggle="tooltip" data-placement="top" title="Editar información del registro">
										<span class="glyphicon glyphicon-open" aria-hidden="true"></span>
									</a>
									@endif
								</td>
							</tr>
						@endforeach
						</tbody>
						</table>
					</div>
					<div>{{ $calves->links() }}</div>
				@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection