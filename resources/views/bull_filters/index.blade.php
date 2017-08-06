@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>TOROS, filtros</strong>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" action="{{ route('bull_filters.index') }}" method="get">

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
							<label class="control-label col-sm-3" for="bull_sale_date_since">Fecha de venta (desde)</label>
							<div class="col-sm-4">
								<input type="text" name="bull_sale_date_since" class="form-control input-date" placeholder="dd/mm/aaaa" />
							</div>

							<label class="control-label col-sm-1" for="bull_sale_date_until">(hasta)</label>
							<div class="col-sm-4">
								<input type="text" name="bull_sale_date_until" class="form-control input-date" placeholder="dd/mm/aaaa" />
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="bull_weight_from">Peso (desde)</label>
							<div class="col-sm-4">
								<input type="number" name="bull_weight_from" class="form-control" placeholder="0" />
							</div>

							<label class="control-label col-sm-1" for="bull_weight_to">(hasta)</label>
							<div class="col-sm-4">
								<input type="number" name="bull_weight_to" class="form-control" placeholder="0" />
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

							<label class="control-label col-sm-3" for="bull_currently_sold">¿Fue vendido?</label>
							<div class="col-sm-3">
								<select class="form-control" name="bull_currently_sold">
									<option value="">Todas las opciones</option>
									<option value="Si">Si</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>

						<div class="form-group">
						<label class="control-label col-sm-3" for="bull_age_in_months">Edad en meses</label>
						<div class="col-sm-4">
							<input type="number" name="bull_age_in_months" class="form-control" placeholder="0" value="" />
						</div>
						</div>

						<div class="form-group">
						<div class="col-sm-offset-3 col-sm-3">
							<button type="submit" class="btn btn-info">
								<span class="glyphicon glyphicon-search"></span> Buscar
							</button>
						</div>
						@if($bulls->count() > 0)
						<div class="col-sm-offset-3 col-sm-3">
							<a class="btn btn-success pull-right" href="{{ route('bull_filters.export', $qs) }}">
            					<span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Descargar {{ $bulls->total() }} registro(s)
            				</a>
						</div>
						@endif
						</div>
					</form>
				</div>
				@if($bulls->count() > 0)
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
						@foreach($bulls as $bull)
							<tr>
								<td>{{ $bull->tag }}</td>
								<td>{{ $bull->breed_name }}</td>
								<td>{{ $bull->getBirthWithFormat() }}</td>
								<td>{{ $bull->getPurchaseDateWithFormat() }}</td>
								<td>{{ $bull->getSaleDateWithFormat() }}</td>
								<td>{{ $bull->current_weight }} kgs</td>
								<td>{{ $bull->age_in_months }}</td>
								<td>
                    				<a class="btn btn-info btn-sm" data-container="body" data-toggle="tooltip" data-placement="top" title="Mostrar información del registro" href="{{ route('bulls.show', $bull->id) }}">
                    					<span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                    				</a>
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