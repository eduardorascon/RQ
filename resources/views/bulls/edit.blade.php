@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading">
					Captura de toros
				</div>
				<div class="panel-body">
					<form class="form-horizontal" action="{{ route('bulls.update', $bull->id) }}" method="post">
						<input type="hidden" name="_method" value="PATCH" />
						{{ csrf_field() }}

						<div class="form-group">
						<label class="col-sm-2 control-label" for="cattle_tag">Etiqueta</label>
						<div class="col-sm-10">
							<input type="text" name="cattle_tag" class="form-control" placeholder="Etiqueta" value="{{ $bull->cattle->tag }}" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 control-label" for="cattle_birth_date">Fecha de nacimiento</label>
						<div class="col-sm-10">
							<input type="date" name="cattle_birth_date" class="form-control" placeholder="Fecha de nacimiento" value="{{ $bull->cattle->birth }}" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 control-label" for="cattle_purchase_date">Fecha de compra</label>
						<div class="col-sm-10">
							<input type="date" name="cattle_purchase_date" class="form-control" placeholder="Fecha de compra" value="{{ $bull->cattle->purchase_date }}" />
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 control-label" for="cattle_breed">Raza</label>
						<div class="col-sm-10">
							<select class="form-control" name="cattle_breed">
								@foreach ($breed_list as $b)
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