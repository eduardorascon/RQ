@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>VENTA DE TOROS</strong>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" action="{{ route('bulls_sales.index') }}" method="get">
						{{ csrf_field() }}

						<div class="form-group">
						<label class="control-label col-sm-3" for="search">Arete Siniga:</label>
						<div class="col-sm-9">
							<div class="input-group col-sm-6">
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
				@if($bulls->count() > 0)
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
						@foreach($bulls as $bull)
							<tr>
								<td>{{ $bull->cattle->tag }}</td>
								<td>{{ $bull->cattle->breed->name }}</td>
								<td>{{ $bull->cattle->getBirthWithFormat() }}</td>
								<td>{{ $bull->cattle->getPurchaseDateWithFormat() }}</td>
								<td>
									@if(count($bull->sale) > 0)
									{{ $bull->sale->getSaleDateWithFormat()}}
									@endif
								</td>
								<td>
									@if(count($bull->sale) == 0)
									<a class="btn btn-success btn-sm" href="{{ route('bulls_sales.create', 'bull=' . $bull->id) }}" data-container="body" data-toggle="tooltip" data-placement="top" title="Crear registro de venta">
										<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
									</a>
									@else
									<a class="btn btn-info btn-sm" href="{{ route('bulls_sales.show', $bull->id) }}" data-container="body" data-toggle="tooltip" data-placement="top" title="Mostrar información del registro">
										<span class="glyphicon glyphicon-file" aria-hidden="true"></span>
									</a>
									<a class="btn btn-warning btn-sm" href="{{ route('bulls_sales.edit', $bull->id) }}" data-container="body" data-toggle="tooltip" data-placement="top" title="Editar información del registro">
										<span class="glyphicon glyphicon-open" aria-hidden="true"></span>
									</a>
									@endif
								</td>
							</tr>
						@endforeach
						</tbody>
						</table>
					</div>
					<div>{{ $bulls->links() }}</div>
				@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection