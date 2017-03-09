 <div class="row">
    <div class="col-md-12">
      <h1>Guardar</h1>
    </div>
  </div>
  <div class="row">
    <form class="" action="{{route('breeds.store')}}" method="post">      
      {{csrf_field()}}      
      
      <div>
        <label for="name">Nombre:</label>
        <input type="text" name="name" class="form-control" placeholder="Nombre" >        
      </div>  

      <div>
        <input type="submit" class="btn btn-primary" value="Guardar">
      </div>

    </form>
  </div>


