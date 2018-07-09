@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>TOROS, Cambios en registro</strong>
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
					<form class="form-horizontal" action="{{ route('bulls.update', $bull->id) }}" method="post">
						<input type="hidden" name="_method" value="PATCH" />
						{{ csrf_field() }}

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_tag">Arete Siniga</label>
						<div class="col-sm-9">
							<input type="text" name="cattle_tag" class="form-control" placeholder="Etiqueta" value="{{ $bull->cattle->tag }}" />
						</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label" for="control_tag">Arete de control</label>
							<div class="col-sm-9">
								<input type="text" name="control_tag" class="form-control" placeholder="Etiqueta" value="{{ $bull->cattle->control_tag }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label" for="cattle_birth_date">Fecha de nacimiento</label>
							<div class="col-sm-9">
								<input type="text" name="cattle_birth_date" class="form-control input-date" placeholder="dd/mm/aaaa" value="{{ $bull->cattle->getBirthWithFormat2() }}" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label" for="empadre_date">Fecha de empadre</label>
							<div class="col-sm-9">
								<input type="text" name="empadre_date" class="form-control input-date" placeholder="dd/mm/aaaa" value="{{ $bull->cattle->empadre_date }}" >
							</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_purchase_date">Fecha de compra</label>
						<div class="col-sm-9">
							<input type="text" name="cattle_purchase_date" class="form-control input-date" placeholder="dd/mm/aaaa" value="{{ $bull->cattle->getPurchaseDateWithFormat2() }}" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_breed">Raza</label>
						<div class="col-sm-9">
							<select class="form-control" name="cattle_breed">
								<option value="">Elige una opción.</option>
								@foreach($breed_list as $b)
								{
									@if($bull->cattle->breed_id == $b->id)
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
									@if($bull->cattle->owner_id == $o->id)
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
									@if($bull->cattle->paddock_id == $p->id)
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
						<label class="col-sm-3 control-label" for="cattle_is_alive">¿Esta vivo?</label>
						<div class="col-sm-9">
							<select class="form-control" name="cattle_is_alive">
								<option value="">Elige una opción.</option>
								@if($bull->cattle->is_alive == 'Si')
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
						<div class="col-sm-offset-3 col-sm-3">
							<button type="submit" class="btn btn-success btn-sm">
        						<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Modificar registro
        					</button>
						</div>
						<div class="col-sm-offset-3 col-sm-3">
							<a class="btn btn-danger btn-sm pull-right" href="{{ route('bulls.index') }}">
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