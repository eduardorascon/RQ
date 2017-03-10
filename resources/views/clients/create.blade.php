@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Captura de clientes
                </div>
            <div class="panel-body">
                <form class="form-horizontal" action="{{ route('clients.store') }}" method="post">      
                    {{csrf_field()}}      
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="first_name">Nombre:</label>
                      <div class="col-sm-10">
                        <input type="text" name="first_name" class="form-control" placeholder="Nombre" >
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="last_name">Apellidos:</label>
                      <div class="col-sm-10">
                        <input type="text" name="last_name" class="form-control" placeholder="Apellidos" >        
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="address">Dirección:</label>
                      <div class="col-sm-10">
                        <input type="text" name="address" class="form-control" placeholder="Dirección" >       
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="company">Empresa: </label>
                      <div class="col-sm-10">
                        <input type="text" name="company" class="form-control" placeholder="Empresa" >
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="phone">Teléfono</label>
                      <div class="col-sm-10">
                        <input type="text" name="phone" class="form-control" placeholder="Teléfono" >
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" class="btn btn-primary" value="Guardar" />
                      </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection