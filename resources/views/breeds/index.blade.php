<html>
    <body>
        <h1>Razas, {{ count($breeds) }}</h1>
		<a href="{{route('breeds.create')}}" >Agregar nueva Raza</a><br><br>
      
        <table>
        	<thead>
        		<tr>
        			<td>
        				NOMBRE
        			</td>        			
        			<td>
        			</td>
        		</tr>
        	</thead>
        	<tbody>
        	 @foreach($breeds as $breed)
        		<tr>
        			<td>
        				{{ $breed->name }}
        			</td>        			
        			<td>
        				<form class="" action="{{route('breeds.destroy', $breed->id)}}" method="post">
        					<input type="hidden" name="_method" value="delete">
        					<input type="hidden" name="_token" value="{{ csrf_token() }}">
        					<a href="{{route('breeds.edit',$breed->id)}}" class="btn btn-primary">Editar</a>
        					<input type="submit" onclick="return confirm('El registro será eliminado');" name="btnBorrar" value="Eliminar">
        				</form>        				
        			</td>
        		</tr>
			@endforeach        	
        	</tbody>
        	</table>		
    </body>
</html>