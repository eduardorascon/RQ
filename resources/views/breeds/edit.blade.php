@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Editar</div>
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
                    <form class="" action="{{route('breeds.update',$breed->id)}}" method="post">
                        <input name="_method" type="hidden" value="PATCH">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name">Nombre:</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" placeholder="Nombre" value="{{ $breed->name }}" />
                            </div>
                        </div>

                        <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
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