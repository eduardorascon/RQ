 <div class="row">
    <div class="col-md-12">
      <h1>Editar</h1>
    </div>
  </div>
  <div class="row">
    <form class="" action="{{route('clients.update',$client->id)}}" method="post">
      <input name="_method" type="hidden" value="PATCH">
      {{csrf_field()}}      
      
      <div>
         <label for="first_name">Nombre:</label>
         <input type="text" name="first_name" class="form-control" placeholder="Nombre" value="{{$client->first_name}}">        
       </div>
 
       <div>
       <label for="last_name">Apellidos:</label>
         <input type="text" name="last_name" class="form-control" placeholder="Apellidos" value="{{$client->last_name}}">        
       </div>
       
       <div>
         <label for="address">Dirección:</label>
         <input type="text" name="address" class="form-control" placeholder="Dirección" value="{{$client->address}}">       
       </div>
 
       <div>
         <label for="company">Empresa: </label>
         <input type="text" name="company" class="form-control" placeholder="Empresa" value="{{$client->company}}">
       </div>
 
       <div>
         <label for="phone">Teléfono</label>
         <input type="text" name="phone" class="form-control" placeholder="Teléfono" value="{{$client->phone}}">
      </div>

      <div>
        <input type="submit" class="btn btn-primary" value="Guardar">
      </div>

    </form>
  </div>