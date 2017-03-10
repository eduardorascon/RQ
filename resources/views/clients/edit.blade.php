 <div class="row">
    <div class="col-md-12">
      <h1>Editar</h1>
    </div>
  </div>
  <div class="row">
    <form class="" action="{{route('breeds.update',$breed->id)}}" method="post">
      <input name="_method" type="hidden" value="PATCH">
      {{csrf_field()}}      
      
      <div>
        <label for="name">Nombre:</label>
        <input type="text" name="name" class="form-control" placeholder="Nombre" value="{{$breed->name}}">        
      </div>

      <div>
        <input type="submit" class="btn btn-primary" value="Guardar">
      </div>

    </form>
  </div>