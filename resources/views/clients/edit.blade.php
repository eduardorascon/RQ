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
          <form class="form-horizontal" action="{{ route('clients.update', $client->id) }}" method="post">
            <input name="_method" type="hidden" value="PATCH">
            {{csrf_field()}}

            <div class="form-group">
              <label class="col-sm-2 control-label" for="first_name">Nombre:</label>
              <div class="col-sm-10">
                <input type="text" name="first_name" class="form-control" placeholder="Nombre" value="{{$client->first_name}}">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label" for="last_name">Apellidos:</label>
              <div class="col-sm-10">
                <input type="text" name="last_name" class="form-control" placeholder="Apellidos" value="{{$client->last_name}}">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label" for="address">Dirección:</label>
              <div class="col-sm-10">
                <input type="text" name="address" class="form-control" placeholder="Dirección" value="{{$client->address}}">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label" for="company">Empresa: </label>
              <div class="col-sm-10">
                <input type="text" name="company" class="form-control" placeholder="Empresa" value="{{$client->company}}">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label" for="phone">Teléfono</label>
              <div class="col-sm-10">
                <input type="text" name="phone" class="form-control" placeholder="Teléfono" value="{{$client->phone}}">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-primary" value="Guardar">
              </div>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection