@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading">Filtros para becerros</div>
				<div class="panel-body">
					<form class="form-horizontal" action="{{ route('calf_filters.index') }}" method="get">

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cow_id">Madre</label>
						<div class="col-sm-9">
							<select class="form-control" name="cow_id">
								<option value="">Todas las opciones</option>
								@foreach ($cow_list as $cow)
								{
								<option value="{{ $cow->id }}">{{ $cow->cattle->tag }}</option>
								}
								@endforeach
							</select>
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_tag">Arete Siniga</label>
						<div class="col-sm-9">
							<input type="text" name="cattle_tag" class="form-control" placeholder="Etiqueta" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_birth_since">Fecha de nacimiento (desde)</label>
						<div class="col-sm-9">
							<input type="date" name="cattle_birth_since" class="form-control" value="{{ $birth_since }}" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_birth_until">Fecha de nacimiento (hasta)</label>
						<div class="col-sm-9">
							<input type="date" name="cattle_birth_until" class="form-control" value="{{ $birth_until }}" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_purchase_date_since">Fecha de compra (desde)</label>
						<div class="col-sm-9">
							<input type="date" name="cattle_purchase_date_since" class="form-control" value="{{ $purchase_since }}" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_purchase_date_until">Fecha de compra (hasta)</label>
						<div class="col-sm-9">
							<input type="date" name="cattle_purchase_date_until" class="form-control" value="{{ $purchase_until }}" />
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
				@if($calves->count() > 0)
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
						@foreach($calves as $calf)
							<tr>
								<td>{{ $calf->cattle->tag }}</td>
								<td>{{ $calf->cattle->getBirthWithFormat() }}</td>
								<td>{{ $calf->cattle->getPurchaseDateWithFormat() }}</td>
								<td>{{ $calf->cattle->breed->name }}</td>
								<td>
                    				<a class="btn btn-info btn-xs" href="{{ route('calfs.show', $calf->id) }}">Información</a>
								</td>
							</tr>
						@endforeach
						</tbody>
						</table>
					</div>
					<div>{{ $calves->links() }}</div>
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