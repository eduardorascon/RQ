@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Clientes, {{ count($clients) }}
                    <a href="{{route('clients.create')}}" >Agregar nuevo cliente</a>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                	<thead>
                		<tr>
                			<th>Nombre</th>
                			<th>Apellidos</th>
                			<th>Dirección</th>
                			<th>Teléfono</th>
                			<th>Empresa</th>
                			<th></th>
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
                            <!--
                				<form class="" action="{{ route('clients.destroy', $client->id) }}" method="post">
                					<input type="hidden" name="_method" value="delete">
                					<input type="hidden" name="_token" value="{{ csrf_token() }}">
                					<a class="btn btn-primary" href="{{ route('clients.edit',$client->id) }}">Editar</a>
                					<input class="btn btn-danger" type="submit" onclick="return confirm('El registro será eliminado');" name="btnBorrar" value="Eliminar">
                				</form>
                            -->
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
@endsection