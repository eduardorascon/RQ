@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Total de Registros: {{ $total_cows }} </strong>
					<a class="btn btn-primary btn-sm" href="{{ route('cows.create') }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
				</div>
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
									<form class="" action="{{ route('cows.destroy', $cow->id) }}" method="post">
										<a class="btn btn-info btn-sm" href="{{ route('cows.show', $cow->id) }}">
											<span class="glyphicon glyphicon-file" aria-hidden="true"></span>
										</a>
	                    				<a class="btn btn-warning btn-sm" href="{{ route('cows.edit', $cow->id) }}">
	                    					<span class="glyphicon glyphicon-open" aria-hidden="true"></span>
	                    				</a>
										<input type="hidden" name="_method" value="delete">
                    					<input type="hidden" name="_token" value="{{ csrf_token() }}">
                    					<button type="submit" name="btnBorrar" class="btn btn-danger btn-sm" onclick="return confirm('El registro será eliminado');">
                    						<span class="glyphicon glyphicon-alert" aria-hidden="true"></span>
                    					</button>
									</form>
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