@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading">Ventas</div>
				<div class="panel-body">

					<div class="row">
						<div class="col-lg-6">
							<form class="" action="{{ route('cows_sales.index') }}" method="get">
							<div class="input-group">
								<input type="text" class="form-control" name="search" placeholder="Buscar...">
								<span class="input-group-btn">
									<button type="submit" class="btn btn-info">
									<span class="glyphicon glyphicon-search"></span>
									</button>
								</span>
							</div>
							</form>
						</div>
					</div>

				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">Vacas ({{ count($cows) }})</div>
				@if($cows->count() > 0)
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
						@foreach($cows as $cow)
							<tr>
								<td>{{ $cow->cattle->tag }}</td>
								<td>{{ $cow->cattle->breed->name }}</td>
								<td>{{ $cow->cattle->getBirthWithFormat() }}</td>
								<td>{{ $cow->cattle->getPurchaseDateWithFormat() }}</td>
								<td>
									@if(count($cow->sale))
									{{ $cow->sale->getSaleDateWithFormat() }}
									@endif
								</td>
								<td>
									@if(count($cow->sale) == 0)
									<a class="btn btn-warning btn-sm" href="{{ route('cows_sales.create', 'cow=' . $cow->id) }}">Registrar venta</a>
									@else
									<a class="btn btn-info btn-sm" href="{{ route('cows_sales.show', $cow->id) }}">Información</a>
									<a class="btn btn-warning btn-sm" href="{{ route('cows_sales.edit', $cow->id) }}">Editar</a>
									@endif
								</td>
							</tr>
						@endforeach
						</tbody>
						</table>
					</div>
					<div>{{ $cows->links() }}</div>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection