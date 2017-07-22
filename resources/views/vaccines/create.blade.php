@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>VACUNAS, Nuevo registro</strong>
                </div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="panel-body">
                    <form class="form-horizontal" action="{{ route('vaccines.store') }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name">Nombre:</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" placeholder="Nombre" >
                            </div>
                        </div>

                        <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-3">
                            <button type="submit" class="btn btn-success btn-sm">
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Guardar registro
                            </button>
                        </div>
                        <div class="col-sm-offset-3 col-sm-3">
                            <a class="btn btn-danger btn-sm pull-right" href="{{ route('vaccines.index') }}">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancelar registro
                            </a>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection