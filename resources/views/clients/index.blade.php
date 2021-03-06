@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>CLIENTES, registros {{ count($clients) }}, </strong>
                    <a href="{{ route('clients.create') }}" >Agregar nuevo registro</a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-condensed">
                    	<thead>
                    		<tr>
                    			<th>Nombre</th>
                    			<th>Apellidos</th>
                    			<th>Dirección</th>
                    			<th>Teléfono</th>
                    			<th>Empresa</th>
                    			<th>Acciones</th>
                    		</tr>
                    	</thead>
                    	<tbody>
                    	 @foreach($clients as $client)
                    		<tr>
                    			<td>{{ $client->first_name }}</td>
                    			<td>{{ $client->last_name }}</td>
                    			<td>{{ $client->address }}</td>
                    			<td>{{ $client->phone }}</td>
                    			<td>{{ $client->company }}</td>
                    			<td>
                    				<form class="" action="{{ route('clients.destroy', $client->id) }}" method="post">
                    					<input type="hidden" name="_method" value="delete">
                    					<input type="hidden" name="_token" value="{{ csrf_token() }}">

                    					<a class="btn btn-warning btn-sm" href="{{ route('clients.edit', $client->id) }}" data-container="body" data-toggle="tooltip" data-placement="top" title="Editar información del registro">
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