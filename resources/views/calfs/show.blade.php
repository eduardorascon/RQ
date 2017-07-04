@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading">Becerro</div>
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
				<div class="panel-heading">Fotografias</div>
				<div class="panel-body">
					<form class="form-inline" action="{{ route('calf_save_picture', $calf->id) }}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-sm-10">
								<div class="form-group col-sm-5">
								<input type="file" name="picture">
								</div>

								<div class="form-group col-sm-5">
								<label class="col-sm-2" for="comment">Comentario</label>
								<input type="text" class="form-control col-sm-offset-2 col-sm-2" name="comment" id="comment" placeholder="Comentario">
								</div>
							</div>
							<div class="col-sm-2">
								<button type="submit" class="btn btn-default">Guardar</button>
							</div>
						</div>
					</form>
				</div>
				<div class="panel-body">
					@if($pictures->count() > 0)
					<div class="row">
						@foreach($pictures as $pic)
						<a href="{{ URL::asset('/images/') . '/' . $pic->filename }}" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-2" data-title="{{ $calf->cattle->tag }}" data-footer="{{ $pic->comment }}">
			                <img src="{{ URL::asset('/images/') . '/' .$pic->filename }}" class="img-responsive img-thumbnail" >
			            </a>
			            @endforeach
					</div>
					@endif
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">Registro de peso</div>
				<div class="panel-body">
					<form class="form-inline" action="{{ route('calf_log_weight', $calf->id) }}" method="post">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-sm-10">
								<div class="form-group col-sm-5">
								<label class="col-sm-2" for="weight">Peso</label>
								<input type="number" step="any" class="form-control col-sm-offset-2 col-sm-2" name="weight" id="weight" placeholder="Peso">
								</div>

								<div class="form-group col-sm-5">
								<label class="col-sm-2" for="date">Fecha</label>
								<input type="text" class="form-control col-sm-offset-2 col-sm-2 input-date" name="date" id="date" placeholder="dd/mm/aaaa">
								</div>

								<div class="form-group col-sm-5">
								<label class="col-sm-2" for="comment">Comentario</label>
								<input type="text" class="form-control col-sm-offset-2 col-sm-2" name="comment" id="comment" placeholder="Comentario">
								</div>
							</div>
							<div class="col-sm-2">
								<button type="submit" class="btn btn-default">Guardar</button>
							</div>
						</div>
					</form>
				</div>
				@if($weight_logs->count() > 0)
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped">
						<thead>
							<tr>
								<th>Peso</th>
								<th>Fecha de pesaje</th>
								<th>Comentario</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						@foreach($weight_logs as $log)
							<tr>
								<td>{{ $log->weight }}</td>
								<td>{{ $log->getDateAttributeWithFormat() }}</td>
								<td>{{ $log->comment }}</td>
								<td></td>
							</tr>
						@endforeach
						</tbody>
						</table>
					</div>
				</div>
				@endif
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">Registro de vacunación</div>
				<div class="panel-body">
					<form class="form-inline" action="{{ route('calf_log_vaccine', $calf->id) }}" method="post">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-sm-10">
								<div class="form-group col-sm-5">
								<label class="col-sm-2" for="vaccine">Vacuna</label>
								<select class="form-control col-sm-offset-2 col-sm-2" name="vaccine">
								@foreach ($vaccine_list as $v)
								{
								<option value="{{ $v->id }}">{{ $v->name }}</option>
								}
								@endforeach
								</select>
								</div>

								<div class="form-group col-sm-5">
								<label class="col-sm-2" for="date">Fecha</label>
								<input type="text" class="form-control col-sm-offset-2 col-sm-2 input-date" name="date" id="date" placeholder="dd/mm/aaaa">
								</div>

								<div class="form-group col-sm-5">
								<label class="col-sm-2" for="comment">Comentario</label>
								<input type="text" class="form-control col-sm-offset-2 col-sm-2" name="comment" id="comment" placeholder="Comentario">
								</div>
							</div>
							<div class="col-sm-2">
								<button type="submit" class="btn btn-default">Guardar</button>
							</div>
						</div>
					</form>
				</div>
				@if($vaccine_logs->count() > 0)
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped">
						<thead>
							<tr>
								<th>Vacuna</th>
								<th>Fecha de vacunación</th>
								<th>Comentario</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						@foreach($vaccine_logs as $log)
							<tr>
								<td>{{ $log->vaccine->name }}</td>
								<td>{{ $log->date }}</td>
								<td>{{ $log->comment }}</td>
								<td></td>
							</tr>
						@endforeach
						</tbody>
						</table>
					</div>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection