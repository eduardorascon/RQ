@extends('layouts.app')

@section('content')
<div class="container">

 <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">

        <div class="panel-heading">
          Editar
        </div>
      
        <div class="panel-body">
          <form class="" action="{{route('breeds.update',$breed->id)}}" method="post">
            <input name="_method" type="hidden" value="PATCH">
            {{csrf_field()}}      
            
            <div class="form-group">
              <label for="name">Nombre:</label>
              <input type="text" name="name" class="form-control" placeholder="Nombre" value="{{$breed->name}}">        
            </div>    

            <div>
              <input type="submit" class="btn btn-primary" value="Guardar">
            </div>

          </form>
        </div>


    </div>
  </div>
</div>
@endsection