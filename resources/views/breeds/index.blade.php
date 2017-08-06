@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>RAZAS, registros {{ count($breeds) }}, </strong>
                    <a href="{{ route('breeds.create') }}">Agregar nuevo registro</a>
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
                    <div class="table-responsive">
                        <table class="table table-hover table-condensed">
                    	<thead>
                    		<tr>
                    			<th>Nombre</th>
                    			<th>Acciones</th>
                    		</tr>
                    	</thead>
                    	<tbody>
                    	@foreach($breeds as $breed)
                    		<tr>
                    			<td>{{ $breed->name }}</td>
                    			<td>
                    				<form class="" action="{{route('breeds.destroy', $breed->id)}}" method="post">
                                        <input type="hidden" name="_method" value="delete" />
                    					<input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                        <a href="{{route('breeds.edit',$breed->id)}}" class="btn btn-warning btn-sm" data-container="body" data-toggle="tooltip" data-placement="top" title="Editar información del registro">
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