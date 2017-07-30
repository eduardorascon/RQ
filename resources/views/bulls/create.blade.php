@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>TOROS, Nuevo registro</strong>
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
					<form class="form-horizontal" action="{{ route('bulls.store') }}" method="post">
						{{ csrf_field() }}

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_tag">Arete Siniga</label>
						<div class="col-sm-9">
							<input type="text" name="cattle_tag" class="form-control" placeholder="Etiqueta">
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_birth_date">Fecha de nacimiento</label>
						<div class="col-sm-9">
							<input type="text" name="cattle_birth_date" class="form-control input-date" placeholder="dd/mm/aaaa">
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_purchase_date">Fecha de compra</label>
						<div class="col-sm-9">
							<input type="text" name="cattle_purchase_date" class="form-control input-date" placeholder="dd/mm/aaaa">
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_breed">Raza</label>
						<div class="col-sm-9">
							<select class="form-control" name="cattle_breed">
								<option value="">Elige una opción.</option>
								@foreach ($breed_list as $b)
								{
								<option value="{{ $b->id }}">{{ $b->name }}</option>
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
								<option value="{{ $o->id }}">{{ $o->name }}</option>
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
								<option value="{{ $p->id }}">{{ $p->name }}</option>
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
								<option value="Si">Si</option>
								<option value="No">No</option>
							</select>
						</div>
						</div>

						<div class="form-group">
						<div class="col-sm-offset-3 col-sm-3">
							<button type="submit" class="btn btn-success btn-sm">
        						<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Guardar registro
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