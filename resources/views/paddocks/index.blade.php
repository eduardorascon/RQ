@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>POTREROS, registros: {{ count($paddocks) }}, </strong>
                    <a href="{{ route('paddocks.create') }}">Agregar nuevo registro</a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-condesed">
                    	<thead>
                    		<tr>
                    			<th>Nombre</th>
                    			<th>Acciones</th>
                    		</tr>
                    	</thead>
                    	<tbody>
                    	@foreach($paddocks as $paddock)
                    		<tr>
                    			<td>{{ $paddock->name }}</td>
                    			<td>
                    				<form class="" action="{{route('paddocks.destroy', $paddock->id)}}" method="post">
                                        <input type="hidden" name="_method" value="delete">
                    					<input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <a href="{{  route('paddocks.edit', $paddock->id) }}" class="btn btn-warning btn-sm" data-container="body" data-toggle="tooltip" data-placement="top" title="Editar información del registro">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('El registro será eliminado');" name="btnBorrar" value="Eliminar" data-container="body" data-toggle="tooltip" data-placement="top" title="Eliminar el registro">
                                            <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>
                                        </button>
                    				</form>
                    			</td>
                    		</tr>
            			@endforeach
                    	</tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection