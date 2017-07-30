@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>BECERROS, filtros</strong>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" action="{{ route('calf_filters.index') }}" method="get">

						<div class="form-group">
						<label class="control-label col-sm-3" for="cow_id">Madre</label>
						<div class="col-sm-4">
							<select class="form-control" name="cow_id">
								<option value="">Todas las opciones</option>
								@foreach ($cow_list as $cow)
								{
								<option value="{{ $cow->cow_id }}">{{ $cow->tag }}</option>
								}
								@endforeach
							</select>
						</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="cattle_tag">Arete Siniga</label>
							<div class="col-sm-4">
								<input type="text" name="cattle_tag" class="form-control" placeholder="Etiqueta" />
							</div>

							<label class="control-label col-sm-1" for="cattle_breed">Raza</label>
							<div class="col-sm-4">
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
							<label class="control-label col-sm-3" for="cattle_birth_since">Fecha de nacimiento (desde)</label>
							<div class="col-sm-4">
								<input type="text" name="cattle_birth_since" class="form-control input-date" placeholder="dd/mm/aaaa" />
							</div>

							<label class="control-label col-sm-1" for="cattle_birth_until">(hasta)</label>
							<div class="col-sm-4">
								<input type="text" name="cattle_birth_until" class="form-control input-date" placeholder="dd/mm/aaaa" />
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="cattle_purchase_date_since">Fecha de compra (desde)</label>
							<div class="col-sm-4">
								<input type="text" name="cattle_purchase_date_since" class="form-control input-date" placeholder="dd/mm/aaaa" />
							</div>

							<label class="control-label col-sm-1" for="cattle_purchase_date_until">(hasta)</label>
							<div class="col-sm-4">
								<input type="text" name="cattle_purchase_date_until" class="form-control input-date" placeholder="dd/mm/aaaa" />
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="calf_sale_date_since">Fecha de venta (desde)</label>
							<div class="col-sm-4">
								<input type="text" name="calf_sale_date_since" class="form-control input-date" placeholder="dd/mm/aaaa" />
							</div>

							<label class="control-label col-sm-1" for="calf_sale_date_until">(hasta)</label>
							<div class="col-sm-4">
								<input type="text" name="calf_sale_date_until" class="form-control input-date" placeholder="dd/mm/aaaa" />
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="cattle_owner">Dueño</label>
							<div class="col-sm-4">
								<select class="form-control" name="cattle_owner">
									<option value="">Todas las opciones</option>
									@foreach ($owner_list as $o)
									{
									<option value="{{ $o->id }}">{{ $o->name }}</option>
									}
									@endforeach
								</select>
							</div>

							<label class="control-label col-sm-1" for="cattle_paddock">Potrero</label>
							<div class="col-sm-4">
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
							<label class="control-label col-sm-3" for="cattle_is_alive">¿Esta vivo?</label>
							<div class="col-sm-3">
								<select class="form-control" name="cattle_is_alive">
									<option value="">Todas las opciones</option>
									<option value="Si">Si</option>
									<option value="No">No</option>
								</select>
							</div>

							<label class="control-label col-sm-3" for="calf_currently_sold">¿Fue vendido?</label>
							<div class="col-sm-3">
								<select class="form-control" name="calf_currently_sold">
									<option value="">Todas las opciones</option>
									<option value="Si">Si</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label" for="calf_age_in_months">Edad en meses</label>
							<div class="col-sm-3">
								<input type="number" name="calf_age_in_months" class="form-control" value="" placeholder="0" />
							</div>
						</div>

						<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<button type="submit" class="btn btn-info">
								<span class="glyphicon glyphicon-search"></span> Buscar
							</button>
						</div>
						</div>
					</form>
				</div>
				@if($calves->count() > 0)
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
								<th>Peso actual</th>
								<th>Meses de edad</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
						@foreach($calves as $calf)
							<tr>
								<td>{{ $calf->tag }}</td>
								<td>{{ $calf->breed_name }}</td>
								<td>{{ $calf->getBirthWithFormat() }}</td>
								<td>{{ $calf->getPurchaseDateWithFormat() }}</td>
								<td>{{ $calf->getSaleDateWithFormat() }}</td>
								<td>{{ $calf->current_weight }} kgs</td>
								<td>{{ $calf->age_in_months }}</td>
								<td>
                    				<a class="btn btn-info btn-sm" data-container="body" data-toggle="tooltip" data-placement="top" title="Mostrar información del registro" href="{{ route('calfs.show', $calf->id) }}">
                    					<span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                    				</a>
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