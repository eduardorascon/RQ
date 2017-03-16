@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading">Toro</div>
				<div class="panel-body">
					<div class="form-horizontal">

						<div class="form-group">
						<label class="col-sm-2 control-label" for="cattle_tag">Etiqueta</label>
						<div class="col-sm-10">
							<input type="text" name="cattle_tag" class="form-control" readonly="readonly" value="{{ $bull->cattle->tag }}" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 control-label" for="cattle_birth_date">Fecha de nacimiento</label>
						<div class="col-sm-10">
							<input type="date" name="cattle_birth_date" class="form-control" readonly="readonly" value="{{ $bull->cattle->birth }}" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 control-label" for="cattle_purchase_date">Fecha de compra</label>
						<div class="col-sm-10">
							<input type="date" name="cattle_purchase_date" class="form-control" readonly="readonly" value="{{ $bull->cattle->purchase_date }}" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 control-label" for="cattle_breed">Raza</label>
						<div class="col-sm-10">
							<input type="text" name="cattle_breed" class="form-control" readonly="readonly" value="{{ $breed }}" />
						</div>
						</div>
					</div>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">Registro de peso</div>
				<div class="panel-body">
					<form class="form-inline" action="{{ route('log_weight', $bull->id) }}" method="post">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-sm-10">
								<div class="form-group col-sm-5">
								<label class="col-sm-2" for="weight">Peso</label>
								<input type="number" step="any" class="form-control col-sm-offset-2 col-sm-2" name="weight" id="weight" placeholder="Peso">
								</div>

								<div class="form-group col-sm-5">
								<label class="col-sm-2" for="date">Fecha</label>
								<input type="date" class="form-control col-sm-offset-2 col-sm-2" name="date" id="date" placeholder="Fecha">
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
					<div class="table-responsive">
						<table class="table table-striped table-condensed">
						<thead>
							<tr>
								<th>Peso</th>
								<th>Fecha de pesaje</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						@foreach($weight_logs as $log)
							<tr>
								<td>{{ $log->weight }}</td>
								<td>{{ $log->weight_date }}</td>
								<td></td>
							</tr>
						@endforeach
						</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection