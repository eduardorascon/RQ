@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading">Registro de venta</div>
				<div class="panel-body">
				<form class="form-horizontal" action="{{ route('calves_sales.store', $calf->id) }}" method="post">
					{{ csrf_field() }}

					<div class="form-group">
					<label class="col-sm-2 control-label" for="calf_tag">Arete Siniga</label>
					<div class="col-sm-10">
						<input type="text" name="calf_tag" class="form-control" readonly="readonly" value="{{ $calf->cattle->tag }}">
					</div>
					</div>

					<div class="form-group">
					<label class="col-sm-2 control-label" for="calf_tag">Raza</label>
					<div class="col-sm-10">
						<input type="text" name="calf_breed" class="form-control" readonly="readonly" value="{{ $calf->cattle->breed->name }}">
					</div>
					</div>

					<div class="form-group">
					<label class="col-sm-2 control-label" for="sale_date">Fecha</label>
					<div class="col-sm-10">
						<input type="date" name="sale_date" class="form-control" placeholder="Fecha...">
					</div>
					</div>

					<div class="form-group">
					<label class="col-sm-2 control-label" for="sale_weight">Peso</label>
					<div class="col-sm-10">
						<input type="number" step="any" name="sale_weight" class="form-control" placeholder="Peso...">
					</div>
					</div>

					<div class="form-group">
					<label class="col-sm-2 control-label" for="price_per_kilo">Precio por kilo</label>
					<div class="col-sm-10">
						<div class="input-group">
						<div class="input-group-addon">$</div>
						<input type="number" step="any" name="price_per_kilo" class="form-control" placeholder="Precio por kilo...">
						</div>
					</div>
					</div>

					<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<input type="submit" class="btn btn-primary" value="Guardar">
					</div>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection