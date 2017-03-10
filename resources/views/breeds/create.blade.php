@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Captura de razas
                </div>
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