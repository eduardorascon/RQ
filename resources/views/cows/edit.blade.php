@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>VACAS, Cambios en registro</strong>
				</div>
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
						<label class="col-sm-3 control-label" for="cattle_tag">Arete Siniga</label>
						<div class="col-sm-9">
							<input type="text" name="cattle_tag" class="form-control" placeholder="Etiqueta" value="{{ $cow->cattle->tag }}" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_birth_date">Fecha de nacimiento</label>
						<div class="col-sm-9">
							<input type="text" name="cattle_birth_date" class="form-control input-date" placeholder="dd/mm/aaaa" value="{{ $cow->cattle->getBirthWithFormat2() }}" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_purchase_date">Fecha de compra</label>
						<div class="col-sm-9">
							<input type="text" name="cattle_purchase_date" class="form-control input-date" placeholder="dd/mm/aaaa" value="{{ $cow->cattle->getPurchaseDateWithFormat2() }}" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_breed">Raza</label>
						<div class="col-sm-9">
							<select class="form-control" name="cattle_breed">
								<option value="">Elige una opción.</option>
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
						<label class="col-sm-3 control-label" for="cattle_owner">Dueño</label>
						<div class="col-sm-9">
							<select class="form-control" name="cattle_owner">
								<option value="">Elige una opción.</option>
								@foreach ($owner_list as $o)
								{
									@if($cow->cattle->owner_id == $o->id)
									<option value="{{ $o->id }}" selected="selected">{{ $o->name }}</option>
									@else
									<option value="{{ $o->id }}">{{ $o->name }}</option>
									@endif
								}
								@endforeach
							</select>
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_paddock">Potrero</label>
						<div class="col-sm-9">
							<select class="form-control" name="cattle_paddock">
								<option value="">Elige una opción.</option>
								@foreach ($paddock_list as $p)
								{
									@if($cow->cattle->paddock_id == $p->id)
									<option value="{{ $p->id }}" selected="selected">{{ $p->name }}</option>
									@else
									<option value="{{ $p->id }}">{{ $p->name }}</option>
									@endif
								}
								@endforeach
							</select>
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cow_fertility">¿Es fertil?</label>
						<div class="col-sm-9">
							<select class="form-control" name="cow_fertility">
								<option value="">Elige una opción.</option>
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
						<label class="col-sm-3 control-label" for="cow_pregnancy_status">Estatus de gestación</label>
						<div class="col-sm-9">
							<select class="form-control" name="cow_pregnancy_status">
								<option value="">Elige una opción.</option>
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
						<label class="col-sm-3 control-label" for="cattle_is_alive">¿Esta viva?</label>
						<div class="col-sm-9">
							<select class="form-control" name="cattle_is_alive">
								<option value="">Elige una opción.</option>
								@if($cow->cattle->is_alive == 'Si')
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
						<label class="col-sm-3 control-label" for="cow_number_of_calves">Número de becerros</label>
						<div class="col-sm-9">
							<input type="number" name="cow_number_of_calves" class="form-control" placeholder="Numero de becerros" value="{{ $cow->number_of_calves }}">
						</div>
						</div>

						<div class="form-group">
						<div class="col-sm-offset-3 col-sm-3">
							<button type="submit" class="btn btn-success btn-sm">
        						<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Modificar registro
        					</button>
						</div>
						<div class="col-sm-offset-3 col-sm-3">
							<a class="btn btn-danger btn-sm pull-right" href="{{ route('cows.index') }}">
            					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar registro
            				</a>
						</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection