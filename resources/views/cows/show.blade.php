@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>VACA, Arete {{ $cow->cattle->tag }}</strong>
				</div>
				<div class="panel-body">
					<div class="form-horizontal">
						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_tag">Arete Siniga</label>
						<div class="col-sm-9">
							<input type="text" name="cattle_tag" class="form-control" readonly="readonly" value="{{ $cow->cattle->tag }}" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_birth_date">Fecha de nacimiento</label>
						<div class="col-sm-9">
							<input type="text" name="cattle_birth_date" class="form-control" readonly="readonly" value="{{ $cow->cattle->getBirthWithFormat() }}" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_purchase_date">Fecha de compra</label>
						<div class="col-sm-9">
							<input type="text" name="cattle_purchase_date" class="form-control" readonly="readonly" value="{{ $cow->cattle->getPurchaseDateWithFormat() }}" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cow_sale_date">Fecha de venta</label>
						<div class="col-sm-9">
							@if(count($cow->sale) > 0)
							<input type="text" name="cow_sale_date" class="form-control" readonly="readonly" value="{{ $cow->sale->getSaleDateWithFormat() }}" />
							@else
							<input type="text" name="cow_sale_date" class="form-control" readonly="readonly" value="" />
							@endif
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_breed">Raza</label>
						<div class="col-sm-9">
							<input type="text" name="cattle_breed" class="form-control" readonly="readonly" value="{{ $breed }}" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_owner">Dueño</label>
						<div class="col-sm-9">
							<input type="text" name="cattle_owner" class="form-control" readonly="readonly" value="{{ $owner }}" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_paddock">Potrero</label>
						<div class="col-sm-9">
							<input type="text" name="cattle_paddock" class="form-control" readonly="readonly" value="{{ $paddock }}" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cow_fertility">¿Es fertil?</label>
						<div class="col-sm-9">
							<input type="text" name="cow_fertility" class="form-control" readonly="readonly" value="{{ $cow->is_fertile }}" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cow_pregnancy_status">Estatus de gestación</label>
						<div class="col-sm-9">
							<input type="text" name="cow_pregnancy_status" class="form-control" readonly="readonly" value="{{ $cow->pregnancy_status }}" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_is_alive">¿Esta viva?</label>
						<div class="col-sm-9">
							<input type="text" name="cattle_is_alive" class="form-control" readonly="readonly" value="{{ $cow->cattle->is_alive }}">
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cow_number_of_calves">Numero de becerros</label>
						<div class="col-sm-9">
							<input type="number" name="cow_number_of_calves" class="form-control" readonly="readonly" placeholder="Numero de becerros" value="{{ $cow->number_of_calves}}">
						</div>
						</div>
					</div>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Fotográfias</strong>
				</div>
				@if (count($errors->save_picture_errors) > 0)
					<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <ul>
                            @foreach ($errors->save_picture_errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
				@endif
				<div class="panel-body">
					<form class="form-horizontal" action="{{ route('cow_save_picture', $cow->id) }}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-sm-5">
								<div class="form-group">
								<label class="col-sm-3 control-label" for="picture">Fotografia</label>
								<div class="col-sm-9">
									<input type="file" name="picture">
								</div>
								</div>

								<div class="form-group">
								<label class="col-sm-3 control-label" for="comment">Comentario</label>
								<div class="col-sm-9">
									<textarea class="form-control" name="comment" id="comment" placeholder="Comentario"></textarea>
								</div>
								</div>

								<div class="form-group">
								<div class="col-sm-12">
									<button type="submit" class="btn btn-success btn-sm pull-right">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>  Guardar fotografia
									</button>
								</div>
								</div>
							</div>
							<div class="col-sm-7">
								@if($pictures->count() > 0)
								<div class="row">
									@foreach($pictures as $pic)
									<a href="{{ URL::asset('/images/') . '/' . $pic->filename }}" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-3" data-title="{{ $cow->cattle->tag }}" data-footer="{{ $pic->comment }}">
						                <img src="{{ URL::asset('/images/') . '/' .$pic->filename }}" class="img-responsive img-thumbnail" >
						            </a>
						            @endforeach
								</div>
								@else
									<div class="alert alert-warning text-center">
									No hay fotografias para mostrar.
				                    </div>
								@endif
							</div>
						</div>
					</form>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Crías ({{ count($offspring) }}), </strong>
					<a href="{{ route('calf_create_offspring', $cow->id) }}">Agregar nueva cría</a>
				</div>
				@if($offspring->count() > 0)
				<div class="panel-body">
					<div class="panel panel-default">
					<div class="table-responsive">
						<table class="table table-condensed table-hover">
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
						@foreach($offspring as $o)
							<tr>
								<td>{{ $o->cattle->tag }}</td>
								<td>{{ $o->cattle->breed->name }}</td>
								<td>{{ $o->cattle->getBirthWithFormat() }}</td>
								<td>{{ $o->cattle->getPurchaseDateWithFormat() }}</td>
								<td>
									@if(count($o->sale))
									{{ $o->sale->getSaleDateWithFormat() }}
									@endif
								</td>
								<td>
									<a class="btn btn-info btn-sm" data-container="body" data-toggle="tooltip" data-placement="top" title="Mostrar información del registro" href="{{ route('calfs.show', $o->id) }}">
										<span class="glyphicon glyphicon-file" aria-hidden="true"></span>
									</a>
								</td>
							</tr>
						@endforeach
						</tbody>
						</table>
					</div>
					</div>
				</div>
				@else
				<div class="panel-body">
					<div class="alert alert-warning text-center">
					No hay registros para mostrar.
                    </div>
                </div>
				@endif
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Peso</strong>
				</div>
				@if (count($errors->log_weight_errors) > 0)
				<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul>
                        @foreach ($errors->log_weight_errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
				@endif
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-5">
							<form class="form-horizontal" action="{{ route('cow_log_weight', $cow->id) }}" method="post">
								{{ csrf_field() }}
								<div class="form-group">
								<label class="col-sm-3 control-label" for="weight">Peso</label>
								<div class="col-sm-9">
									<div class="input-group">
									<input type="number" step="any" class="form-control" name="weight" id="weight" placeholder="Peso">
									<div class="input-group-addon">kgs</div>
									</div>
								</div>
								</div>

								<div class="form-group">
								<label class="col-sm-3 control-label" for="date">Fecha</label>
								<div class="col-sm-9">
									<input type="text" class="form-control input-date" name="date" id="date" placeholder="dd/mm/aaaa">
								</div>
								</div>

								<div class="form-group">
								<label class="col-sm-3 control-label" for="comment">Comentario</label>
								<div class="col-sm-9">
									<textarea class="form-control" name="comment" id="comment" placeholder="Comentario"></textarea>
								</div>
								</div>

								<div class="form-group">
								<div class="col-sm-12">
									<button type="submit" class="btn btn-success btn-sm pull-right">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>  Guardar peso
									</button>
								</div>
								</div>
							</form>
						</div>
						<div class="col-sm-7">
							@if($weight_logs->count() > 0)
							<div class="panel panel-default">
								<table class="table table-condensed table-hover">
								<thead>
									<tr>
										<th>Peso</th>
										<th>Fecha</th>
										<th>Comentario</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
								@foreach($weight_logs as $log)
									<tr>
										<td>{{ $log->weight }} kgs</td>
										<td>{{ $log->getDateAttributeWithFormat() }}</td>
										<td>{{ $log->comment }}</td>
										<td>
											<form class="form-horizontal" action="{{ route('cow_delete_weight', $cow->id) }}" method="post">
		                						<input type="hidden" name="_token" value="{{ csrf_token() }}">
		                						<input type="hidden" name="log_weight_id" value="{{ $log->id }}">
		                    					<button type="submit" name="btnBorrar" class="btn btn-danger btn-xs" data-container="body" data-toggle="tooltip" data-placement="top" title="Eliminar el registro" onclick="return confirm('El registro será eliminado');">
		                    						<span class="glyphicon glyphicon-alert" aria-hidden="true"></span>
		                    					</button>
											</form>
										</td>
									</tr>
								@endforeach
								</tbody>
								</table>
							</div>
							@else
							<div class="alert alert-warning text-center">
							No hay registros para mostrar.
		                    </div>
							@endif
						</div>
					</div>
				</div>
				@if($weight_logs->count() > 0)
				<div class="panel-body">
					<div id="pop_div"></div>
					<?= \Lava::render('LineChart', 'MyStocks', 'pop_div') ?>
				</div>
				@endif
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Vacunación</strong>
				</div>
				@if (count($errors->log_vaccine_errors) > 0)
					<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <ul>
                            @foreach ($errors->log_vaccine_errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
				@endif
				<div class="panel-body">
					<form class="form-horizontal" action="{{ route('cow_log_vaccine', $cow->id) }}" method="post">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-sm-5">
								<div class="form-group">
								<label class="col-sm-3 control-label" for="vaccine">Vacuna</label>
								<div class="col-sm-9">
									<select class="form-control" name="vaccine">
									@foreach ($vaccine_list as $v)
									{
										<option value="{{ $v->id }}">{{ $v->name }}</option>
									}
									@endforeach
									</select>
								</div>
								</div>

								<div class="form-group">
								<label class="col-sm-3 control-label" for="date">Fecha</label>
								<div class="col-sm-9">
									<input type="text" class="form-control input-date" name="date" id="date" placeholder="dd/mm/aaaa">
								</div>
								</div>

								<div class="form-group">
								<label class="col-sm-3 control-label" for="comment">Comentario</label>
								<div class="col-sm-9">
									<textarea class="form-control" name="comment" id="comment" placeholder="Comentario"></textarea>
								</div>
								</div>

								<div class="form-group">
								<div class="col-sm-12">
									<button type="submit" class="btn btn-success btn-sm pull-right">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>  Guardar vacuna
									</button>
								</div>
								</div>
							</div>
							<div class="col-sm-7">
								@if($vaccine_logs->count() > 0)
									<div class="panel panel-default">
										<table class="table table-condensed table-hover">
										<thead>
											<tr>
												<th>Vacuna</th>
												<th>Fecha</th>
												<th>Comentario</th>
											</tr>
										</thead>
										<tbody>
										@foreach($vaccine_logs as $log)
											<tr>
												<td>{{ $log->vaccine->name }}</td>
												<td>{{ $log->date }}</td>
												<td>{{ $log->comment }}</td>
											</tr>
										@endforeach
										</tbody>
										</table>
									</div>
								@else
									<div class="alert alert-warning text-center">
									No hay registros para mostrar.
				                    </div>
								@endif
							</div>
						</div>
					</form>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Palpaciones</strong>
				</div>
				@if (count($errors->log_palpation_errors) > 0)
					<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <ul>
                            @foreach ($errors->log_palpation_errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
				@endif
				<div class="panel-body">
					<form class="form-horizontal" action="{{ route('cow_log_palpation', $cow->id) }}" method="post">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-sm-5">
								<div class="form-group">
								<label class="col-sm-3 control-label" for="months">Meses</label>
								<div class="col-sm-9">
									<input type="number" step="any" class="form-control" name="months" id="months" placeholder="Meses">
								</div>
								</div>

								<div class="form-group">
								<label class="col-sm-3 control-label" for="date">Fecha</label>
								<div class="col-sm-9">
									<input type="text" class="form-control input-date" name="date" id="date" placeholder="dd/mm/aaaa">
								</div>
								</div>

								<div class="form-group">
								<label class="col-sm-3 control-label" for="comment">Comentario</label>
								<div class="col-sm-9">
									<textarea class="form-control" name="comment" id="comment" placeholder="Comentario"></textarea>
								</div>
								</div>

								<div class="form-group">
								<div class="col-sm-12">
									<button type="submit" class="btn btn-success btn-sm pull-right"> 
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>  Guardar palpación
									</button>
								</div>
								</div>
							</div>
							<div class="col-sm-7">
								@if($palpations->count() > 0)
									<div class="panel-body">
										<div class="table-responsive">
											<table class="table table-condensed table-hover">
											<thead>
												<tr>
													<th>Meses</th>
													<th>Fecha de palpación</th>
													<th>Comentarios</th>
												</tr>
											</thead>
											<tbody>
											@foreach($palpations as $p)
												<tr>
													<td>{{ $p->months }}</td>
													<td>{{ $p->date }}</td>
													<td>{{ $p->comment }}</td>
												</tr>
											@endforeach
											</tbody>
											</table>
										</div>
									</div>
								@else
									<div class="alert alert-warning text-center">
									No hay registros para mostrar.
				                    </div>
								@endif
							</div>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
</div>
@endsection