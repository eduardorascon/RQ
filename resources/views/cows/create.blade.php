@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading">Captura de vacas</div>
				@if (count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
				<div class="panel-body">
					<form class="form-horizontal" action="{{ route('cows.store') }}" method="post">
						{{ csrf_field() }}

						<div class="form-group">
						<label class="col-sm-2 control-label" for="cattle_tag">Arete Siniga</label>
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
						<label class="col-sm-2 control-label">¿Es fertil?</label>
						<div class="col-sm-10">
							<select class="form-control" name="cow_fertility">
								<option value="">Eligir fertilidad</option>
								<option value="Si">Si</option>
								<option value="No">No</option>
							</select>
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 control-label" for="cow_pregnancy_status">Estatus de gestación</label>
						<div class="col-sm-10">
							<select class="form-control" name="cow_pregnancy_status">
								<option value="">Elegir el estatus de gestación</option>
								<option value="Vacia">Vacia</option>
								<option value="Preñada">Preñada</option>
								<option value="Parida">Parida</option>
							</select>
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 control-label" for="cattle_is_alive">¿Esta viva?</label>
						<div class="col-sm-10">
							<select class="form-control" name="cattle_is_alive">
								<option value="">Elige la opcion.</option>
								<option value="Si">Si</option>
								<option value="No">No</option>
							</select>
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 control-label" for="cow_number_of_calves">Arete Siniga</label>
						<div class="col-sm-10">
							<input type="number" name="cow_number_of_calves" class="form-control" placeholder="Numero de becerros">
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