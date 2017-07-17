@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>BECERRO, Arete {{ $calf->cattle->tag }}</strong>
				</div>
				<div class="panel-body">
					<div class="form-horizontal">
						<div class="form-group">
						<label class="col-sm-3 control-label" for="mother_tag">Madre</label>
						<div class="col-sm-7">
							<input type="text" id="mother_tag" name="mother_tag" class="form-control" placeholder="Madre" readonly="readonly" value="{{ $calf->mother->cattle->tag }}" />
						</div>
						<div class="col-sm-2">
							<a class="btn btn-info" href="{{ route('cows.show', $calf->mother->id) }}">Información</a>
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_tag">Arete Siniga</label>
						<div class="col-sm-9">
							<input type="text" name="cattle_tag" class="form-control" readonly="readonly" value="{{ $calf->cattle->tag }}" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_birth_date">Fecha de nacimiento</label>
						<div class="col-sm-9">
							<input type="text" name="cattle_birth_date" class="form-control" readonly="readonly" value="{{ $calf->cattle->getBirthWithFormat() }}" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_purchase_date">Fecha de compra</label>
						<div class="col-sm-9">
							<input type="text" name="cattle_purchase_date" class="form-control" readonly="readonly" value="{{ $calf->cattle->getPurchaseDateWithFormat() }}" />
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
						<label class="col-sm-3 control-label" for="cattle_is_alive">¿Esta vivo?</label>
						<div class="col-sm-9">
							<input type="text" name="cattle_is_alive" class="form-control" readonly="readonly" value="{{ $calf->cattle->is_alive }}" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_gender">Sexo</label>
						<div class="col-sm-9">
							<input type="text" name="cattle_gender" class="form-control" readonly="readonly" value="{{ $calf->cattle->gender }}" />
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
					<form class="form-horizontal" action="{{ route('calf_save_picture', $calf->id) }}" method="post" enctype="multipart/form-data">
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
									<button type="submit" class="btn btn-primary pull-right">Guardar fotografia</button>
								</div>
								</div>
							</div>
							<div class="col-sm-7">
								@if($pictures->count() > 0)
								<div class="row">
									@foreach($pictures as $pic)
									<a href="{{ URL::asset('/images/') . '/' . $pic->filename }}" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-3" data-title="{{ $bull->cattle->tag }}" data-footer="{{ $pic->comment }}">
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
					<form class="form-horizontal" action="{{ route('calf_log_weight', $calf->id) }}" method="post">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-sm-5">
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
									<button type="submit" class="btn btn-primary pull-right">Guardar peso</button>
								</div>
								</div>
							</div>
							<div class="col-sm-7">
								@if($weight_logs->count() > 0)
									<div class="table-responsive">
										<table class="table table-condensed table-hover">
										<thead>
											<tr>
												<th>Peso</th>
												<th>Fecha</th>
												<th>Comentario</th>
											</tr>
										</thead>
										<tbody>
										@foreach($weight_logs as $log)
											<tr>
												<td>{{ $log->weight }}</td>
												<td>{{ $log->getDateAttributeWithFormat() }}</td>
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
					<form class="form-horizontal" action="{{ route('calf_log_vaccine', $calf->id) }}" method="post">
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
									<input type="text" class="form-control" name="comment" id="comment" placeholder="Comentario">
								</div>
								</div>

								<div class="form-group">
								<div class="col-sm-12">
									<button type="submit" class="btn btn-primary pull-right">Guardar vacuna</button>
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
		</div>
	</div>
</div>
@endsection