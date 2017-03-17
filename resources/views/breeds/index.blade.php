@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Razas, {{ count($breeds) }}
                    <a href="{{ route('breeds.create') }}">Agregar nueva raza</a>
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
                	@foreach($breeds as $breed)
                		<tr>
                			<td>{{ $breed->name }}</td>        			
                			<td>                            
                				<form class="" action="{{route('breeds.destroy', $breed->id)}}" method="post">
                					
                                    <input type="hidden" name="_method" value="delete">

                					<input type="hidden" name="_token" value="{{ csrf_token() }}">

                					<a href="{{route('breeds.edit',$breed->id)}}" class="btn btn-primary btn-xs">Editar</a>
                					
                                    <input class="btn btn-danger btn-xs" type="submit" onclick="return confirm('El registro será eliminado');" name="btnBorrar" value="Eliminar">

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