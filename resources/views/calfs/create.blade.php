@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading">Captura de becerros</div>
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
				<form class="form-horizontal" action="{{ route('calfs.store') }}" method="post">
					{{ csrf_field() }}

					<div class="form-group">
					<label class="col-sm-2 control-label" for="mother_tag">Madre</label>
					<div class="col-sm-10">
						@if(!empty($cow))
						<input type="hidden" name="cow_id" value="{{ $cow->id }}" />
						<input type="text" id="mother_tag" name="mother_tag" class="form-control" placeholder="Madre" readonly="readonly" value="{{ $cow->cattle->tag }}" />
						@else
						<select class="form-control" name="cow_id">
							@foreach ($cow_list as $cow)
							{
							<option value="{{ $cow->id }}">{{ $cow->cattle->tag }}</option>
							}
							@endforeach
						</select>
						@endif
					</div>
					</div>

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
					<label class="col-sm-2 control-label" for="cattle_gender">Sexo</label>
					<div class="col-sm-10">
						<select class="form-control" name="cattle_gender">
							<option value="" selected="selected">Elegir sexo de la cría</option>
							<option value="Macho">Macho</option>
							<option value="Hembra">Hembra</option>
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