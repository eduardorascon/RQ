@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					Toro
				</div>
				<div class="panel-body">
					<form class="form-horizontal" action="{{ route('bulls.update', $bull->id) }}" method="post">
						<input type="hidden" name="_method" value="PATCH" />
						{{ csrf_field() }}

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
					</form>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					Registro de peso
				</div>
				<div class="panel-body">
					<form class="form-inline" action="{{ route('log_weight', $bull->id) }}" method="post">
						{{ csrf_field() }}
						<div class="form-group">
						<label for="weight">Peso</label>
						<input type="text" class="form-control" name="weight" id="weight" placeholder="Peso">
						</div>
						<button type="submit" class="btn btn-default">Guardar</button>
					</form>
				</div>
				<div class="panel-body">
				</div>
			</div>
		</div>
	</div>
</div>
@endsection