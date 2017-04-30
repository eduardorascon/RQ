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
					<form class="form-horizontal" action="{{ route('cows.update', $cow->id) }}" method="post">
						<input type="hidden" name="_method" value="PATCH" />
						{{ csrf_field() }}

						<div class="form-group">
						<label class="col-sm-2 control-label" for="cattle_tag">Arete Siniga</label>
						<div class="col-sm-10">
							<input type="text" name="cattle_tag" class="form-control" placeholder="Etiqueta" value="{{ $cow->cattle->tag }}" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 control-label" for="cattle_birth_date">Fecha de nacimiento</label>
						<div class="col-sm-10">
							<input type="date" name="cattle_birth_date" class="form-control" placeholder="Fecha de nacimiento" value="{{ $cow->cattle->birth }}" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 control-label" for="cattle_purchase_date">Fecha de compra</label>
						<div class="col-sm-10">
							<input type="date" name="cattle_purchase_date" class="form-control" placeholder="Fecha de compra" value="{{ $cow->cattle->purchase_date }}" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 control-label" for="cattle_breed">Raza</label>
						<div class="col-sm-10">
							<select class="form-control" name="cattle_breed">
								@foreach ($breed_list as $b)
								{
									@if($cow->cattle->breed_id == $b->id)
									<option value="{{ $b->id }}" selected="selected">{{ $b->name }}</option>
									@else
									<option value="{{ $b->id }}">{{ $b->name }}</option>
									@endif
								}
								@endforeach
							</select>
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 control-label" for="cow_fertility">¿Es fertil?</label>
						<div class="col-sm-10">
							<select class="form-control" name="cow_fertility">
								@if($cow->is_fertile == 'Si')
									<option value="Si" selected="selected">Si</option>
									<option value="No">No</option>
								@else
									<option value="Si">Si</option>
									<option value="No" selected="selected">No</option>
								@endif
							</select>
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 control-label" for="cow_pregnancy_status">Estatus de gestación</label>
						<div class="col-sm-10">
							<select class="form-control" name="cow_pregnancy_status">
								@if($cow->pregnancy_status == 'Vacia')
									<option value="Vacia" selected="selected">Vacia</option>
									<option value="Preñada">Preñada</option>
									<option value="Parida">Parida</option>
								@elseif($cow->pregnancy_status = 'Preñada')
									<option value="Vacia">Vacia</option>
									<option value="Preñada" selected="selected">Preñada</option>
									<option value="Parida">Parida</option>
								@else
									<option value="Vacia">Vacia</option>
									<option value="Preñada">Preñada</option>
									<option value="Parida" selected="selected">Parida</option>
								@endif
							</select>
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 control-label" for="cow_last_pregnancy_check">Fecha de revision</label>
						<div class="col-sm-10">
							<input type="date" name="cow_last_pregnancy_check" class="form-control" value="{{ $cow->last_pregnancy_checked_date }}" />
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
						<label class="col-sm-2 control-label" for="cow_number_of_calves">Numero de becerros</label>
						<div class="col-sm-10">
							<input type="number" name="cow_number_of_calves" class="form-control" placeholder="Numero de becerros" value="0">
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