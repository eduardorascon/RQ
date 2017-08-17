@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>VACAS, filtros </strong>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" action="{{ route('cow_filters.index') }}" method="get">

						<div class="form-group">
							<label class="control-label col-sm-3" for="cattle_tag">Arete Siniga</label>
							<div class="col-sm-3">
								<input type="text" name="cattle_tag" class="form-control" placeholder="Etiqueta">
							</div>

							<label class="control-label col-sm-2" for="cattle_breed">Raza</label>
							<div class="col-sm-3">
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
							<div class="col-sm-3">
								<input type="text" name="cattle_birth_since" class="form-control input-date" placeholder="dd/mm/aaaa" />
							</div>

							<label class="control-label col-sm-2" for="cattle_birth_until">(hasta)</label>
							<div class="col-sm-3">
								<input type="text" name="cattle_birth_until" class="form-control input-date" placeholder="dd/mm/aaaa" />
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="cattle_purchase_date_since">Fecha de compra (desde)</label>
							<div class="col-sm-3">
								<input type="text" name="cattle_purchase_date_since" class="form-control input-date" placeholder="dd/mm/aaaa" />
							</div>

							<label class="control-label col-sm-2" for="cattle_purchase_date_until">(hasta)</label>
							<div class="col-sm-3">
								<input type="text" name="cattle_purchase_date_until" class="form-control input-date" placeholder="dd/mm/aaaa" />
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="cow_sale_date_since">Fecha de venta (desde)</label>
							<div class="col-sm-3">
								<input type="text" name="cow_sale_date_since" class="form-control input-date" placeholder="dd/mm/aaaa" />
							</div>

							<label class="control-label col-sm-2" for="cow_sale_date_until">(hasta)</label>
							<div class="col-sm-3">
								<input type="text" name="cow_sale_date_until" class="form-control input-date" placeholder="dd/mm/aaaa" />
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="cow_weight_from">Peso (desde)</label>
							<div class="col-sm-3">
								<input type="number" name="cow_weight_from" class="form-control" placeholder="0" />
							</div>

							<label class="control-label col-sm-2" for="cow_weight_to">(hasta)</label>
							<div class="col-sm-3">
								<input type="number" name="cow_weight_to" class="form-control" placeholder="0" />
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="cattle_owner">Dueño</label>
							<div class="col-sm-3">
								<select class="form-control" name="cattle_owner">
									<option value="">Todas las opciones</option>
									@foreach ($owner_list as $o)
									{
									<option value="{{ $o->id }}">{{ $o->name }}</option>
									}
									@endforeach
								</select>
							</div>

							<label class="control-label col-sm-2" for="cattle_paddock">Potrero</label>
							<div class="col-sm-3">
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
							<label class="control-label col-sm-3" for="cattle_is_alive">¿Esta viva?</label>
							<div class="col-sm-3">
								<select class="form-control" name="cattle_is_alive">
									<option value="">Todas las opciones</option>
									<option value="Si">Si</option>
									<option value="No">No</option>
								</select>
							</div>

							<label class="control-label col-sm-2" for="cow_currently_sold">¿Fue vendida?</label>
							<div class="col-sm-3">
								<select class="form-control" name="cow_currently_sold">
									<option value="">Todas las opciones</option>
									<option value="Si">Si</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="cow_fertility">Fertilidad</label>
							<div class="col-sm-3">
								<select class="form-control" name="cow_fertility">
									<option value="">Todas las opciones</option>
									<option value="Si">Si</option>
									<option value="No">No</option>
								</select>
							</div>

							<label class="control-label col-sm-2" for="cow_pregnancy_status">Estado de gestación</label>
							<div class="col-sm-3">
								<select class="form-control" name="cow_pregnancy_status">
									<option value="">Todas las opciones</option>
									<option value="Vacia">Vacia</option>
									<option value="Preñada">Preñada</option>
									<option value="Parida">Parida</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label" for="cow_number_of_calves">Número de becerros</label>
							<div class="col-sm-3">
								<input type="number" name="cow_number_of_calves" class="form-control" value="" placeholder="0">
							</div>

							<label class="col-sm-2 control-label" for="cow_age_in_months">Edad en meses</label>
							<div class="col-sm-3">
								<input type="number" name="cow_age_in_months" class="form-control" value="" placeholder="0" >
							</div>
						</div>

						<div class="form-group">
						<div class="col-sm-offset-3 col-sm-3">
							<button type="submit" class="btn btn-info">
								<span class="glyphicon glyphicon-search"></span> Buscar
							</button>
						</div>
						@if($cows->count() > 0)
						<div class="col-sm-offset-2 col-sm-3">
							<a class="btn btn-success pull-right" href="{{ route('cow_filters.export', $qs) }}">
            					<span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Descargar {{ $cows->total() }} registro(s)
            				</a>
						</div>
						@endif
						</div>
					</form>
				</div>
				@if($cows->count() > 0)
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-hover table-condensed">
						<thead>
							<tr>
								<th>@sortablelink('tag', 'Arete Siniga')</th>
								<th>@sortablelink('breed_name', 'Raza')</th>
								<th>@sortablelink('birth', 'Fecha de nacimiento')</th>
								<th>@sortablelink('purchase_date', 'Fecha de compra')</th>
								<th>@sortablelink('sale_date', 'Fecha de venta')</th>
								<th>@sortablelink('current_weight', 'Peso actual')</th>
								<th>@sortablelink('age_in_months', 'Meses de edad')</th>
								<th>@sortablelink('pregnancy_status', 'Estado')</th>
								<th>@sortablelink('months_since_last_birth', 'Meses sin parir')</th>
								<th class="col-sm-2">Acciones</th>
							</tr>
						</thead>
						<tbody>
						@foreach($cows as $cow)
							<tr>
								<td>{{ $cow->tag }}</td>
								<td>{{ $cow->breed_name }}</td>
								<td>{{ $cow->getBirthWithFormat() }}</td>
								<td>{{ $cow->getPurchaseDateWithFormat() }}</td>
								<td>{{ $cow->getSaleDateWithFormat() }}</td>
								<td>{{ $cow->current_weight }} kgs</td>
								<td>{{ $cow->age_in_months }}</td>
								<td>{{ $cow->pregnancy_status }}</td>
								<td>{{ $cow->months_since_last_birth }}</td>
								<td>
                    				<a class="btn btn-info btn-sm" data-container="body" data-toggle="tooltip" data-placement="top" title="Mostrar información del registro" href="{{ route('cows.show', $cow->id) }}">
                    					<span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                    				</a>
								</td>
							</tr>
						@endforeach
						</tbody>
						</table>
					</div>
					<div>{{ $cows->appends(\Request::except('page'))->render() }}</div>
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