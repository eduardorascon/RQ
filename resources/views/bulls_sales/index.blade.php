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
							<form class="" action="{{ route('bulls_sales.index') }}" method="get">
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
				<div class="panel-heading">Vacas ({{ count($bulls) }})</div>
				@if($bulls->count() > 0)
				<div class="panel-body">
					<div class="table table-responsive">
						<table class="table table-striped">
						<thead>
							<tr>
								<th>Vaca</th>
								<th>Raza</th>
								<th>Fecha de venta</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						@foreach($bulls as $bull)
							<tr>
								<td>{{ $bull->cattle->tag }}</td>
								<td>{{ $bull->cattle->breed->name }}</td>
								<td>
									@if(count($bull->sale) > 0)
									{{ $bull->sale->getSaleDateWithFormat()}}
									@endif
								</td>
								<td>
									@if(count($bull->sale) == 0)
									<a class="btn btn-warning btn-xs" href="{{ route('bulls_sales.create', 'bull=' . $bull->id) }}">Registrar venta</a>
									@else
									<a class="btn btn-info btn-xs" href="{{ route('bulls_sales.show', $bull->id) }}">Información</a>
									<a class="btn btn-warning btn-xs" href="{{ route('bulls_sales.edit', $bull->id) }}">Editar</a>
									@endif
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