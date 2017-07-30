@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Venta</div>
				<div class="panel-body">
					<div class="form-horizontal">

						<div class="form-group">
						<label class="col-sm-3 control-label" for="client">Cliente</label>
						<div class="col-sm-9">
							<input type="text" name="client" class="form-control" readonly="readonly" value="{{ $client }}" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cow_tag">Arete Siniga</label>
						<div class="col-sm-9">
							<input type="text" name="cow_tag" class="form-control" readonly="readonly" value="{{ $cow->cattle->tag }}">
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cow_tag">Raza</label>
						<div class="col-sm-9">
							<input type="text" name="cow_breed" class="form-control" readonly="readonly" value="{{ $cow->cattle->breed->name }}">
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="sale_date">Fecha</label>
						<div class="col-sm-9">
							<input type="text" name="sale_date" class="form-control" readonly="readonly" value="{{ $cow->sale->getSaleDateWithFormat()  }}">
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="sale_weight">Peso</label>
						<div class="col-sm-9">
							<div class="input-group">
							<input type="text" name="sale_weight" class="form-control" readonly="readonly" value="{{ $cow->sale->sale_weight }}">
							<div class="input-group-addon">kgs</div>
							</div>
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="price_per_kilo">Precio por kilo</label>
						<div class="col-sm-9">
							<div class="input-group">
							<div class="input-group-addon">$</div>
							<input type="text" name="price_per_kilo" class="form-control" readonly="readonly" value="{{ $cow->sale->price_per_kilo }}">
							</div>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection