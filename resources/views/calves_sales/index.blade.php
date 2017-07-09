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
							<form class="" action="{{ route('calves_sales.index') }}" method="get">
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
				<div class="panel-heading">Becerros ({{ count($calves) }})</div>
				@if($calves->count() > 0)
				<div class="panel-body">
					<div class="table table-responsive">
						<table class="table table-striped">
						<thead>
							<tr>
								<th>Becerro</th>
								<th>Raza</th>
								<th>Madre</th>
								<th>Fecha de venta</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						@foreach($calves as $calf)
							<tr>
								<td>{{ $calf->cattle->tag }}</td>
								<td>{{ $calf->cattle->breed->name }}</td>
								<td>{{ $calf->mother->cattle->tag }}</td>
								<td>
									@if(count($calf->sale) > 0)
									{{ $calf->sale->getSaleDateWithFormat()}}
									@endif
								</td>
								<td>
									@if(count($calf->sale) == 0)
									<a class="btn btn-warning btn-xs" href="{{ route('calves_sales.create', 'calf=' . $calf->id) }}">Registrar venta</a>
									@else
									<a class="btn btn-info btn-xs" href="{{ route('calves_sales.show', $calf->id) }}">Información</a>
									<a class="btn btn-warning btn-xs" href="{{ route('calves_sales.edit', $calf->id) }}">Editar</a>
									@endif
								</td>
							</tr>
						@endforeach
						</tbody>
						</table>
					</div>
					<div>{{ $calves->links() }}</div>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection