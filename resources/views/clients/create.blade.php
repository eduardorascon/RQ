 <div class="row">
    <div class="col-md-12">
      <h1>Guardar</h1>
    </div>
  </div>
  <div class="row">
    <form class="" action="{{route('clients.store')}}" method="post">      
      {{csrf_field()}}      
      
      <div>
        <label for="first_name">Nombre:</label>
        <input type="text" name="first_name" class="form-control" placeholder="Nombre" >        
      </div>

      <div>
      <label for="last_name">Apellidos:</label>
        <input type="text" name="last_name" class="form-control" placeholder="Apellidos" >        
      </div>
      
      <div>
        <label for="address">Dirección:</label>
        <input type="text" name="address" class="form-control" placeholder="Dirección" >       
      </div>

      <div>
        <label for="company">Empresa: </label>
        <input type="text" name="company" class="form-control" placeholder="Empresa" >
      </div>

      <div>
        <label for="phone">Teléfono</label>
        <input type="text" name="phone" class="form-control" placeholder="Teléfono" >
      </div>

      <div>
        <input type="submit" class="btn btn-primary" value="Guardar">
      </div>

    </form>
  </div>


