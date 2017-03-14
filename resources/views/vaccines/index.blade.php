@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Vacunas, {{ count($vaccines) }}
                    <a href="{{ route('vaccines.create') }}">Agregar nueva vacuna</a>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                	<thead>
                		<tr>
                			<th>Nombre</th>
                			<th></th>
                		</tr>
                	</thead>
                	<tbody>
                	@foreach($vaccines as $vaccine)
                		<tr>
                			<td>{{ $vaccine->name }}</td>
                			<td>
                				<form class="" action="{{route('vaccines.destroy', $vaccine->id)}}" method="post">
                                    <input type="hidden" name="_method" value="delete">
                					<input type="hidden" name="_token" value="{{ csrf_token() }}">
                					<a href="{{route('vaccines.edit', $vaccine->id)}}" class="btn btn-primary btn-xs">Editar</a>
                                    <input class="btn btn-danger btn-xs" type="submit" onclick="return confirm('El registro será eliminado');" name="btnBorrar" value="Eliminar" />
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
@endsection