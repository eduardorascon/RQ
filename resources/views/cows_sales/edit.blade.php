@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-1 col-md-10">
			<div class="panel panel-default">
				<div class="panel-heading">Registro de venta</div>
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
				<form class="form-horizontal" action="{{ route('cows_sales.update', $calf->id) }}" method="post">
					<input type="hidden" name="_method" value="PATCH" />
					{{ csrf_field() }}

					<div class="form-group">
					<label class="col-sm-3 control-label" for="client_id">Cliente</label>
					<div class="col-sm-9">
						<select class="form-control" name="client_id">
						@foreach ($client_list as $client)
						{
							@if($calf->sale->client_id == $client->id)
							<option value="{{ $client->id }}" selected="selected">{{ $client->first_name . ' ' . $client->last_name . ' (' . $client->company . ')' }}</option>
							@else
							<option value="{{ $client->id }}">{{ $client->first_name . ' ' . $client->last_name . ' (' . $client->company . ')' }}</option>
							@endif
						}
						@endforeach
						</select>
					</div>
					</div>

					<div class="form-group">
					<label class="col-sm-3 control-label" for="calf_tag">Arete Siniga</label>
					<div class="col-sm-9">
						<input type="text" name="calf_tag" class="form-control" readonly="readonly" value="{{ $calf->cattle->tag }}">
					</div>
					</div>

					<div class="form-group">
					<label class="col-sm-3 control-label" for="calf_tag">Raza</label>
					<div class="col-sm-9">
						<input type="text" name="calf_breed" class="form-control" readonly="readonly" value="{{ $calf->cattle->breed->name }}">
					</div>
					</div>

					<div class="form-group">
					<label class="col-sm-3 control-label" for="sale_date">Fecha de venta</label>
					<div class="col-sm-9">
						<input type="text" name="sale_date" class="form-control input-date" value="{{ $calf->sale->getSaleDateWithFormat2() }}">
					</div>
					</div>

					<div class="form-group">
					<label class="col-sm-3 control-label" for="sale_weight">Peso de venta</label>
					<div class="col-sm-9">
						<input type="number" step="any" name="sale_weight" class="form-control" placeholder="Peso..." value="{{ $calf->sale->sale_weight }}">
					</div>
					</div>

					<div class="form-group">
					<label class="col-sm-3 control-label" for="price_per_kilo">Precio por kilo</label>
					<div class="col-sm-9">
						<div class="input-group">
						<div class="input-group-addon">$</div>
						<input type="number" step="any" name="price_per_kilo" class="form-control" placeholder="Precio por kilo..." value="{{ $calf->sale->price_per_kilo }}">
						</div>
					</div>
					</div>

					<div class="form-group">
					<div class="col-sm-offset-3 col-sm-9">
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