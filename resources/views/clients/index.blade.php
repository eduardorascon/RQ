<html>
    <body>
        <h1>Clientes, {{ count($clients) }}</h1>

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
        			</td>
        		</tr>
			@endforeach        	
        	</tbody>
        	</table>		
    </body>
</html>