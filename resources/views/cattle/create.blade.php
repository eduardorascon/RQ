@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>GANADO, Nuevo registro</strong>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" action="{{ route('cattle.store') }}" method="post" autocomplete="off">
						{{ csrf_field() }}

						<div class="form-group">
							<label class="col-sm-3 control-label" for="cattle_tag">Ganado</label>
							<div class="col-sm-9">
							<label class="radio-inline">
								<input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Becerro" checked="checked"> Becerro
							</label>
							<label class="radio-inline">
								<input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="Vaca"> Vaca
							</label>
							<label class="radio-inline">
								<input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="Toro"> Toro
							</label>
							</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cow_id">Madre</label>
						<div class="col-sm-9">
							<select class="form-control select-beast" name="cow_id">
								<option value="">Elige una opción.</option>
								@foreach ($cow_list as $cow)
								<option value="{{ $cow->id }}">{{ $cow->cattle->tag }}</option>
								@endforeach
							</select>
						</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label" for="cattle_tag">Arete Siniga</label>
							<div class="col-sm-9">
								<input type="text" name="cattle_tag" class="form-control" placeholder="Etiqueta">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label" for="control_tag">Arete de control</label>
							<div class="col-sm-9">
								<input type="text" name="control_tag" class="form-control" placeholder="Etiqueta">
							</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cattle_birth_date">Fecha de nacimiento</label>
						<div class="col-sm-9">
							<input type="text" name="cattle_birth_date" class="form-control input-date" placeholder="dd/mm/aaaa">
						</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label" for="empadre_date">Fecha de empadre</label>
							<div class="col-sm-9">
								<input type="text" name="empadre_date" class="form-control input-date" placeholder="dd/mm/aaaa">
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
						<label class="col-sm-3 control-label">¿Es fertil?</label>
						<div class="col-sm-9">
							<select class="form-control" name="cow_fertility" disabled="disabled">
								<option value="">Elige una opción.</option>
								<option value="Si">Si</option>
								<option value="No">No</option>
							</select>
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cow_pregnancy_status">Estatus de gestación</label>
						<div class="col-sm-9">
							<select class="form-control" name="cow_pregnancy_status" disabled="disabled">
								<option value="">Elige una opción.</option>
								<option value="Vacia">Vacia</option>
								<option value="Preñada">Preñada</option>
								<option value="Parida">Parida</option>
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
						<label class="col-sm-3 control-label" for="cattle_gender">Sexo</label>
						<div class="col-sm-9">
							<select class="form-control" name="cattle_gender">
								<option value="">Elige una opción.</option>
								<option value="Macho">Macho</option>
								<option value="Hembra">Hembra</option>
							</select>
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-3 control-label" for="cow_number_of_calves">Numero de becerros</label>
						<div class="col-sm-9">
							<input type="number" name="cow_number_of_calves" class="form-control" placeholder="Numero de becerros" value="0" disabled="disabled">
						</div>
						</div>

						<div class="form-group">
						<div class="col-sm-offset-3 col-sm-3">
							<button type="submit" class="btn btn-success">
        						<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Guardar registro
        					</button>
						</div>
						<div class="col-sm-offset-3 col-sm-3">
							<a class="btn btn-danger pull-right" href="{{ route('cows.index') }}">
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

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
    	$("input[name='inlineRadioOptions']").change(function() {

    		$("select[name='cow_id']").prop("disabled", 'disabled');
    		$("select[name='cow_fertility']").prop("disabled", 'disabled');
    		$("select[name='cow_pregnancy_status']").prop("disabled", 'disabled');
    		$("select[name='cattle_gender']").prop("disabled", 'disabled');
    		$("input[name='cow_number_of_calves']").prop("disabled", "disabled");

    		var selectedOption = $(this).val();
    		if(selectedOption == 'Becerro') {
    			$("select[name='cow_id']").prop("disabled", '');
    			$("select[name='cattle_gender']").prop("disabled", '');
    		}

    		if(selectedOption == 'Vaca') {
    			$("select[name='cow_fertility']").prop("disabled", '');
    			$("select[name='cow_pregnancy_status']").prop("disabled", '');
    			$("select[name='cattle_gender']").val('Hembra');
    			$("input[name='cow_number_of_calves']").prop("disabled", "");
    		}

    		if(selectedOption == 'Toro') {
    			$("select[name='cattle_gender']").val('Macho');
    		}
    	});
    });
</script>
@endsection