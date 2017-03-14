@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Captura de vacunas
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="{{ route('vaccines.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label class="col-sm-2 control-label" for="name">Nombre:</label>
                          <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" placeholder="Nombre" >
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
</div>
@endsection