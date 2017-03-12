@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					Captura de toros
				</div>
				<div class="panel-body">
					<form class="form-horizontal" action="#" method="post">
						{{ csrf_field() }}

						<div class="form-group">
						<label class="col-sm-2 control-label" for="cattle_tag">Etiqueta</label>
						<div class="col-sm-10">
							<input type="text" name="cattle_tag" class="form-control" placeholder="Etiqueta">							
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 control-label" for="cattle_birth_date">Fecha de nacimiento</label>
						<div class="col-sm-10">
							<input type="text" name="cattle_birth_date" class="form-control" placeholder="Fecha de nacimiento">
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 control-label" for="cattle_purchase_date">Fecha de compra</label>
						<div class="col-sm-10">
							<input type="text" name="cattle_purchase_date" class="form-control" placeholder="Fecha de compra">							
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 control-label" for="cattla_breed">Raza</label>
						<div class="col-sm-10">
							<input type="text" name="cattla_breed" class="form-control" placeholder="Raza">							
						</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection