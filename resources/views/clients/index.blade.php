<html>
    <body>
        <h1>Clientes, {{ count($clients) }}</h1>
		<a href="{{route('clients.create')}}" >Agregar nuevo cliente</a><br><br>
      
        <table>
        	<thead>
        		<tr>
        			<td>
        				NOMBRE
        			</td>
        			<td>
        				APELLIDO
        			</td>
        			<td>
        				DIRECCIÓN
        			</td>
        			<td>
        				TELÉFONO
        			</td>
        			<td>
        				EMPRESA
        			</td>
        			<td>
        			</td>
        		</tr>
        	</thead>
        	<tbody>
        	 @foreach($clients as $client)
        		<tr>
        			<td>
        				{{ $client->first_name }}
        			</td>
        			<td>
        				{{ $client->last_name }}
        			</td>
        			<td>
        				{{ $client->address }}
        			</td>
        			<td>
        				{{ $client->phone }}
        			</td>
        			<td>
        				{{ $client->company }}
        			</td>
        			<td>
        				<form class="" action="{{route('clients.destroy', $client->id)}}" method="post">
        					<input type="hidden" name="_method" value="delete">
        					<input type="hidden" name="_token" value="{{ csrf_token() }}">
        					<a href="{{route('clients.edit',$client->id)}}" class="btn btn-primary">Editar</a>
        					<input type="submit" onclick="return confirm('El registro será eliminado');" name="btnBorrar" value="Eliminar">
        				</form>        				
        			</td>
        		</tr>
			@endforeach        	
        	</tbody>
        	</table>		
    </body>
</html>