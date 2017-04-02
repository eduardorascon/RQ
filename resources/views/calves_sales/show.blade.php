@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading">Venta</div>
				<div class="panel-body">
					<div class="form-horizontal">
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
							<input type="text" name="sale_date" class="form-control" readonly="readonly" value="{{ $calf->sale->sale_date  }}">
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 control-label" for="sale_weight">Peso</label>
						<div class="col-sm-10">
							<input type="text" name="sale_weight" class="form-control" readonly="readonly" value="{{ $calf->sale->sale_weight }}">
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 control-label" for="price_per_kilo">Precio por kilo</label>
						<div class="col-sm-10">
							<div class="input-group">
							<div class="input-group-addon">$</div>
							<input type="text" name="price_per_kilo" class="form-control" readonly="readonly" value="{{ $calf->sale->price_per_kilo }}">
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