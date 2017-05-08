@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading">Filtros para vacas</div>
				@if($cows->count() > 0)
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
						@foreach($cows as $cow)
							<tr>
								<td>{{ $cow->cattle->tag }}</td>
								<td>{{ $cow->cattle->getBirthWithFormat() }}</td>
								<td>{{ $cow->cattle->getPurchaseDateWithFormat() }}</td>
								<td>{{ $cow->cattle->breed->name }}</td>
								<td>
									<form class="">
										<input type="hidden" name="_method" value="delete">
                    					<input type="hidden" name="_token" value="{{ csrf_token() }}">
                    					<a class="btn btn-info btn-xs" href="{{ route('cows.show', $cow->id) }}">Información</a>
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