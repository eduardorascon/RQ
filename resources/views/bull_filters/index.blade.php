@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading">Filtros para toros</div>
				<div class="panel-body">
					<form class="form-horizontal" action="{{ route('bull_filters.index') }}" method="get">

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_tag">Arete Siniga</label>
						<div class="col-sm-9">
							<input type="text" name="cattle_tag" class="form-control" placeholder="Etiqueta" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_birth_since">Fecha de nacimiento (desde)</label>
						<div class="col-sm-9">
							<input type="text" name="cattle_birth_since" class="form-control input-date" placeholder="dd/mm/aaaa" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_birth_until">Fecha de nacimiento (hasta)</label>
						<div class="col-sm-9">
							<input type="text" name="cattle_birth_until" class="form-control input-date" placeholder="dd/mm/aaaa" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_purchase_date_since">Fecha de compra (desde)</label>
						<div class="col-sm-9">
							<input type="text" name="cattle_purchase_date_since" class="form-control input-date" placeholder="dd/mm/aaaa" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_purchase_date_until">Fecha de compra (hasta)</label>
						<div class="col-sm-9">
							<input type="text" name="cattle_purchase_date_until" class="form-control input-date" placeholder="dd/mm/aaaa" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_breed">Raza</label>
						<div class="col-sm-9">
							<select class="form-control" name="cattle_breed">
								<option value="">Todas las opciones</option>
								@foreach ($breed_list as $b)
								{
								<option value="{{ $b->id }}">{{ $b->name }}</option>
								}
								@endforeach
							</select>
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_owner">Dueño</label>
						<div class="col-sm-9">
							<select class="form-control" name="cattle_owner">
								<option value="">Todas las opciones</option>
								@foreach ($owner_list as $o)
								{
								<option value="{{ $o->id }}">{{ $o->name }}</option>
								}
								@endforeach
							</select>
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_paddock">Potrero</label>
						<div class="col-sm-9">
							<select class="form-control" name="cattle_paddock">
								<option value="">Todas las opciones</option>
								@foreach ($paddock_list as $p)
								{
								<option value="{{ $p->id }}">{{ $p->name }}</option>
								}
								@endforeach
							</select>
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_is_alive">¿Esta vivo?</label>
						<div class="col-sm-9">
							<select class="form-control" name="cattle_is_alive">
								<option value="">Todas las opciones</option>
								<option value="Si">Si</option>
								<option value="No">No</option>
							</select>
						</div>
						</div>

						<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<input type="submit" class="btn btn-primary" value="Buscar">
						</div>
						</div>
					</form>
				</div>
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