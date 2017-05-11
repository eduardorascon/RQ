@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading">Filtros para toros</div>
				@if($bulls->count() > 0)
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped">
						<thead>
							<tr>
								<th>Arete Siniga</th>
								<th>Fecha de nacimiento</th>
								<th>Fecha de compra</th>
								<th>Raza</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						@foreach($bulls as $bull)
							<tr>
								<td>{{ $bull->cattle->tag }}</td>
								<td>{{ $bull->cattle->getBirthWithFormat() }}</td>
								<td>{{ $bull->cattle->getPurchaseDateWithFormat() }}</td>
								<td>{{ $bull->cattle->breed->name }}</td>
								<td>
                    				<a class="btn btn-info btn-xs" href="{{ route('bulls.show', $bull->id) }}">Información</a>
								</td>
							</tr>
						@endforeach
						</tbody>
						</table>
					</div>
					<div>{{ $bulls->links() }}</div>
				</div>
				@else
				<div class="panel-body">
					<div class="alert alert-danger">Sin resultados</div>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection