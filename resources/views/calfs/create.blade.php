@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading">
					Captura de becerros
				</div>
				<div class="panel-body">
					<form class="form-horizontal" action="{{ route('calfs.store') }}" method="post">
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
							<input type="date" name="cattle_birth_date" class="form-control" placeholder="Fecha de nacimiento">
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 control-label" for="cattle_purchase_date">Fecha de compra</label>
						<div class="col-sm-10">
							<input type="date" name="cattle_purchase_date" class="form-control" placeholder="Fecha de compra">
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 control-label" for="cattle_breed">Raza</label>
						<div class="col-sm-10">
							<select class="form-control" name="cattle_breed">
								@foreach ($breed_list as $b)
								{
								<option value="{{ $b->id }}">{{ $b->name }}</option>
								}
								@endforeach
							</select>
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